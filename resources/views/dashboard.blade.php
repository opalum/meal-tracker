@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br />
            @endforeach
        </div>
    @endif

    <div class="row">
        @if(Auth::user()->hasRole('Admin'))
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">Crear, editar y eliminar usuarios.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Ir a usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tickets</h5>
                    <p class="card-text">Administrar tickets.</p>
                    <a href="{{ route('tickets.create') }}" class="btn btn-light">Ir a Tickets</a>
                </div>
            </div>
        </div>
        @endif

        <!-- Other options can be added in a similar manner -->
    </div>
</div>
@endsection

