@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Generate Meal Tickets</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br />
            @endforeach
        </div>
    @endif

    <form action="{{ route('tickets.generate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="valid_for" class="form-label">Date</label>
            <input type="date" class="form-control" id="valid_for" name="valid_for" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Tickets</button>
    </form>
</div>
@endsection

