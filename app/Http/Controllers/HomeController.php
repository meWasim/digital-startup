<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get three random templates from the database
        $templates = Template::inRandomOrder()->take(8)->get();

        // Pass the templates to the view
        return view('home', compact('templates'));
    }





}
