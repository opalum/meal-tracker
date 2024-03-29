@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                             @foreach ($errors->all() as $error)
                                 {{ $error }} <br />
                             @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email o Cédula') }}</label>
                            <input type="text" class="form-control" name="email" id="email" required autofocus placeholder="Email o Cédula">
                            <div class="form-text">Use su usuario o cédula para ingresar.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">{{ __('Recordar') }}</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-primary">{{ __('Ingresar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
