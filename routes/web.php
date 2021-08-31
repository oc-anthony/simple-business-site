<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Models\MultiPic;
use Illuminate\Support\Facades\DB;
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
    $brands = DB::table('brands')->get();
    $about = DB::table('abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'about', 'images'));
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

# portfolio routes

Route::get('/multi/image', [PortfolioController::class, 'MultiPic'])->name('multi.pic');
Route::post('/portfolio/add', [PortfolioController::class, 'AddImages'])->name('store.images');
Route::get('/portfolio', [PortfolioController::class, 'Portfolio'])->name('portfolio');

# contact routes

Route::get('/contact/profile', [ContactController::class, 'ContactProfile'])->name('contact.profile');
Route::get('/contact/add', [ContactController::class, 'AddContact'])->name('add.contact');
Route::post('/contact/store', [ContactController::class, 'StoreContact'])->name('store.contact');
Route::get('contact/edit/{id}', [ContactController::class, 'Edit']);
Route::post('contact/update/{id}', [ContactController::class, 'Update']);
Route::get('contact/delete/{id}', [ContactController::class, 'Delete']);

Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::get('/contact/messages', [ContactController::class, 'Messages'])->name('contact.messages');
Route::post('/contact/form', [ContactController::class, 'StoreMessage'])->name('store.message');

# user profile
Route::get('/user/profile', [ProfileController::class, 'Profile'])->name('change.profile');
Route::post('/profile/update', [ProfileController::class, 'UpdateProfile'])->name('update.profile');
Route::get('/user/password', [ProfileController::class, 'ChangePassword'])->name('change.password');
Route::post('/password/update', [ProfileController::class, 'UpdatePassword'])->name('update.password');
