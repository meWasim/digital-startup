<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Mail; // Add this import
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch filter values from the request (optional)
        $name = $request->input('name');
        $email = $request->input('email');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Build the query for fetching messages
        $query = Contact::query();

        // Apply filters if provided
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($email) {
            $query->where('email', 'like', '%' . $email . '%');
        }

        if ($start_date) {
            $query->whereDate('created_at', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('created_at', '<=', $end_date);
        }

        // Get the filtered results with pagination
        $messages = $query->orderByDesc('created_at')->paginate(10);

        // Return view with the filtered messages and the current filter data
        return view('pages.messages', compact('messages', 'name', 'email', 'start_date', 'end_date'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        try {
            // Prepare data in array format
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'contact' => $request->input('contact'),
                'message' => $request->input('message'),
            ];

            // Store contact data
            $contact = Contact::create($data);

            Mail::to($contact->email)->send(new ThankYouMail((object)$data));


            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in Contact Form Submission: ' . $e->getMessage());

            // Return an error response
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
