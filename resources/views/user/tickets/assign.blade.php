@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Solicitar Tickets</h2>
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
