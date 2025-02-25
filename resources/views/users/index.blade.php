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
                <th>User</th>
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
            <tr>
                <td>usuario1</td>
                <td>******</td>
                <td>usuario1@gmail.com</td>
                <td>Juan</td>
                <td>Pérez</td>
                <td>2024-02-20</td>
                <td>123456</td>
                <td>123456789</td>
                <td>
                    <button class="btn btn-warning btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editUserModal">
                        ✏️
                    </button>
                    <button class="btn btn-danger btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                        ❌
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

    <!-- Botón para agregar usuario -->
        <button class="btn btn-success add-btn" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Agregar Nuevo Usuario
        </button>
</div>

<!-- Modal para Editar Usuario -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-2">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control" value="usuario1">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Correo</label>
                        <input type="text" class="form-control" value="usuario1@gmail.com">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="Juan">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" value="Pérez">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Fecha de Alta</label>
                        <input type="date" class="form-control" value="2024-02-20">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Dni</label>
                        <input type="text" class="form-control" value="123456">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" value="123456789">
                    </div>
                    <button type="button" class="btn btn-success w-100">Guardar Cambios</button>
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

<!-- Modal para Agregar Nuevo Usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-2">
                        <label class="form-label">Usuario</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Correo</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Fecha de Alta</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Dni</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control">
                    </div>
                    <button type="button" class="btn btn-success w-100">Agregar Usuario</button>
                </form>
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
