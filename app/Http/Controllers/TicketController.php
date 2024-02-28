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

    public function showRequestForm()
    {
        $meals = Meal::all();
        return view('user.tickets.assign', compact('meals'));
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
            return back()->withErrors(['msg' => 'You cannot request tickets for past dates.']);
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

        return redirect()->route('user.tickets')->with('success', 'Tickets requested successfully.');
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

        $ticket->redeemed = true;
        $ticket->save();

        return back()->with('success', 'El ticket ha sido procesado correctamente.');
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function generate(Request $request)
    {
        $request->validate(['valid_for' => 'required|date']);

        $diners = User::whereHas('role', function ($query) {
            $query->where('name', 'Comensal');
        })->get();

        if (Ticket::where('valid_for', $request->valid_for)->exists()) {
            return redirect()->route('dashboard')
                             ->with('error', 'Los tickets para esta fecha ya existen.');
        }

        $meals = Meal::all();

        foreach ($diners as $diner) {
            foreach ($meals as $meal) {
                Ticket::create([
                    'code'      => Ticket::generateCode(),
                    'valid_for' => $request->valid_for,
                    'meal_id'   => $meal->id,
                ]);
            }
        }

        return redirect()->route('dashboard')
                         ->with('success', 'Tickets generados exitosamente');
    }
}
