{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Auth::user()->hasRole('Administrator'))
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Manage</div>
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">Create, edit, and delete users.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Go to Users</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Manage</div>
                <div class="card-body">
                    <h5 class="card-title">Tickets</h5>
                    <p class="card-text">Generate tickets.</p>
                    <a href="{{ route('tickets.create') }}" class="btn btn-light">Go to Tickets</a>
                </div>
            </div>
        </div>
        @endif

        <!-- Other options can be added in a similar manner -->
    </div>
</div>
@endsection

