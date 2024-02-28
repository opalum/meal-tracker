@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Redeem Ticket</h2>

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form action="{{ route('tickets.redeem') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        <button type="submit" class="btn btn-outline-primary">Usar Ticket</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
</div>
@endsection

