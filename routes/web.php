<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use  App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiscussProjectController;

Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about.us');
Route::get('/logo-design', [PageController::class, 'logoDesign'])->name('logo.design');
Route::get('/graphic-design', [PageController::class, 'graphicDesign'])->name('graphic.design');
Route::get('/website-design', [PageController::class, 'websiteDesign'])->name('website.design');
Route::get('/brochure-design', [PageController::class, 'brochureDesign'])->name('brochure.design');
Route::get('/mobile-application', [PageController::class, 'mobileApplication'])->name('mobile.application');
Route::get('/crm', [PageController::class, 'crm'])->name('crm');
Route::get('/digital-marketing', [PageController::class, 'digitalMarketing'])->name('digital.marketing');
Route::get('/hosting-service', [PageController::class, 'hostingService'])->name('hosting.service');
Route::get('/domain-purchase', [PageController::class, 'domainPurchase'])->name('domain.purchase');
Route::get('/fb-ads', [PageController::class, 'fbAds'])->name('fbads');
Route::get('/google-ads', [PageController::class, 'googleAds'])->name('googleads');
Route::get('/twitter-ads', [PageController::class, 'twitterAds'])->name('twitterads');







Route::get('/discuss-project', [PageController::class, 'discussProject'])->name('discuss.project');
Route::post('/discuss-project', [DiscussProjectController::class, 'store'])->name('discuss-project.store');
Route::get('/discuss-project/Details', [DiscussProjectController::class, 'index'])->name('discuss-project.index');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [PageController::class, 'blogDetail'])->name('blog.detail');
Route::post('/blogs/uploadImage', [BlogController::class, 'uploadImage'])->name('blogs.uploadImage');


Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact.us');

Route::middleware(['auth'])->group(function () {
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('users', UserController::class);
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('templates', TemplateController::class);
    });
});
Route::resource('contacts', ContactController::class);
Route::get('template-preview/{templateFolder}', [TemplateController::class, 'preview'])->name('template.preview');
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
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/template/{template}/edit', [TemplateController::class, 'edit_template'])->name('template.edit');
Route::post('/update-template/{template}', [TemplateController::class, 'update_user'])->name('template_section.update');
Route::domain('{subdomain}.digitalStartups.com')->group(function () {
    Route::get('/', [TemplateController::class, 'showUserTemplate'])->name('user.template.preview');
});



use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    try {
        Mail::raw('Hii this is tax seve kendra , thankyou to give your qutation our executive will reach you soon within 48hr', function ($message) {
            $message->to('alfwasim@gmail.com')->subject('Thankyou for contacting us');
        });
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
