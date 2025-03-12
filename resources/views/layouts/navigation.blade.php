@auth
<!-- Barra superior en mobile -->
<header class="mobile-header pb-8" id="mobileHeader">
    <a href="{{ route('appraisals.index') }}">
        <img src="{{ asset('logo.svg') }}" alt="Logo" class="logo-mobile">
    </a>
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>
</header>

<!-- Overlay para bloquear fondo -->
<div class="overlay" id="overlay"></div>

<!-- Sidebar (solo vertical en PC) -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('logo.svg') }}" alt="Logo" class="logo">
        </a>
    </div>
    <ul class="sidebar-menu">
        @if(auth()->user()->isAdmin())
            <li><a href="{{ route('users.index') }}"><i class="fas fa-users"></i> Usuarios</a></li>
        @endif
        <li><a href="{{ route('appraisals.index') }}"><i class="fas fa-file-alt"></i> Tasaciones</a></li>
        <li><a href="{{ route('account') }}"><i class="fas fa-user"></i> Cuenta</a></li>
        <li class="nav-item"><a class="nav-link ltn" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión</a></li>
    </ul>
</nav>

<!-- Modal para Confirmar Cierre de Sesión -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">¿Estás seguro de que deseas cerrar sesión?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                Serás redirigido a la página de login.
            </div>
            <div class="modal-footer d-flex flex-column gap-2">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth

<style>
    /* Barra superior en mobile *//* Barra superior en mobile */
/* Barra superior en mobile */
.mobile-header {
        display: none; /* No mostrar en PC */
        width: 100%;
        height: 60px; /* Aumenta la altura */
        background: #ff6200;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 15px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .logo-mobile {
        height: 40px;
    }

    /* Botón de menú en mobile */
    .menu-toggle {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    /* Overlay (fondo oscuro) */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out;
        z-index: 999;
    }

    .overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* Sidebar (solo vertical en PC) */
    .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: #ff6200;
        padding: 20px;
        transition: transform 0.3s ease-in-out;
        box-shadow: 3px 0 10px rgba(0, 0, 0, 0.2);
        z-index: 1001;
    }

    /* Evitar que sidebar tape contenido en PC */
    .main-content {
        margin-left: 250px;
        padding: 20px;
        transition: margin-left 0.3s;
    }

    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        max-width: 100%;
        height: 50px;
    }

    .toggle-btn {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }

    .sidebar-menu li {
        margin-bottom: 15px;
    }

    .sidebar-menu a {
        display: block;
        color: white;
        font-size: 18px;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .sidebar-menu a i {
        margin-right: 10px;
    }

    .sidebar-menu a:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Ocultar la barra superior en PC */
.mobile-header {
    display: none; /* Asegurar que está oculta en PC */
}

/* Solo mostrar la barra en mobile */
 /* Responsive */
 @media (max-width: 768px) {
        .mobile-header {
            display: flex;
        }

        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .overlay.show {
            display: block;
        }

        .main-content {
            margin-left: 0;
            padding-top: 90px; /* Ajuste para que el contenido no quede tapado */
        }
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar");
    const menuToggle = document.getElementById("menuToggle");
    const overlay = document.getElementById("overlay");
    const mobileHeader = document.getElementById("mobileHeader");
    const mainContent = document.getElementById("mainContent"); // Agregado

    function openSidebar() {
        sidebar.classList.add("show");
        overlay.classList.add("show");
        mobileHeader.style.display = "none"; // Oculta la barra superior
        mainContent.style.marginLeft = "250px"; // Desplazar contenido
    }

    function closeMenu() {
        sidebar.classList.remove("show");
        overlay.classList.remove("show");
        mobileHeader.style.display = "flex"; // Muestra la barra superior nuevamente
        mainContent.style.marginLeft = "0"; // Restaurar contenido en mobile
    }

    menuToggle.addEventListener("click", openSidebar);
    overlay.addEventListener("click", closeMenu);
});
</script>
