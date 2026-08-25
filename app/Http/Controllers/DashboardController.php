<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user         = Auth::user()->load('transactions');
        $transactions = $user->transactions()->latest()->take(5)->get();

        return view('dashboard', compact('user', 'transactions'));
    }
}
