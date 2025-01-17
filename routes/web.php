<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/documentation');
});


Route::prefix('/products')->controller(\App\Http\Controllers\ProductController::class)
    ->group(function(){
    Route::get('/', 'viewProducts')->name('view.products');
    Route::post('/', 'saveProduct')->name('saveProduct');
    Route::put('/{id}/edit', 'editProduct')->name('editProduct')
        ->where('id', '[0-9]+');
    Route::delete('/{id}/delete', 'deleteProduct')->name('deleteProduct')
        ->where('id', '[0-9]+');

    Route::get('/search','searchProducts')->name('searchProducts');
});

Route::prefix('/categories')->controller(\App\Http\Controllers\CategoryController::class)
    ->group(function(){
        Route::get('/','viewCategories')->name('view.categories');
        Route::post('/','saveCategory')->name('saveCategory');
        Route::put('/{id}/edit','editCategory')->name('editCategory')
            ->where('id', '[0-9]+');
        Route::delete('/{id}/delete','deleteCategory')->name('deleteCategory')
            ->where('id', '[0-9]+');
        Route::get('/{id}/detail','viewDetailCategory')->name('detailCategory')
            ->where('id', '[0-9]+');
    });

Route::prefix('/status')->controller(\App\Http\Controllers\StatusController::class)
    ->group(function(){
        Route::get('/','viewStatus')->name('view.status');
        Route::post('/','saveStatus')->name('saveStatus');
        Route::put('/{id}/edit','editStatus')->name('editStatus')
            ->where('id', '[0-9]+');
        Route::delete('/{id}/delete','deleteStatus')->name('deleteStatus')
            ->where('id', '[0-9]+');
    });

Route::get('/documentation',function(){
    return view('documentation',['title'=>'Dokumentasi']);
});

