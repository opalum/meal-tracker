@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles de usuario</div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>Cédula:</strong>
                        {{ $user->identity }}
                    </div>

                    <div class="mb-3">
                        <strong>Apellidos y Nombres:</strong>
                        {{ $user->name }}
                    </div>

                    <div class="mb-3">
                        <strong>Grado</strong>
                        {{ $user->rank }}
                    </div>

                    <div class="mb-3">
                        <strong>Grupo:</strong>
                        {{ $user->group->name ?? 'Ninguno' }}
                    </div>

                    <div class="mb-3">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>

                    <div class="mb-3">
                        <strong>Teléfono:</strong>
                        {{ $user->phone }}
                    </div>

                    <div class="mb-3">
                        <strong>Rol:</strong>
                        {{ $user->role->name }}
                    </div>

                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
