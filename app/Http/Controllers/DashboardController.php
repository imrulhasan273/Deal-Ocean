<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function tables()
    {
        return view('dashboard.tables');
    }
}
