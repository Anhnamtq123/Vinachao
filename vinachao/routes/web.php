<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
// Route::group(['tiền tố '=>'đường dẫn'],function(){});
Route::group(['prefix'=>''],function(){
    Route::get('/',[HomeController::class,'index'])->name('site.home');
});

Route::group(['prefix'=>'admin'],function(){
   
    Route::get('/',[AdminController::class,'index'])->name('admin.master');

    Route::resource('product',ProductController::class);

    /* Viết gọn
    Route::resource([
        'user'=> UserController::class,
        'category'=> CategoryController::class
    ]);

    */
});
Route::get('/products/search', [ProductController::class, 'search'])->name('product.search');
