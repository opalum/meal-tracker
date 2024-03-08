@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Usuario</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                             @foreach ($errors->all() as $error)
                                 {{ $error }} <br />
                             @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="identity" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="identity" name="identity" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Apellidos y Nombres</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="rank" class="form-label">Grado</label>
                            <input type="text" class="form-control" id="rank" name="rank" required>
                        </div>

                        <div class="mb-3">
                            <label for="group_id" class="form-label">Grupo</label>
                            <select class="form-control" id="group_id" name="group_id">
                                <option value="">Ninguno</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" @if(isset($user) && $user->group_id == $group->id) selected @endif>{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="role_id" class="form-label">Rol</label>
                            <select class="form-control" id="role_id" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

