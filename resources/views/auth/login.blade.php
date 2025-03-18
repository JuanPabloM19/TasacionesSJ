@extends('layouts.app')

@section('title', 'Tasaciones San Juan Gobierno')

@section('content')
<div class="container-fluid vh-100 d-flex justify-content-center align-items-center route-login" style="margin-left: 0;">

    <!-- Tarjeta de Iniciar Sesión -->
    <div class="card p-5 shadow-lg rounded-4" style="width: 380px;">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label text-muted">Nombre de usuario</label>
                <input type="text" class="form-control input-style" name="username" id="username" placeholder="Ingrese su nombre de usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-muted">Contraseña</label>
                <input type="password" class="form-control input-style" name="password" id="password" placeholder="Ingrese su contraseña" required>
            </div>
            <button type="submit" class="btn w-100 py-2 rounded-pill mt-4 btn-hover ltw">Siguiente</button>
        </form>

        <div class="mt-3 text-center">
            <a href="javascript:void(0);" class="text-muted" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>

<!-- Modal para Recuperación de Contraseña -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Contraseña</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('password.email') }}" method="POST">
              @csrf
              <div class="mb-3">
                  <label for="email" class="form-label">Correo electrónico</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su correo" required>
              </div>
              <div class="mb-3">
                  <label for="dni" class="form-label">DNI</label>
                  <input type="text" class="form-control" name="dni" id="dni" placeholder="Ingrese su DNI" required>
              </div>
              <button type="submit" class="btn w-100 py-2 rounded-pill btn-hover ltw">Recuperar Contraseña</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<style>
    /* Fondo y efectos para el contenedor */
    body {
        background: linear-gradient(to right, #ff8200, #ff8200); /* Color institucional */
    }

    body, .route-login {
    margin: 0;
    padding: 0;
}


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

    .card h2 {
        font-weight: bold;
        color: #ff8200;
    }

    /* Estilos para los inputs */
    .input-style {
        border-radius: 10px;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .input-style:focus {
        border-color: #ff8200;
        box-shadow: 0 0 5px rgba(255, 130, 0, 0.5);
    }

    .btn-hover {
        background-color: #ff8200;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-hover:hover {
        background-color: #e66a00;
        transform: translateY(-5px);
    }

    .ltw {
        color: white;
    }

    @media (max-width: 767px) {
        .card {
            width: 100%;
            padding: 30px;
        }
    }

    /* Diseño responsive para dispositivos móviles */
    @media (max-width: 767px) {
        .card h2 {
            font-size: 1.5rem;
        }

        .input-style {
            font-size: 1rem;
        }

        .btn-hover {
            font-size: 1.1rem;
        }

        .ltw{
            color: white
        }
    }
</style>
@endsection
