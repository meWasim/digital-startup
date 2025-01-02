<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TemplateController;

Route::get('/', function () {
    return view('home');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/about-us', [Pages::class, 'aboutUs'])->name('about.us');
Route::get('/blog', [Pages::class, 'blog'])->name('blog');
Route::get('/contact-us', [Pages::class, 'contactUs'])->name('contact.us');

Route::middleware(['auth'])->group(function () {
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('templates', TemplateController::class);
    });

});
// Route::get('template-preview/{templateFolder}', [TemplateController::class, 'preview'])->name('template.preview');

// Route::get('thumbnails/{filename}', function ($filename) {
//     $path = storage_path('app/public/thumbnails/' . $filename);

//     if (!file_exists($path)) {
//         abort(404);
//     }
//     Route::get('template-master/{folder}', function ($folder) {
//         $path = public_path('templates-master/' . $folder);

//         if (!File::isDirectory($path)) {
//             abort(404, 'Folder not found.');
//         }

//         // Serve an index file or list the contents
//         return redirect(asset('templates-master/' . $folder));
//     });
//     return response()->file($path);
// });



Route::get('/template-preview/{folder}', [TemplateController::class, 'preview'])->name('admin.templates.preview');

