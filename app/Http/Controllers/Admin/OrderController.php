<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // 1. List All Orders
    public function index()
    {
        // Get all orders, newest first
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // 2. View Order Details
    public function view($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.view', compact('order'));
    }

    // 3. Update Order Status
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->order_status;
        $order->update();

        return redirect('admin/orders')->with('success', 'Order Status Updated Successfully!');
    }
}