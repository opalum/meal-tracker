@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tickets</h2>

    <form action="{{ route('tickets.index') }}" method="GET">
        @csrf
        <div class="input-group mb-3">
            <input type="date" class="form-control" id="valid_for" name="valid_for" required>
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </div>
        <a href="{{ route('tickets.create') }}" class="btn btn-outline-secondary">Generar Tickets</a>
    </form>

    @if(isset($ticketsByMeal))
        @foreach($ticketsByMeal as $mealName => $tickets)
            <div class="mt-5">
                <h3>{{ $mealName }}</h3>
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

