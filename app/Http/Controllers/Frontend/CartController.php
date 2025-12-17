<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;

        if(Auth::check()) {

            $prod_check = Product::where('id', $product_id)->first();

            if($prod_check) {

                if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . " Already Added to Cart"]);
                } else {
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();

                    return response()->json(['status' => $prod_check->name . " Added to Cart"]);
                }

            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart.index', compact('cartItems'));
    }

    public function deleteProduct(Request $request)
    {
        if(Auth::check()) {
            $product_id = $request->product_id;
            if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                $cartItem = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Product Deleted Successfully"]);
            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }
}