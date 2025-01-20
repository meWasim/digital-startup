<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index()
    {
        try {
            $blogs = Blog::query()
            ->when(Auth::user()->role == 'admin', function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->when(Auth::user()->role != 'admin', function ($query) {
                $authorName = Auth::user()->Fname . ' ' . Auth::user()->Lname;
                $query->where('author', $authorName)
                      ->orderBy('created_at', 'desc');
            })
            ->get();

            return view('blogs.index', compact('blogs'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function create()
    {
        try {
            return view('blogs.create');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {dd($request->all());
        $author = Auth::user();

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $imagePath = null;

            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('images', 'public');
            }

            Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
                'author' => $author->Fname . ' ' . $author->Lname,
                'featured_image' => $imagePath,
            ]);

            return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Blog $blog)
    {
        try {
            return view('blogs.show', compact('blog'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Blog $blog)
    {
        try {
            return view('blogs.edit', compact('blog'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Blog $blog)
    {
        $author= Auth::user();
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $imagePath = $blog->featured_image;

            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('images', 'public');
            }

            $blog->update([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
                'author' => $author->Fname . ' ' . $author->Lname,
                'featured_image' => $imagePath,
            ]);

            return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            if ($blog->featured_image) {
                Storage::delete('public/' . $blog->featured_image);
            }

            $blog->delete();

            return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/blogs', $filename, 'public');

            $url = Storage::url($path);

            return response()->json([
                'uploaded' => true,
                'url' => $url,
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'No file uploaded.',
            ],
        ]);
    }
}
