<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pages extends Controller
{
    public function aboutUs()
    {
        return view('pages.aboutUs');
    }
    public function blog()
    {
        return view('pages.blog');
    }
    public function contactUs()
    {
        return view('pages.contactUs');
    }
}
