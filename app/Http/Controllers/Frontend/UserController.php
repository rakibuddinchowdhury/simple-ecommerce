<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF Facade

class UserController extends Controller
{
    // 1. List all orders for the logged-in user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('frontend.orders.index', compact('orders'));
    }

    // 2. View specific order details
    public function view($order_id)
    {
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->first();

        if ($order) {
            return view('frontend.orders.view', compact('order'));
        } else {
            return redirect()->back()->with('error', 'Order not found');
        }
    }

    // 3. Generate PDF Invoice
    public function generateInvoice($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Security Check: Ensure the logged-in user owns this order
        if(Auth::id() != $order->user_id){
             return redirect()->back()->with('error', 'Unauthorized Access');
        }

        $data = ['order' => $order];
        
        $todayDate = now()->format('d-m-Y');
        
        $pdf = Pdf::loadView('frontend.orders.invoice', $data);
        
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }
}