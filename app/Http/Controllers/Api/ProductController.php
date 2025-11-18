<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // API lấy tất cả sản phẩm
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'data' => $products
        ]);
    }

    // API tạo sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return response()->json([
            'success' => true,
            'data' => $product
        ], 201);
    }
    public function xinchao()
    {
        $products = cache()->remember('products', 60, function(){
            return Product::all();
        });
        
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
    
}

