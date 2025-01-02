<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TemplateController;
use  App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('home');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about.us');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [PageController::class, 'blogDetail'])->name('blog.detail');
Route::post('/blogs/uploadImage', [BlogController::class, 'uploadImage'])->name('blogs.uploadImage');


Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact.us');

Route::middleware(['auth'])->group(function () {
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('blogs', BlogController::class);
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('templates', TemplateController::class);
    });

});
Route::get('template-preview/{templateFolder}', [TemplateController::class, 'preview'])->name('template.preview');
