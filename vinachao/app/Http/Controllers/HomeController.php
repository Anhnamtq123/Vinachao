<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller{
    public function index(){
        $products = Product::paginate(8);
        return view('site.catalog',compact('products'));
    }
}

?>