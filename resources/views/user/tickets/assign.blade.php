@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Solicitar Tickets</h2>

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

    <form action="{{ route('user.tickets.assign') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="valid_for" class="form-label">Seleccione Fecha</label>
            <input type="date" class="form-control" id="valid_for" name="valid_for" value="{{ $validFor ?? '' }}" required>
        </div>
        @foreach($meals as $meal)
            <div class="mb-3">
                <input type="checkbox" id="meal_{{ $meal->id }}" name="meals[]" value="{{ $meal->id }}">
                <label for="meal_{{ $meal->id }}">{{ $meal->name }}</label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Solicitar</button>
    </form>
</div>
@endsection
