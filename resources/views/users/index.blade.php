@extends('layouts.app')

@section('title', 'Listado de Usuarios')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Listado de Usuarios - Alta/Baja</h1>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>USER</th>
                <th>CONTRASEÑA</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>FECHA DE ALTA</th>
                <th>MATRÍCULA</th>
                <th>TELÉFONO</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>usuario1</td>
                <td>******</td>
                <td>Juan</td>
                <td>Pérez</td>
                <td>2024-02-20</td>
                <td>123456</td>
                <td>123456789</td>
                <td>
                    <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editUserModal">
                        ✏️
                    </button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                        ❌
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Botón para agregar usuario -->
    <div class="text-center mt-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Agregar Nuevo Usuario
        </button>
    </div>
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
                        <label class="form-label">Matrícula</label>
                        <input type="text" class="form-control" value="123456">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" value="123456789">
                    </div>
                    <button type="button" class="btn btn-primary w-100">Guardar Cambios</button>
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
                        <label class="form-label">Matrícula</label>
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
@endsection
