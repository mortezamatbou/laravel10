<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function register(): View
    {
        return view('notes.register', ['title' => 'Register']);
    }

    public function register_handle(Request $request)
    {
        dd($request->input());
    }

}
