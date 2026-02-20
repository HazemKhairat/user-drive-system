<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Admin Dashboard Data
        if ($user->rule_id != 3) {
            $usersCount = \App\Models\User::count();
            $drivesCount = \App\Models\Drive::count();
            $adminsCount = \App\Models\User::where('rule_id', '!=', 3)->count();
            $regularUsers = \App\Models\User::where('rule_id', 3)->count();
            $latestUsers = \App\Models\User::with('rule')->latest()->take(8)->get();

            // System-wide storage breakdown
            $storageBreakdown = [
                'public' => \App\Models\Drive::where('status', 'public')->count(),
                'private' => \App\Models\Drive::where('status', 'private')->count(),
            ];

            return view('dashboard', compact(
                'usersCount',
                'drivesCount',
                'adminsCount',
                'regularUsers',
                'latestUsers',
                'storageBreakdown'
            ));
        }

        // Regular User Dashboard Data
        $userDrivesCount = \App\Models\Drive::where('user_id', $user->id)->count();
        $userPublicCount = \App\Models\Drive::where('user_id', $user->id)->where('status', 'public')->count();
        $userPrivateCount = \App\Models\Drive::where('user_id', $user->id)->where('status', 'private')->count();
        $latestUserDrives = \App\Models\Drive::where('user_id', $user->id)->latest()->take(6)->get();

        return view('dashboard', compact(
            'userDrivesCount',
            'userPublicCount',
            'userPrivateCount',
            'latestUserDrives'
        ));
    }

}
