<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(6);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'weight' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName(); // Tạo tên file
            $request->file('image')->move(public_path('assets/images/galery'), $imageName); // Lưu file vào public/assets/images/galery
            $validatedData['thumbnail'] = $imageName;
        }

        // Tạo sản phẩm mới
        $product = Product::create($validatedData);

        if ($product) {
            return response()->json($product, 201);
        } else {
            return response()->json(['message' => 'Không thể tạo sản phẩm'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'weight' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validatedData);

        return response()->json($product, 200);
    }

    public function updateThumbnail(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Kiểm tra xem có file hình ảnh không
        if (!$request->hasFile('image')) {
            return response()->json(['message' => 'Không có file hình ảnh nào được gửi!'], 400);
        }

        // Kiểm tra tính hợp lệ của file hình ảnh
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng hình ảnh
        ]);

        // Lưu hình ảnh vào thư mục public/assets/images/galery
        $imageName = $request->file('image')->getClientOriginalName(); // Tạo tên file
        $request->file('image')->move(public_path('assets/images/galery'), $imageName); // Lưu file vào public/assets/images/galery

        // Tạo bản ghi mới trong bảng galleries
        $product->update([
            'thumbnail' => 'assets/images/galery/' . $imageName, // Lưu đường dẫn file vào database
        ]);

        return response()->json(['message' => 'Hình ảnh đã được cập nhật!', 'product' => $product], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
