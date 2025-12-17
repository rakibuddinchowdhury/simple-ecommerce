<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if($cartItems->count() == 0){
             return redirect('/cart'); 
        }
        return view('frontend.checkout.index', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'zipcode' => 'required|string',
            'payment_mode' => 'required'
        ]);

        // 1. Calculate Total Amount
        $total = 0;
        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems as $item){
            $price = $item->product->discount_price ?? $item->product->price;
            $total += $price * $item->product_qty;
        }

        // 2. Handle Stripe Payment
        if($request->payment_mode == 'STRIPE') {
            
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Online Order from MyShop',
                        ],
                        'unit_amount' => $total * 100, // Stripe expects cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // Pass form data as query params to success URL to save order later
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}&fullname='.$request->fullname.'&phone='.$request->phone.'&address='.$request->address.'&city='.$request->city.'&zipcode='.$request->zipcode,
                'cancel_url' => route('payment.cancel'),
            ]);

            return redirect($checkout_session->url);
        }

        // 3. Handle COD Order (Default)
        $order = $this->createOrder($request, $total, 'COD', 'Pending');
        return redirect('my-orders')->with('success', 'Order Placed Successfully via COD!');
    }

    // Helper: Success Callback from Stripe
    public function paymentSuccess(Request $request) 
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::retrieve($request->get('session_id'));

        if($session->payment_status == 'paid') {
            // Calculate total again or retrieve from session metadata if implementing robustly
            // For simplicity, we recalculate based on Cart
            $total = 0;
            $cartItems = Cart::where('user_id', Auth::id())->get();
            foreach($cartItems as $item){
                $price = $item->product->discount_price ?? $item->product->price;
                $total += $price * $item->product_qty;
            }

            // Create Order
            $this->createOrder($request, $total, 'Paid by Stripe', $session->payment_intent);

            return redirect('my-orders')->with('success', 'Payment Successful! Order Placed.');
        } else {
             return redirect('checkout')->with('error', 'Payment Failed.');
        }
    }

    public function paymentCancel()
    {
        return redirect('checkout')->with('error', 'Payment Cancelled.');
    }

    // Private Helper to Save Order to DB
    private function createOrder($request, $total, $mode, $payment_id) 
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fullname = $request->fullname;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->zipcode = $request->zipcode;
        
        $order->tracking_no = 'ORD-'.rand(1111,9999);
        $order->payment_mode = $mode;
        $order->payment_id = $payment_id;
        $order->status = '0'; // Pending
        $order->total_price = $total;
        $order->save();

        // Move Cart to Order Items
        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->product->discount_price ?? $item->product->price,
            ]);
            
            // Decrease Stock
            $prod = $item->product;
            $prod->stock_quantity = $prod->stock_quantity - $item->product_qty;
            $prod->update();
        }

        // Clear Cart
        Cart::destroy($cartItems);

        return $order;
    }
}