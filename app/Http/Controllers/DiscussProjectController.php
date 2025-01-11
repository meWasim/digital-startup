<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscussProject;

class DiscussProjectController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = DiscussProject::query();

        if ($request->filled('name')) {
            $query->where('full_name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $leads = $query->latest()->get();

        return view('pages.discussProjectDetail', [
            'leads' => $leads,
        ]);
    }
    public function store(Request $request)
    {

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:20',
            'company_name' => 'required|string|max:255',
            'website_url' => 'nullable|string|max:255',
            'project_budget' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['services'] = $request->input('services', []);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        DiscussProject::create($data);

        return redirect()->back()->with('success', 'Project discussion submitted successfully!');
    }
}
