<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Order;
use App\Coupon;
use App\Region;
use App\Country;
use App\Product;
use App\Location;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\DB;
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

    public function regions()
    {
        $regions = Region::all();

        // dd($regions);

        return view('dashboard.regions', compact('regions'));
    }
    public function countries()
    {
        $countries = Country::all();

        return view('dashboard.countries', compact('countries'));
    }
    public function locations()
    {
        $locations = Location::all();

        return view('dashboard.locations', compact('locations'));
    }
    public function shops()
    {
        # $shops = Shop::all();
        $shops = Shop::with(['seller'])->get(); //reduce complexity

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
