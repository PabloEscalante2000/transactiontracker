<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view("auth.login");
    }

    public function store(LoginRequest $request)
    {

        if (Auth::attempt($request->only("email", "password"))) {
            $request->session()->regenerate();
            return redirect()->intended(route("dashboard"));
        }

        return back()->withErrors([
            "email" => "The provided credentials do not match our records."
        ]);
    }
}
