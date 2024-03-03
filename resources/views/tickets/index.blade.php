@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tickets</h2>

    <x-alert-message />

    <div class="d-flex justify-content-center mb-4">
        @php
            $currentDate = \Carbon\Carbon::today()->subWeek();
            $endDate     = \Carbon\Carbon::today()->addWeeks(2);
            $today       = \Carbon\Carbon::today()->format('Y-m-d');
        @endphp

        @while($currentDate->lte($endDate))
            @php
                $dateFormatted = $currentDate->format('M j');
                $dateKey       = $currentDate->format('Y-m-d');
                $hasTickets    = in_array($dateKey, $datesWithTickets);
                $color         = $dateKey === $today ? '#32CD32' : ($hasTickets ? 'black' : 'darkgray');
            @endphp

            <div class="p-2">
                <span style="color: {{ $color }}; font-weight: {{ $hasTickets ? 'bold' : 'normal' }}">
                    {{ $dateFormatted }}
                </span>
            </div>

            @php
                $currentDate->addDay();
            @endphp
        @endwhile
    </div>


    <form action="{{ route('tickets.index') }}" method="GET">
        @csrf
        <div class="input-group mb-3">
            <input type="date" class="form-control" id="valid_for" name="valid_for" value="{{ $validFor ?? '' }}" required>
            <button type="submit" name="action" value="search" class="btn btn-outline-primary">Buscar</button>
            <button type="submit" name="action" value="generate" class="btn btn-outline-primary">Generar Tickets</button>
        </div>
    </form>

    @if(isset($ticketsByMeal))
        @foreach($ticketsByMeal as $mealName => $tickets)
            <br />
            <div>
                <h3>
                    @switch($mealName)
                    @case('Desayuno')
                        <i class="fas fa-coffee"></i>
                        @break
                    @case('Almuerzo')
                        <i class="fas fa-utensils"></i>
                        @break
                    @case('Merienda')
                        <i class="fas fa-mug-hot"></i>
                        @break
                    @endswitch
                    {{ $mealName }}
                </h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Apellidos y Nombres</th>
                            <th>Usado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->code }}</td>
                                <td>{{ $ticket->valid_for }}</td>
                                <td>{{ $ticket->user->name ?? '' }}</td>
                                <td><input type="checkbox" {{ $ticket->redeemed ? 'checked' : '' }} disabled></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>
@endsection

