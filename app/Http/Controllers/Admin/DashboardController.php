<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dish;
use App\User;

class DashboardController extends Controller
{
    public function index(){
        return view('admin/dashboard');
    }

    public function stats(){
        $dishes = Dish::where('user_id', Auth::id())->get();

        return view('admin/stats', compact('dishes'));
    }
}
