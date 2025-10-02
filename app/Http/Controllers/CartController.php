<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($productId)
    {

        $product = Product::with('store')->findOrFail($productId);

        if (Auth::check()) {
            // Database cart implementation
            $cartItem = CartItem::firstOrCreate([
                'cart_id' => Cart::firstOrCreate(['user_id' => Auth::id()])->id,
                'product_id' => $productId
            ], [
                'quantity' => 1
            ]);

            // If item already existed, increment quantity
            if (! $cartItem->wasRecentlyCreated) {
                $cartItem->increment('quantity');
            }
        } else {
            // Session cart implementation
            $cart = session('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += 1;
            } else {
                $cart[$productId] = [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => 1,
                    "image" => $product->thumbnail,
                    "description" => $product->description,
                    "featured" => $product->features,
                    "sku" => $product->sku,
                    "status" => $product->status,

                ];
            }

            session()->put("cart", $cart);
        }

        return response()->json(['message' => 'Product added to cart successfully.']);
    }

    public function showCart()
    {
        if (Auth::check()) {
            $cart = Auth::user()->cart()->with('items.product')->first();

            if (!$cart) {
                return response()->json([]);
            }

            $cartItems = $cart->items->mapWithKeys(function ($cartItem) {
                return [
                    $cartItem->product_id => [
                        "id" => $cartItem->product_id,
                        "name" => $cartItem->product->name,
                        "price" => $cartItem->product->price,
                        "quantity" => $cartItem->quantity,
                        "image" => $cartItem->product->thumbnail,
                        "description" => $cartItem->product->description,
                        "sku" => $cartItem->product->sku,
                        "status" => $cartItem->product->status,
                        "features" => $cartItem->product->features,
                    ]
                ];
            });

            return response()->json($cartItems);
        }

        $cart = session()->get('cart', []);
        return response()->json($cart);
    }
}
