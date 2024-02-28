<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDailySummary()
    {
        $today = Carbon::today()->toDateString();

        // Total created tickets today
        $totalCreatedTickets = Ticket::whereDate('valid_for', $today)->count();

        // Total assigned tickets today
        $totalAssignedTickets = Ticket::whereNotNull('user_id')
            ->whereDate('valid_for', $today)
            ->count();

        // Total redeemed tickets today
        $totalRedeemedTickets = Ticket::where('redeemed', true)
            ->whereDate('valid_for', $today)
            ->count();

        return view('dashboard', compact('totalCreatedTickets', 'totalAssignedTickets', 'totalRedeemedTickets'));
    }
}
