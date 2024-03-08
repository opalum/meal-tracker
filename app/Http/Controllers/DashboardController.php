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
        $tomorrow = Carbon::tomorrow()->toDateString();

        // Total created tickets today
        $totalCreatedTicketsToday = Ticket::whereDate('valid_for', $today)->count();

        // Total assigned tickets today
        $totalAssignedTicketsToday = Ticket::whereNotNull('user_id')
            ->whereDate('valid_for', $today)
            ->count();

        // Total redeemed tickets today
        $totalRedeemedTicketsToday = Ticket::where('redeemed', true)
            ->whereDate('valid_for', $tomorrow)
            ->count();

        // Total created tickets tomorrow
        $totalCreatedTicketsTomorrow = Ticket::whereDate('valid_for', $today)->count();

        // Total assigned tickets tomorrow
        $totalAssignedTicketsTomorrow = Ticket::whereNotNull('user_id')
            ->whereDate('valid_for', $tomorrow)
            ->count();

        return view('dashboard', compact(
            'totalCreatedTicketsToday',
            'totalAssignedTicketsToday',
            'totalRedeemedTicketsToday',
            'totalCreatedTicketsTomorrow',
            'totalAssignedTicketsTomorrow',
        ));
    }
}
