@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('error') }}
        </div>
    @endif

    @if(Auth::user()->hasRole('Admin'))
    <div class="row">
        <!-- Created Tickets Card -->
        <div class="col-md-4">
            <div class="card bg-secondary mb-3">
                <div class="card-header">TICKETS CREADOS</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center card-today">
                            <p class="card-title card-summary"><i class="fas fa-ticket-alt"></i> {{ $totalCreatedTicketsToday }}</p>
                            <p class="card-text">HOY</p>
                        </div>
                        <div class="col text-center">
                            <p class="card-title card-summary"><i class="fas fa-ticket-alt"></i> {{ $totalCreatedTicketsTomorrow }}</p>
                            <p class="card-text">MAÑANA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assigned Tickets Card -->
        <div class="col-md-4">
            <div class="card bg-secondary mb-3">
                <div class="card-header">TICKETS ASIGNADOS</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center card-today">
                            <p class="card-title card-summary"><i class="fas fa-user-check"></i> {{ $totalAssignedTicketsToday }}</p>
                            <p class="card-text">HOY</p>
                        </div>
                        <div class="col text-center">
                            <p class="card-title card-summary"><i class="fas fa-user-check"></i> {{ $totalAssignedTicketsTomorrow }}</p>
                            <p class="card-text">MAÑANA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Redeemed Tickets Card -->
        <div class="col-md-4">
            <div class="card bg-secondary mb-3">
                <div class="card-header">TICKETS USADOS</div>
                <div class="card-body text-center card-today">
                    <p class="card-title card-summary"><i class="fas fa-check-circle"></i> {{ $totalRedeemedTicketsToday }}</p>
                    <p class="card-text">TOTAL DE TICKETS USADOS HOY.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        @if(Auth::user()->hasRole('Admin'))
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Crear, editar y eliminar usuarios.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-light">Ir a usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tickets</h5>
                    <p class="card-text">Administrar tickets.</p>
                    <a href="{{ route('tickets.index', ['valid_for' => Carbon\Carbon::now()->format('Y-m-d'), 'action' => 'search']) }}" class="btn btn-outline-light">Ir a tickets</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-text">Reportes de tickets.</p>
                    <a href="{{ route('tickets.report.form') }}" class="btn btn-outline-light">Ir a reportes</a>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        @if(Auth::user()->hasRole('Comensal'))
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Mis Tickets</h5>
                    <p class="card-text">Consultar mis tickets</p>
                    <a href="{{ route('user.tickets', ['valid_for' => Carbon\Carbon::now()->format('Y-m-d')]) }}" class="btn btn-outline-light">Ir a mis tickets</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Solicitar Tickets</h5>
                    <p class="card-text">Solicitar tickets para la comida.</p>
                    <a href="{{ route('user.tickets.show.assign', ['valid_for' => \Carbon\Carbon::tomorrow()->format('Y-m-d')]) }}" class="btn btn-outline-light">Solicitar tickets</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-text">Reportes de tickets.</p>
                    <a href="{{ route('user.tickets.select_monthly_report') }}" class="btn btn-outline-light">Ir a reportes</a>
                </div>
            </div>
        </div>

        @endif
    </div>
    <div class="row">
        @if(Auth::user()->hasRole('Admin'))
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Canjear Tickets</h5>
                    <p class="card-text">Validar y canjear Tickets</p>
                    <a href="{{ route('tickets.redeem.show') }}" class="btn btn-outline-light">Canjear tickets</a>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        @if(Auth::user()->hasRole('Cocinero'))
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-text">Reportes de tickets.</p>
                    <a href="{{ route('tickets.report.form') }}" class="btn btn-light">Ir a reportes</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

