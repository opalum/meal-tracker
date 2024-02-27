@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Generar Tickets</h2>

    <form action="{{ route('tickets.generate') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="date" class="form-control" id="valid_for" name="valid_for" required>
            <button type="submit" class="btn btn-outline-primary">Generar Tickets</button>
        </div>
    </form>
</div>
@endsection
