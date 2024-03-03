<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Ticket;
use App\Models\User;

use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $validFor = $request->input('valid_for');
        $ticketsByMeal = [];
        $action = $request->input('action');

        if ($action == 'search') {
            $ticketsByMeal = $this->searchTickets($request);
        } elseif ($action == 'generate') {
            $ticketsByMeal = $this->generateTickets($request);
        }

        $datesWithTickets = $this->datesWithTickets();

        return view('tickets.index', compact('ticketsByMeal', 'validFor', 'datesWithTickets'));
    }

    private function datesWithTickets()
    {
        $startDate = Carbon::today()->subWeek();
        $endDate   = Carbon::today()->addWeeks(2);

        return Ticket::whereBetween('valid_for', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                              ->select('valid_for')
                              ->distinct()
                              ->get()
                              ->pluck('valid_for')
                              ->map(function ($date) {
                                  return $date;
                              })
                              ->toArray();
    }

    private function searchTickets(Request $request)
    {
        $ticketsByMeal = [];

        if ($request->has('valid_for')) {
            $date = $request->input('valid_for');

            $tickets = Ticket::with(['meal', 'user'])
                ->whereDate('valid_for', $date)
                ->get()
                ->groupBy('meal.name');

            $ticketsByMeal = $tickets;
        }

        return $ticketsByMeal;
    }

    private function generateTickets(Request $request)
    {
        $request->validate(['valid_for' => 'required|date']);

        $diners = User::whereHas('role', function ($query) {
            $query->where('name', 'Comensal');
        })->get();

        if (Ticket::where('valid_for', $request->valid_for)->exists()) {
            session()->flash('error', 'Los tickets para esta fecha ya existen.');
            $existingTickets = Ticket::with(['meal', 'user'])
                ->whereDate('valid_for', $request->valid_for)
                ->get()
                ->groupBy('meal.name');

            return $existingTickets;
        }

        $meals = Meal::all();

        foreach ($diners as $diner) {
            foreach ($meals as $meal) {
                $ticket = Ticket::create([
                    'code'      => Ticket::generateCode(),
                    'valid_for' => $request->valid_for,
                    'meal_id'   => $meal->id
                ]);
            }
        }

        session()->flash('success', 'Tickets generados exitosamente.');
        $tickets = Ticket::with(['meal', 'user'])
            ->whereDate('valid_for', $request->valid_for)
            ->get()
            ->groupBy('meal.name');

        return $tickets;
    }

    public function indexe(Request $request)
    {
        $ticketsByMeal = [];

        if ($request->has('valid_for')) {
            $date = $request->input('valid_for');

            $tickets = Ticket::with(['meal', 'user'])
                ->whereDate('valid_for', $date)
                ->get()
                ->groupBy('meal.name');

            $ticketsByMeal = $tickets;
        }

        return view('tickets.index', compact('ticketsByMeal'));
    }

    public function showRequestForm(Request $request)
    {
        $validFor = $request->input('valid_for');
        $meals = Meal::all();
        return view('user.tickets.assign', compact('meals', 'validFor'));
    }

    public function showAssignedTickets(Request $request)
    {
        $validFor = $request->input('valid_for');
        $user = auth()->user();
        $tickets = collect();

        if ($validFor) {
            $date = Carbon::createFromFormat('Y-m-d', $validFor);
            $tickets = Ticket::where('valid_for', $date)
                ->where('user_id', $user->id)
                ->with(['meal', 'user'])
                ->get();
        }

        return view('user.tickets.index', compact('tickets', 'validFor'));
    }

    public function handleRequest(Request $request)
    {
        $validFor = $request->input('valid_for');
        $mealIds = $request->input('meals', []);
        $user = auth()->user();
        $date = Carbon::createFromFormat('Y-m-d', $validFor);

        if ($date->isPast()) {
            return redirect()->route('user.tickets', ['valid_for' => $validFor])->with('error', 'No se pueden solicitar tickets para una fecha anterior.');
        }

        foreach ($mealIds as $mealId) {
            $existingTicket = Ticket::where('valid_for', $validFor)
                ->where('user_id', $user->id)
                ->where('meal_id', $mealId)
                ->first();

            if ($existingTicket) {
                continue;
            }

            $ticket = Ticket::where('valid_for', $validFor)
                ->whereNull('user_id')
                ->where('meal_id', $mealId)
                ->first();

            if ($ticket) {
                $ticket->user_id = $user->id;
                $ticket->save();
            }
        }

        return redirect()->route('user.tickets', ['valid_for' => $validFor])->with('success', 'Tickets solicitados exitosamente.');
    }

    public function showRedeemForm()
    {
        return view('tickets.redeem');
    }

    public function redeemTicket(Request $request)
    {
        $code = $request->input('code');
        $ticket = Ticket::where('code', $code)->first();

        if (!$ticket) {
            return back()->withErrors(['msg' => 'El ticket no fue encontrado.']);
        }

        if (!$ticket->user_id) {
            return back()->withErrors(['msg' => 'Este ticket no está asignado a ningún usuario']);
        }

        if ($ticket->redeemed) {
            return back()->withErrors(['msg' => 'Este ticket ya ha sido usado.']);
        }

        $currentDate = now()->toDateString();
        if ($ticket->valid_for != $currentDate) {
            return back()->withErrors(['msg' => 'Este ticket no es válido para hoy.']);
        }

        $ticket->redeemed = true;
        $ticket->save();

        return back()->with('success', 'El ticket ha sido procesado correctamente.');
    }

    public function showReportForm()
    {
        return view('tickets.report_form');
    }

    public function generateReport(Request $request)
    {
        $reportType = $request->input('type');
        $date = $request->input('date');

        if ($reportType === 'single') {
            return $this->generateSingleDateReport($request);
        } elseif ($reportType === 'range') {
            return $this->generateDateRangeReport($request);
        } else {
            return back()->withErrors(['msg' => 'Invalid report type selected.']);
        }
    }

    public function generateSingleDateReport(Request $request)
    {
        $date = $request->input('date');
        // Fetch all tickets for the date that have been assigned to a user
        $tickets = Ticket::where('valid_for', $date)
            ->whereNotNull('user_id')
            ->get();

        $groupedTickets = $tickets->groupBy('meal_id');

        $meals = Meal::all();
        $reportData = [];
        foreach ($meals as $meal) {
            if (isset($groupedTickets[$meal->id])) {
                $mealTickets = $groupedTickets[$meal->id];
                $totalTickets = $mealTickets->count();
                // Count how many of these tickets have been redeemed
                $redeemedTickets = $mealTickets->where('redeemed', true)->count();
            } else {
                $totalTickets = 0;
                $redeemedTickets = 0;
            }

            // Store the data in the reportData array with total and redeemed ticket counts
            $reportData[$meal->name] = [
                'total_tickets' => $totalTickets,
                'redeemed_tickets' => $redeemedTickets
            ];
        }

        return view('tickets.report_single_date', compact('reportData', 'date'));
    }

    public function generateDateRangeReport(Request $request)
    {
        $date = $request->input('date');
        $startDate = Carbon::createFromFormat('Y-m-d', $date)->subDays(2);
        $endDate = Carbon::createFromFormat('Y-m-d', $date)->addDays(2);

        $tickets = Ticket::whereBetween('valid_for', [$startDate, $endDate])
            ->whereNotNull('user_id')
            ->get();

        // Group tickets first by date then by meal
        $groupedTickets = $tickets->groupBy(function ($ticket) {
            return $ticket->valid_for;
        });

        $meals = Meal::all();
        $reportData = [];
        foreach ($groupedTickets as $date => $ticketsForDate) {
            foreach ($meals as $meal) {
                $mealTickets = $ticketsForDate->where('meal_id', $meal->id);
                $totalTickets = $mealTickets->count();
                $redeemedTickets = $mealTickets->where('redeemed', true)->count();

                // Store the data in the reportData array with total and redeemed ticket counts
                $reportData[$date][$meal->name] = [
                    'total_tickets' => $totalTickets,
                    'redeemed_tickets' => $redeemedTickets
                ];
            }
        }

        return view('tickets.report_date_range', compact('reportData', 'startDate', 'endDate'));
    }

    public function monthlyReportForUser(Request $request)
    {
        $user = auth()->user();
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
        $month = "$selectedYear-$selectedMonth"; // e.g., "2024-02"
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        $tickets = Ticket::where('user_id', $user->id)
            ->whereBetween('valid_for', [$startDate, $endDate])
            ->get();

        // Prepare data for the summary
        $summary = [
            'total_requested' => $tickets->count(),
            'total_redeemed' => $tickets->where('redeemed', true)->count(),
        ];

        // Prepare detailed ticket information
        $detailedTickets = $tickets->map(function ($ticket) {
            return [
                'date' => $ticket->valid_for,
                'meal' => $ticket->meal->name,
                'redeemed' => $ticket->redeemed ? 'Si' : 'No',
            ];
        });

        return view('user.monthly_report', compact('detailedTickets', 'summary', 'month'));
    }
}
