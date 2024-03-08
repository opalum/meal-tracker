@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(session('success'))
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-12">
            <h2>Usuarios</h2>
            <a href="{{ route('users.create') }}" class="btn btn-outline-primary float-end">Crear Usuario</a>
            <br />
            <br />
            <br />
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Cédula</th>
                        <th>Grado</th>
                        <th>Grupo</th>
                        <th>Nombres</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th style="width: 220px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->identity }}</td>
                            <td>{{ $user->rank }}</td>
                            <td>{{ $user->group->name ?? 'Ninguno' }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-info btn-sm">Editar</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <div>
                    <ul class="pagination">
                        <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}">&laquo;</a>
                        </li>

                        @foreach(range(1, $users->lastPage()) as $page)
                            <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
