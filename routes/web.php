<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Auth\LoginController;

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
// Route::group(['prefix' => '0xDex'], function () {
//     // Auth::routes();
// });
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/services', [WebsiteController::class, 'services'])->name('services');
Route::get('/categories', [WebsiteController::class, 'categories'])->name('categories');
Route::get('/posts', [WebsiteController::class, 'posts'])->name('posts');
Route::get('categories/{slug}', [WebsiteController::class, 'categoryDetails'])->name('category.details');
Route::get('post/{slug}', [WebsiteController::class, 'postDetails'])->name('post.details');
Route::get('page/{slug}', [WebsiteController::class, 'page'])->name('page');
Route::get('contact', [WebsiteController::class, 'showContactForm'])->name('contact.show');
Route::post('contact', [WebsiteController::class, 'submitContactForm'])->name('contact.submit');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/accounts', [HomeController::class, 'accounts'])->name('accounts');
    Route::post('/accounts', [HomeController::class, 'accounts_store'])->name('accounts.store');
    Route::get('/accounts/create', [HomeController::class, 'accounts_create'])->name('accounts.create');
    Route::get('/accounts/{account}', [HomeController::class, 'accounts_edit'])->name('accounts.edit');
    Route::put('/accounts/{account}', [HomeController::class, 'accounts_update'])->name('accounts.update');
    Route::delete('/accounts/{account}', [HomeController::class, 'accounts_destroy'])->name('accounts.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::post('/post/ckeditor/upload', [PostController::class,"upload_image_cke"])->name('ckeditor.upload');
    Route::resource('galleries', GalleryController::class);
});

// Run symlink for storage
Route::get('/create-storage', function(){
    // move to component
    // $link = Artisan::call('storage:link', []);
    // if($link) return redirect()->back();
    // return false;
    $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
    symlink($targetFolder,$linkFolder);
    echo 'Symlink process successfully completed';
})->name('storage.link');

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
