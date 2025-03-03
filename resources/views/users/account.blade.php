@extends('layouts.app')

@section('title', 'Mi Cuenta')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="account-container pt-8">
    <h2 class="title">Mi Cuenta</h2>

    <form class="account-form" method="POST" action="{{ route('account.update') }}">
        @csrf

        <div class="form-group">
            <label>Usuario</label>
            <div class="input-group">
                <input type="text" name="username" value="{{ old('username', $user->username) }}" readonly>
                <span class="edit-icon" onclick="enableEdit(this)">&#9998;</span>
            </div>
        </div>

        <div class="form-group">
            <label>Correo</label>
            <div class="input-group">
                <input type="email" name="email" value="{{ old('email', $user->email) }}" readonly>
                <span class="edit-icon" onclick="enableEdit(this)">&#9998;</span>
            </div>
        </div>

        <div class="form-group">
            <label>Nombre</label>
            <div class="input-group">
                <input type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}" readonly>
                <span class="edit-icon" onclick="enableEdit(this)">&#9998;</span>
            </div>
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <div class="input-group">
                <input type="text" name="apellido" value="{{ old('apellido', $user->apellido) }}" readonly>
                <span class="edit-icon" onclick="enableEdit(this)">&#9998;</span>
            </div>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <div class="input-group">
                <input type="tel" name="telefono" value="{{ old('telefono', $user->telefono) }}" readonly>
                <span class="edit-icon" onclick="enableEdit(this)">&#9998;</span>
            </div>
        </div>

        <button type="submit" class="save-btn">Guardar Cambios</button>
    </form>
</div>

<div id="notification" class="notification">Edición activada</div>

    <script>
        function enableEdit(element) {
            let input = element.previousElementSibling;
            input.removeAttribute('readonly');
            input.classList.add('editing');
            input.focus();

            showNotification("Puedes editar este campo ahora");
        }

        function showNotification(message) {
            let notification = document.getElementById('notification');
            notification.innerText = message;
            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
            }, 2000);
        }
    </script>

    <style>

        .account-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            margin: auto;
            margin-top: 100px;
            text-align: center;
        }

        .title {
            color: #ff6200;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .account-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .input-group {
            display: flex;
            align-items: center;
            background: #f8f8f8;
            border-radius: 8px;
            padding: 8px;
            transition: all 0.3s ease-in-out;
        }

        input {
            flex: 1;
            border: none;
            background: none;
            padding: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        input:focus {
            outline: none;
        }

        .editing {
            border-bottom: 2px solid #ff6200;
            background: #fff7e6;
        }

        .edit-icon {
            cursor: pointer;
            padding: 5px;
            color: #ff6200;
            font-size: 18px;
            transition: transform 0.2s;
        }

        .edit-icon:hover {
            transform: scale(1.2);
        }

        .save-btn {
            background: #ff6200;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .save-btn:hover {
            background: #e65c00;
        }

        /* Notificación flotante */
        .notification {
    position: fixed;
    top: 20px; /* Cambiado de -50px a 20px */
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 12px 20px;
    border-radius: 5px;
    font-size: 14px;
    opacity: 0;
    transition: all 0.5s ease-in-out;
    z-index: 1000; /* Asegura que la notificación esté por encima de otros elementos */
}

.notification.show {
    opacity: 1;
}

    </style>
@endsection
