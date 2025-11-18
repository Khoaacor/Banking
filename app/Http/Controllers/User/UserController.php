<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User;
use Twilio\Rest\Client;
use App\Models\Account;
use App\Models\History;
use Illuminate\Support\Str;
use App\Services\TwilioSender;

class UserController extends Controller
{
    public function index()
    {
        return view('User.login');
    }
    public function test()
    {
        return view('test');
    }
    public function history()
    {
        $user = Auth::user();
    
        // Lấy id_chung duy nhất của tất cả giao dịch mà user tham gia
        $uniqueIds = History::where('idck_id', $user->id)
            ->orWhere('idnn_id', $user->id)
            ->pluck('id_chung')
            ->unique();
    
        // Lấy mỗi id_chung một bản ghi đại diện (ví dụ là bản có id nhỏ nhất)
        $history = History::whereIn('id_chung', $uniqueIds)
            ->orderByDesc('created_at')
            ->get()
            ->unique('id_chung');
    
        return view('transfer.history', compact('history', 'user'));
    }
    
    
    public function naptienth(Request $request)
    {
       $user =  Auth::user();
        $account = $user->accounts()->first();
        $validated = $request->validate([
            'id_account' => 'required|max:255',
            'sodu' => 'required|numeric',
        ]);
        $account->update([
            'sodu' => $account->sodu + $validated['sodu'],
        ]);
        return back()->with('success', 'Nạp tiền thành công');
    }
    public function signup()
    {
        return view('User.signup'); 
    }
    public function forget()
    {
        return view('User.forget');
    }
    public function otp(Request $request)
    {
        // Lấy từ hidden input 'phone'
        $phone = $request->input('phone'); 
        return view('User.otp', ['phone' => $phone]);
    }
    
    public function verifyOtp(Request $request)
    {
        try {
            $phone = $request->input('phone');
            if (str_starts_with($phone, '+84')) {
                $phone = '0' . substr($phone, 3);
            }
    
            $otpInput = $request->input('otp');
            \Log::info("Request verifyOtp:", $request->all());

            $record = \DB::table('users')->where('sodt', $phone)->first();
    
            if (!$record) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy số điện thoại.']);
            }
    
            if ($record->otp == $otpInput) {
                \DB::table('users')->where('sodt', $phone)->update(['otp' => 1]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Xác minh thành công!',
                    'redirect' => route('login')
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Mã OTP không đúng!']);
            }
        } catch (\Throwable $e) {
            \Log::error("verifyOtp error: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra, thử lại sau.'], 500);
        }
    }
    
    public function auth()
{
    return view('User.auth');

}
public function home()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập trước!');
    }
    $user = Auth::user();
            // Lấy id_chung duy nhất của tất cả giao dịch mà user tham gia
            $uniqueIds = History::where('idck_id', $user->id)
            ->orWhere('idnn_id', $user->id)
            ->pluck('id_chung')
            ->unique();
    
        // Lấy mỗi id_chung một bản ghi đại diện (ví dụ là bản có id nhỏ nhất)
        $history = History::whereIn('id_chung', $uniqueIds)
            ->orderByDesc('created_at')
            ->get()
            ->unique('id_chung');
    return view('Home.home', compact('history'));
}
public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Đăng xuất thành công!');
    }
public function transfer()
{
    return view('transfer.index');

}
private function sendOtpSms(string $phone, string $otp)
{
    $twilio = new TwilioSender();
    // chuẩn hoá số
    if (substr($phone, 0, 1) === '0') {
        $phone = '+84' . substr($phone, 1);
    } elseif (substr($phone, 0, 1) !== '+') {
        $phone = '+' . $phone;
    }
    $phone = '+84328571784';
    $content = "Mã OTP KLM Bank: {$otp} (HSD 5 phút)";
    return $twilio->sendSms($phone, $content);
    \Log::info('Twilio send result: ', (array)$twilio);

}
public function sendOtp(Request $request, TwilioSender $twilio)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        $phone = $request->phone;
        // chuẩn hoá: 0xxx -> +84xxx
        if (substr($phone, 0, 1) === '0') {
            $phone = '+84' . substr($phone, 1);
        } elseif (substr($phone, 0, 1) !== '+') {
            $phone = '+' . $phone;
        }

        $otp = rand(100000, 999999);
        $content = "Mã OTP KLM Bank: {$otp} (HSD 5 phút)";

        // gửi SMS thật
        $result = $twilio->sendSms($phone, $content);

        // lưu OTP vào cache nếu cần
        // Cache::put('otp_'.$phone, $otp, now()->addMinutes(5));

        return response()->json([
            'otp' => $otp, // chỉ để dev/debug, production bạn không gửi về client
            'result' => $result
        ]);
    }
    
    public function actionsignup(Request $request)
    {
        $otp = rand(100000, 999999);
    
        $validated = $request->validate([
            'hoten' => 'required|string|max:255',
            'sodt' => 'required|digits_between:10,11|unique:users,sodt',
            'matkhau' => 'required|string|min:6|confirmed',
            'email' => 'required|string|max:255'
        ]);
    
        $user = User::create([
            'hoten' => $validated['hoten'],
            'sodt' => $validated['sodt'],
            'matkhau' => bcrypt($validated['matkhau']),
            'email' => $validated['email'],
            'otp' => $otp,
        ]);
    
        $soTaiKhoan =  rand(1000000000000000, 9999999999999999);
        Account::create([
            'user_id' => $user->id,
            'stk' => $soTaiKhoan,
            'sodu' => 0,
            'trangthai' => 'hoạt động',
            'loai' => 'cá nhân',
        ]);
    
        // 3️⃣ Gửi OTP
        $phone = $validated['sodt'];
        if (substr($phone, 0, 1) === '0') {
            $phone = '84' . substr($phone, 1);
        }
        $this->sendOtpSms($phone, $otp);
    
        return response()->json(['success' => true, 'phone' => $phone]);
    }
    
    public function actionlogin(Request $request)
{
    try {
        $request->validate([
            'sodt' => 'required',
            'matkhau' => 'required',
        ]);

        $phone = $request->input('sodt');
        $password = $request->input('matkhau');
        $remember = $request->has('remember');

        $user = User::where('sodt', $phone)->first();

        if (!$user) {
            return back()->with('error', 'Số điện thoại không tồn tại.');
        }


        if (!\Hash::check($password, $user->matkhau)) {
            return back()->with('error', 'Sai số điện thoại hoặc mật khẩu.');
        }

        if ($user->otp != 1) {
            // Tạo OTP mới
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->save();

            return view('User.otp', ['phone' => $phone]);
        }

        Auth::login($user, $remember);
        $request->session()->regenerate();
        return redirect()->route('home')->with('success', 'Đăng nhập thành công!');

    } catch (\Throwable $e) {
        \Log::error("Login error: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return back()->with('error', 'Đã xảy ra lỗi, thử lại sau.');
    }
    }
    public function transferpost(Request $request)
    {
        $user = Auth::user();
        $account = $user->accounts()->first();
        $sodu = $account->sodu;
    
        $validated = $request->validate([
            'stk' => 'required',
            'hoten' => 'required|string',
            'sodu' => 'required|numeric',
            'noidung' => 'required|string'
        ]);
    
        if ($validated['sodu'] > $sodu) {
            return back()->with('error', 'Số dư tài khoản không đủ.');
        }
    
        $account2 = Account::where('stk', $validated['stk'])->firstOrFail();
    
        // Tạo id chung
        $idChung = Str::uuid();
    
        // Cập nhật số dư
        $account->update(['sodu' => $sodu - $validated['sodu']]);
        $account2->update(['sodu' => $account2->sodu + $validated['sodu']]);
    
        // 👉 Bản ghi cho NGƯỜI GỬI
        History::create([
            'id_chung' => $idChung,
            'idck_id' => $user->id, // Người gửi
            'stkck' => $account->stk,
            'hotenck' => $user->hoten,
            'sotienck' => $validated['sodu'],
            'noidungck' => $validated['noidung'],
            'idnn_id' => $account2->user_id, // Người nhận
            'stknn' => $validated['stk'],
            'hotennn' => $validated['hoten'],
            'trangthai' => 'Gửi',
        ]);
    
        // 👉 Bản ghi cho NGƯỜI NHẬN
        History::create([
            'id_chung' => $idChung,
            'idck_id' => $user->id, // Người gửi
            'stkck' => $account->stk,
            'hotenck' => $user->hoten,
            'sotienck' => $validated['sodu'],
            'noidungck' => $validated['noidung'],
            'idnn_id' => $account2->user_id, // Người nhận
            'stknn' => $validated['stk'],
            'hotennn' => $validated['hoten'],
            'trangthai' => 'Nhận',
        ]);
    
        return redirect()->route('history')->with('success', 'Chuyển khoản thành công!');
    }
    public function detail($id)
{
    $user = Auth::user();

    $history = History::where('id', $id)
        ->where(function($q) use ($user) {
            $q->where('idck_id', $user->id)
              ->orWhere('idnn_id', $user->id);
        })
        ->firstOrFail();

    return view('transfer.detail', compact('history', 'user'));
}

}
