@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis Tickets</h2>
    <x-alert-message />
    <form action="{{ route('user.tickets') }}" method="GET">
        <div class="input-group mb-3">
            <input type="date" class="form-control" id="valid_for" name="valid_for" value="{{ $validFor ?? '' }}" required>
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </div>
    </form>

    @if(isset($tickets) && $tickets->isNotEmpty())
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Usado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->code }}</td>
                        <td>{{ $ticket->valid_for }}</td>
                        <td>{{ $ticket->meal->name }}</td>
                        <td>{{ $ticket->redeemed ? 'Si' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

