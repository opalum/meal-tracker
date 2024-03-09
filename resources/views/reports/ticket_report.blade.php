@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('tickets.summary') }}" method="GET">
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="date" value="{{ $date }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        @if($date)
            <a href="{{ route('tickets.export', ['date' => $date]) }}" class="btn btn-outline-primary mb-3">
                <i class="fa fa-download"></i> Exportar
            </a>
        @endif

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombres</th>
                    <th>Grupo</th>
                    <th>Tickets Asignados</th>
                    <th>Tickets Usados</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['group_name'] }}</td>
                        <td>{{ $user['assigned_tickets'] }}</td>
                        <td>{{ $user['used_tickets'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

