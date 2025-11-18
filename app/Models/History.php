<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'history'; // Laravel sẽ dùng đúng tên bảng

    protected $fillable = [
        'id',
        'id_chung',
        'idck_id',
        'stkck',
        'hotenck',
        'sotienck',
        'noidungck',
        'idnn_id',
        'stknn',
        'hotennn',
        'trangthai'
    ];

}
