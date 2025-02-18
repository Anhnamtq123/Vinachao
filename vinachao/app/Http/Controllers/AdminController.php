<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller{
    public function index(){
        $products = Product::paginate(5);
        return view('admin.body',compact('products'));
    }

    public function edit(Product $product){
        // 
    }

    public function create(){
        
    }

    public function destroy(){
       return $a = "Xóa";
    }

}
?>