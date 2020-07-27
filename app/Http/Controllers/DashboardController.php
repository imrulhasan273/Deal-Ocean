<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use League\CommonMark\Extension\Table\Table;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
        // return view('layouts.backend');
    }

    public function shops()
    {
        // $shops = Shop::all();
        $shops = Shop::with(['seller', 'location'])->get(); //reduce complexity

        return view('dashboard.shops', compact('shops'));
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
