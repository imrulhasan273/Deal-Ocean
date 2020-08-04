<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Slider;
use App\Product;
use SliderSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::take(5)->get();
        $banners = Banner::take(1)->get();
        $products = Product::take(12)->get();

        $cartItems = DB::table('users')->where('id', auth()->id())->value('cartitems');

        $res = preg_split('/\s+/', $cartItems);
        $itemCount = count($res) - 1;

        return view('home', compact('products', 'sliders', 'banners', 'itemCount'));
    }
    public function contact()
    {
        //Item Count in Cart
        $cartItems = DB::table('users')->where('id', auth()->id())->value('cartitems');
        $res = preg_split('/\s+/', $cartItems);
        $itemCount = count($res) - 1;
        //-------------------

        return view('contact', compact('itemCount'));
    }
}
