@extends('layouts.app')

@php
    setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
@endphp

@section('content')
<div class="container">
    <h2>Seleccionar mes para el reporte</h2>
    <form action="{{ route('user.tickets.monthly_report') }}" method="GET">
        @csrf
        <div class="mb-3">
            <label for="month" class="form-label">Mes</label>
            <select class="form-control" id="month" name="month">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ ucfirst(\Carbon\Carbon::createFromDate(null, $i, null)->locale('es')->isoFormat('MMMM')) }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Año</label>
            <select class="form-control" id="year" name="year">
                @for ($i = now()->year; $i >= now()->year - 10; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-outline-primary">Generar Reporte</button>
    </form>
</div>
@endsection

