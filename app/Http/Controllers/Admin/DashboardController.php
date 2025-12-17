<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBrands = 0; // Placeholder if you add Brands later

        $totalAllUsers = User::count();
        $totalUser = User::where('role', '0')->count();
        $totalAdmin = User::where('role', '1')->count();

        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at', Carbon::today())->count();
        $monthOrder = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $yearOrder = Order::whereYear('created_at', Carbon::now()->year)->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalAllUsers',
            'totalUser',
            'totalAdmin',
            'totalOrder',
            'todayOrder',
            'monthOrder',
            'yearOrder'
        ));
    }
}