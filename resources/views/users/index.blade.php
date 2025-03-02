@extends('layouts.app')

@section('title', 'Listado de Usuarios')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container user-container">
    <div class="header-section d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Usuarios - Alta/Baja</h1>
    </div>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Username</th>
                <th>Contraseña</th>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Alta</th>
                <th>Dni</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $usuario)
            <tr>
                <td>{{ $usuario->username }}</td>
                <td>******</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>{{ $usuario->created_at->format('Y-m-d') }}</td>
                <td>{{ $usuario->dni }}</td>
                <td>{{ $usuario->telefono }}</td>
                <td>
                    <button class="btn btn-warning btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editUserModal-{{ $usuario->id }}">
                        ✏️
                    </button>
                    <button>
                    <form action="{{ route('users.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm action-btn">🗑️</button>
                    </form>
                </button>
                </td>
            </tr>

            <!-- Modal Editar Usuario -->
            <div class="modal fade" id="editUserModal-{{ $usuario->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('users.update', $usuario->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $usuario->id }}">

                                <div class="mb-2">
                                    <label class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="username" value="{{ $usuario->username }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="email" value="{{ $usuario->email }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{ $usuario->nombre }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Apellido</label>
                                    <input type="text" class="form-control" name="apellido" value="{{ $usuario->apellido }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">DNI</label>
                                    <input type="text" class="form-control" name="dni" value="{{ $usuario->dni }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" name="telefono" value="{{ $usuario->telefono }}">
                                </div>
                                {{-- <div class="mb-2">
                                    <label class="form-label">Nueva Contraseña</label>
                                    <input type="password" class="form-control" name="password">
                                </div> --}}

                                <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>

    </table>
</div>

    <!-- Botón para agregar usuario -->
        <button class="btn btn-success add-btn" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Agregar Nuevo Usuario
        </button>
</div>

<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-2">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">DNI</label>
                        <input type="text" class="form-control" name="dni" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Crear Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar Usuario -->
<div class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>¿Estás seguro de que quieres eliminar este usuario?</p>
                <button type="button" class="btn btn-danger w-100">Eliminar</button>
            </div>
        </div>
    </div>
</div>


<style>
    body {
        font-family: 'Arial', sans-serif;
    }

    .header-section h1 {
        color: #ff6200;
        font-size: 28px;
    }

    .user-container {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        margin-top: 50px;
    }

    table.table thead th {
        background: #ff6200;
        color: white;
        border: none;
    }

    table.table tbody tr:hover {
        background: #fdf2e9;
    }


    .action-btn, .export-btn, .add-btn {
        transition: all 0.3s ease;
        border-radius: 8px;
        margin-right: 5px;
    }

    .action-btn:hover, .export-btn:hover, .add-btn:hover {
        transform: scale(1.05);
    }

    .modal-header {
        background: #ff6200;
        color: white;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }
</style>
@endsection
