<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


# slider routes

Route::get('/slider/all', [SliderController::class, 'Sliders'])->name('all.slider');
Route::get('/slider/add', [SliderController::class, 'AddSlider'])->name('add.slider');
Route::post('/slider/store', [SliderController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [SliderController::class, 'Edit']);
Route::post('/slider/update/{id}', [SliderController::class, 'Update']);
Route::get('/slider/delete/{id}', [SliderController::class, 'Delete']);


# category routes

Route::get('/category/all', [CategoryController::class, 'Categories'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('add.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/delete/{id}', [CategoryController::class, 'Delete']);

# brand routes

Route::get('/brand/all', [BrandController::class, 'Brands'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('add.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

# about routes
Route::get('/about/all', [AboutController::class, 'About'])->name('all.about');
Route::get('/about/add', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/about/store', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'Edit']);
Route::post('/about/update/{id}', [AboutController::class, 'Update']);
Route::get('/about/delete/{id}', [AboutController::class, 'Delete']);
