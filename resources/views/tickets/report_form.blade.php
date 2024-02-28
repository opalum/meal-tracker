@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tickets Report</h2>
    <form action="{{ route('tickets.report') }}" method="GET">
        @csrf
        <div class="mb-3">
            <label for="report_date" class="form-label">Seleccionar Fecha</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-outline-primary" name="type" value="single">Generar reporte simple</button>
        <button type="submit" class="btn btn-outline-primary" name="type" value="range">Generar Reporte</button>
    </form>
</div>
@endsection

