<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'img'   => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'descriptions'=> 'nullable|string'
        ]);
        
        $fileName = null;
        
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);// Lưu file vào thư mục public/uploads
        }
        
        Product::create([
            'name'  => $request->name,
            'price' => $request->price,
            'img'   => $fileName, // Lưu tên ảnh vào database
            'descriptions' => $request->descriptions
        ]);
        
        return back()->with('success', 'Sản phẩm đã được thêm!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit',compact('product'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'img'   => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'descriptions'=> 'nullable|string',
        ]);
    
        $product = Product::findOrFail($product->id); // Tìm sản phẩm cần cập nhật
    
        // Kiểm tra nếu người dùng chọn file ảnh mới
        if ($request->hasFile('img')) {
            // Xóa ảnh cũ nếu có
            if ($product->img && file_exists(public_path('uploads/' . $product->img))) {
                unlink(public_path('uploads/' . $product->img));
            }
    
            // Lưu ảnh mới
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
        } else {
            // Nếu không có ảnh mới, giữ lại tên ảnh cũ
            $fileName = $product->img;
        }
    
        // Cập nhật thông tin sản phẩm
        $product->update([
            'name'  => $request->name,
            'price' => $request->price,
            'img'   => $fileName, // Lưu tên ảnh vào database
            'descriptions' => $request->descriptions
        ]);
    
        return back()->with('success', 'Sản phẩm đã được cập nhật!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product->id);
    
    // Nếu sản phẩm có ảnh, xóa ảnh khỏi thư mục public/uploads
    if ($product->img && file_exists(public_path('uploads/' . $product->img))) {
        unlink(public_path('uploads/' . $product->img));  // Xóa ảnh
    }
    
    // Xóa sản phẩm khỏi cơ sở dữ liệu
    $product->delete();
    
    // Trả về thông báo thành công và quay lại trang trước
    return back()->with('success', 'Sản phẩm đã được xóa!');
    }

    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ input
        $query = $request->input('query');
    
        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($query) {
        // Tìm kiếm sản phẩm theo tên
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            // Nếu không có từ khóa tìm kiếm, hiển thị tất cả sản phẩm
           $products = Product::all();
        }

        // Trả kết quả tìm kiếm về view
        return view('admin.body', compact('products', 'query'));
    }
}
