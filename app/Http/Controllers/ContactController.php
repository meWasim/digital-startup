<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:15',
        'subject' => 'nullable|string|max:255',
        'message' => 'nullable|string',
    ]);

    // Add authenticated user's ID and template ID
    $data['user_id'] = auth()->id();
    $data['template_id'] = $request->template_id; // Ensure this field is passed in the request

    // Save the data into the database
    ContactUs::create($data);

    return back()->with('success', 'Thank you for contacting us!');
}
}
