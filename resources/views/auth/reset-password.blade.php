@extends('layouts.app')

@section('title', 'Restablecer Contraseña')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <!-- Tarjeta para Restablecer Contraseña -->
    <div class="card p-5 shadow-lg rounded-4" style="width: 380px;">
        <h2 class="text-center mb-4">Restablecer Contraseña</h2>
        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('password.update', ['token' => $token]) }}" method="POST">
            @csrf
            @method('PUT') <!-- Emula un PUT request -->
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label for="password" class="form-label text-muted">Nueva Contraseña</label>
                <input type="password" class="form-control input-style" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label text-muted">Confirmar Contraseña</label>
                <input type="password" class="form-control input-style" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn w-100 py-2 rounded-pill mt-4 btn-hover ltw">Restablecer Contraseña</button>
        </form>
    </div>
</div>

<style>
    /* Fondo y efectos para el contenedor */
    body {
        background: linear-gradient(to right, #ff8200, #ff8200); /* Usando los colores institucionales */
    }

    /* Estilos para la tarjeta de restablecer contraseña */
    .card {
        background: #ffffff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    /* Título */
    .card h2 {
        font-weight: bold;
        color: #ff8200; /* Color institucional en el título */
    }

    /* Estilos para los inputs */
    .input-style {
        border-radius: 10px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .input-style:focus {
        border-color: #ff8200; /* Resalta el borde con color institucional */
        box-shadow: 0 0 5px rgba(255, 130, 0, 0.5);
    }

    /* Botón */
    .btn-hover {
        background-color: #ff8200; /* Botón con el color institucional */
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-hover:hover {
        background-color: #e66a00; /* Color ligeramente más oscuro para el hover */
        transform: translateY(-5px);
    }

    /* Sombra y espaciado para el contenedor */
    .container {
        padding: 0 15px;
    }

    .ltw {
        color: white;
    }

    /* Diseño responsive para dispositivos móviles */
    @media (max-width: 767px) {
        .card {
            width: 100%;
            padding: 30px;
        }

        .card h2 {
            font-size: 1.5rem;
        }

        .input-style {
            font-size: 1rem;
        }

        .btn-hover {
            font-size: 1.1rem;
        }

        .ltw {
            color: white;
        }
    }
</style>
@endsection
