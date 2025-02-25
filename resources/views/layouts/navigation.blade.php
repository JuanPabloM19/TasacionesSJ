<nav class="navbar navbar-expand-lg navbar-dark clana sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Tasaciones SJ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link ltn" href="#">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ltn" href="{{ route('users.index') }}">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ltn" href="{{ route('appraisals.index') }}">Tasaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ltn" href="{{ route('account') }}">Cuenta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ltn" href="#">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Barra de navegación con fondo degradado */
    .clana {
        background: linear-gradient(to right, #feb47b, #ff8200);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Sombra sutil */
        border-bottom: 2px solid #ff6200; /* Línea de borde */
    }

    .navbar-brand {
        font-size: 1.5rem;
        color: #fff;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: color 0.3s ease;
    }

    .navbar-brand:hover {
        color: #ff6200; /* Efecto hover */
    }

    .nav-link {
        color: #fff !important;
        font-size: 1.1rem;
        font-weight: 500;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .nav-link:hover {
        color: #ff6200 !important;
        transform: translateY(-2px); /* Desplazamiento al pasar el ratón */
    }

    /* Efecto de transición para los enlaces en móvil */
    .navbar-toggler {
        border: none;
        background: transparent;
    }

    /* Personalización de los enlaces activos */
    .nav-link.active {
        color: #ff6200 !important;
        font-weight: bold;
    }

    /* Fondo degradado con efectos de sombra para las barras de navegación pegajosas */
    .sticky-top {
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* Estilos adicionales para las transiciones en móviles */
    @media (max-width: 991px) {
        .navbar-nav {
            text-align: center;
        }

        .nav-link {
            padding: 10px 0;
            font-size: 1.2rem;
        }
    }
</style>
