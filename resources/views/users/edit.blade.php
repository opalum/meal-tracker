@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Usuario</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                             @foreach ($errors->all() as $error)
                                 {{ $error }} <br />
                             @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="identity" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="identity" name="identity" value="{{ $user->identity }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Apellidos y Nombres</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="rank" class="form-label">Grado</label>
                            <input type="text" class="form-control" id="rank" name="rank" value="{{ $user->rank }}">
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
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña (dejar en blanco para mantener la contraseña actual)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label for="role_id">Rol</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
