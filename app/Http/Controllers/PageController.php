<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class PageController extends Controller
{
    public function aboutUs()
    {
        return view('pages.aboutUs');
    }
    public function blog()
    {
        $blogs=Blog::all();

        return view('pages.blog',[
            'blogs'=>$blogs
        ]);
    }
    public function blogDetail($slug)
    {

        $blog = Blog::where('slug', $slug)->firstOrFail();


        $popularBlogs = Blog::inRandomOrder()->take(5)->get();


        return view('pages.blog-detail', compact('blog', 'popularBlogs'));
    }
    public function contactUs()
    {
        return view('pages.contactUs');
    }
}
