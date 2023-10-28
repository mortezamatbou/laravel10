<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return 'Route: ' . $request->path();
    }

    public function coins(Request $request)
    {
        return view('coins', ['coins' => ['id' => 1, 'name' => 'Bitcoin', 'symbol' => 'BTC']]);
    }

    public function coin_detail(Request $request, string $symbol): string
    {
        return "<h1>Detail page for $symbol</h1>";
    }

    public function profile(Request $request)
    {
        return 'Route: ' . $request->path();
    }

    public function portfolio(Request $request)
    {
        return 'Route: ' . $request->path();
    }

}
