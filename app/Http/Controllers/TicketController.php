<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Ticket;
use App\Models\User;
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
