@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Request Tickets</h2>
    <form action="{{ route('user.tickets.assign') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="valid_for" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="valid_for" name="valid_for" required>
        </div>
        @foreach($meals as $meal)
            <div class="mb-3">
                <input type="checkbox" id="meal_{{ $meal->id }}" name="meals[]" value="{{ $meal->id }}">
                <label for="meal_{{ $meal->id }}">{{ $meal->name }}</label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Request Tickets</button>
    </form>
</div>
@endsection
