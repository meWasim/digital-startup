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
    public function blog(Request $request)
    {
        $query = Blog::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('author')) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $blogs = $query->orderBy('id', 'desc')->get();

        return view('pages.blog', [
            'blogs' => $blogs
        ]);
    }
    public function blogDetail($slug)
    {

        $blog = Blog::where('slug', $slug)->firstOrFail();


        $popularBlogs = Blog::inRandomOrder()->take(3)->get();


        return view('pages.blog-detail', compact('blog', 'popularBlogs'));
    }
    public function contactUs()
    {
        return view('pages.contactUs');
    }
    public function discussProject()
    {
        return view('pages.discussProject');
    }
    public function logoDesign()
    {
        return view('pages.logoDesign');
    }
    public function graphicDesign()
    {
        return view('pages.graphicDesign');
    }
    public function websiteDesign()
    {
        return view('pages.websiteDesign');
    }
    public function brochureDesign()
    {
        return view('pages.brochureDesign');
    }
    public function mobileApplication()
    {
        return view('pages.mobileApplication');
    }
    public function crm()
    {
        return view('pages.crm');
    }
    public function digitalMarketing()
    {
        return view('pages.digitalMarketing');
    }
    public function domainPurchase()
    {
        return view('pages.domainPurchase');
    }
    public function hostingService()
    {
        return view('pages.hostingService');
    }
    public function fbAds()
    {
        return view('pages.fbAds');
    }
    public function googleAds()
    {
        return view('pages.googleAds');
    }
    public function twitterAds()
    {
        return view('pages.twitterAds');
    }
}
