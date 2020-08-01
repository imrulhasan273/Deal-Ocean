<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Coupon;
use App\Product;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use App\Order;
use League\CommonMark\Extension\Table\Table;

class DashboardController extends Controller
{
    function __construct()
    {
        # $this->middleware(['roleChecker:super_admin,admin,seller']);
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function shops()
    {
        # $shops = Shop::all();
        $shops = Shop::with(['seller', 'location'])->get(); //reduce complexity

        return view('dashboard.shops', compact('shops'));
    }

    public function products()
    {
        $products = Product::all();
        return view('dashboard.products', compact('products'));
    }

    public function coupons()
    {
        $coupons = Coupon::all();
        return view('dashboard.coupons', compact('coupons'));
    }

    public function orders()
    {
        $orders = Order::all();
        return view('dashboard.orders', compact('orders'));
    }

    public function icons()
    {
        return view('dashboard.icons');
    }
    public function map()
    {
        return view('dashboard.map');
    }

    public function notification()
    {
        return view('dashboard.notification');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function typography()
    {
        return view('dashboard.typography');
    }
}
