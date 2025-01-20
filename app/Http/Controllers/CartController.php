<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth');
    }
    public function addToCart(Request $request)
    {
        $userId = auth()->id(); // Get the authenticated user ID
        $templateId = $request->input('template_id'); // Get the template ID from the request

        // Check if the user has already added this template to their cart
        $cartItem = Cart::where('user_id', $userId)
                        ->where('template_id', $templateId)
                        ->first();

        if ($cartItem) {
            return response()->json(['error' => 'This template is already in your cart.'], 400);
        }

        // Create a new cart item
        Cart::create([
            'user_id' => $userId,
            'template_id' => $templateId
        ]);

        return response()->json(['success' => 'Template added to cart successfully.']);
    }



public function viewCart()
{
    if (!auth()->user()->can('cart')) {
        return redirect()->back()->with('error', 'Permission denied');
    }
    // Fetch all cart items for the authenticated user
    $userId = auth()->id();
    $cartItems = Cart::where('user_id', $userId)->get();

    // Get the template details for each cart item
    $templates = [];
    foreach ($cartItems as $cartItem) {
        $templates[] = Template::find($cartItem->template_id); // Fetch the template data
    }

    // Pass the templates to the view
    return view('cart.index', compact('templates'));
}
}
