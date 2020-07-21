<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Slider;
use App\Product;
use SliderSeeder;
use Illuminate\Http\Request;

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
        $sliders = Slider::take(3)->get();
        $banners = Banner::take(1)->get();
        // dd($sliders);
        $products = Product::take(12)->get();

        return view('home', compact('products', 'sliders', 'banners'));
    }
    public function contact()
    {
        return view('contact');
    }
}
