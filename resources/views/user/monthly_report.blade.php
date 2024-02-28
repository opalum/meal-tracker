@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reporte mensual para {{ $month }}</h2>

    <br />
    <h4>Resumen</h4>
    <p>Tickets Solicitados: {{ $summary['total_requested'] }}</p>
    <p>Tickets Usuados: {{ $summary['total_redeemed'] }}</p>

    <br />
    <h4>Detalles</h4>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Comida</th>
                <th>Usado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailedTickets as $ticket)
                <tr>
                    <td>{{ $ticket['date'] }}</td>
                    <td>{{ $ticket['meal'] }}</td>
                    <td>{{ $ticket['redeemed'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

