<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Ticket;
use App\Models\User;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create()
    {
        return view('tickets.create');
    }

    public function generate(Request $request)
    {
        $request->validate(['valid_for' => 'required|date']);

        $diners = User::whereHas('role', function ($query) {
            $query->where('name', 'Diner');
        })->get();

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

        return back()->with('success', 'Tickets generated successfully.');
    }
}
