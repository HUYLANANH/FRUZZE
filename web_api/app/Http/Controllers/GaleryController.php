<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galery;
use App\Http\Controllers\ImageController;

class GaleryController extends Controller
{
    public function getGalery (string $id)
    {
        $galery = Galery::find();
        return response()->json($galery);
    }

    public function addGalery(Request $request, string $id)
    {
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
        $gallery = Galery::create([
            'product_id' => $id,
            'image' => 'assets/images/galery/' . $imageName, // Lưu đường dẫn file vào database
        ]);

        return response()->json(['message' => 'Hình ảnh đã được thêm vào gallery!', 'gallery' => $gallery], 201);
    }

    public function updateGalery(Request $request, string $id)
    {
        // Kiểm tra xem có file hình ảnh không
        if (!$request->hasFile('image')) {
            return response()->json(['message' => 'Không có file hình ảnh nào được gửi!'], 400);
        }

        // Kiểm tra tính hợp lệ của file hình ảnh
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng hình ảnh
        ]);

        // Lưu hình ảnh vào thư mục public/assets/images/galery
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName(); // Tạo tên file
        $image->move(public_path('assets/images/galery'), $imageName); // Lưu file vào public/assets/images/galery

        // Tạo bản ghi mới trong bảng galleries
        $gallery = Galery::create([
            'product_id' => $id,
            'image' => 'assets/images/galery/' . $imageName, // Lưu đường dẫn file vào database
        ]);

        return response()->json(['message' => 'Hình ảnh đã được thêm vào gallery!', 'gallery' => $gallery], 201);
    }

    public function deleteGalery()
    {

    }
}
