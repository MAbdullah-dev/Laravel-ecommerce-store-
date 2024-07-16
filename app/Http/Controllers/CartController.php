<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ],
            [
                'quantity' => $request->quantity
            ]
        );

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function getCart()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartItems'));
    }

    public function removeCartItem($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->firstOrFail();
        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart successfully']);
    }

    public function updateCartItem(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->firstOrFail();
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart item updated successfully']);
    }
}
