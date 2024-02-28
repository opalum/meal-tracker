@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reporte de Tickets del {{ $startDate->toDateString() }} al {{ $endDate->toDateString() }}</h2>
    @foreach ($reportData as $date => $mealsData)
        <br />
        <h3>{{ $date }}</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Comida</th>
                    <th>Tickets Solicitados</th>
                    <th>Tickets Usados</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mealsData as $mealName => $data)
                    <tr>
                        <td>{{ $mealName }}</td>
                        <td>{{ $data["total_tickets"] }}</td>
                        <td>{{ $data["redeemed_tickets"] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection

