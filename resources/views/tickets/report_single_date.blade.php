@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reporte de tickets para {{ $date }}</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Comida</th>
                <th>Tickets Solicitados</th>
                <th>Tickets Usados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $mealName => $data)
                <tr>
                    <td>{{ $mealName }}</td>
                    <td>{{ $data["total_tickets"] }}</td>
                    <td>{{ $data["redeemed_tickets"] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
