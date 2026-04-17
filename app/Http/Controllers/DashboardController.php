<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('dashboard',[
            "income" => $user->transactions()->where('type', 'income')->sum('amount'),
            "expense" => $user->transactions()->where('type', 'expense')->sum('amount'),
            "transactions" => $user->transactions()->latest()->take(5)->get(),
            "categories" => Category::all(),
            "balance" => $user->transactions()->where('type', 'income')->sum('amount') - $user->transactions()->where('type', 'expense')->sum('amount')
        ]);
    }
}
