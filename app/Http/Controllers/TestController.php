<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    function __construct()
    {
        $this->middleware('mytoken')->except('index');
    }

    /**
     * Handle the incoming request.
     */
    public function index(Request $request): string
    {
        return $request->path();
    }

    public function options(Request $request): string
    {
        return $request->path();
    }

    public function methods(Request $request, string $name): string
    {
        return $request->path() . ' ' . "name<<b>$name</b>>";
    }


}
