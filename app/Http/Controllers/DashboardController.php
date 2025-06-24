<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $usersCount = \App\Models\User::count();
    // $rolesCount = \App\Models\Rule::count();
    $drivesCount = \App\Models\Drive::count();
    $adminsCount = \App\Models\User::where('rule_id', '!=', 3)->count(); // assuming rule_id=1 is admin
    $regularUsers = \App\Models\User::where('rule_id', 3)->count();
    $latestUsers = \App\Models\User::latest()->take(5)->get();

    return view('dashboard', compact('usersCount', 'drivesCount', 'adminsCount', 'regularUsers', 'latestUsers'));
}

}
