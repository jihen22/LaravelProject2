<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{  
     public function dashboard()
    {
        $user = Auth::user();
        $nameproject = $user->nameproject;

        return view('admin.dashboard', compact('nameproject'));
    }
    
}
