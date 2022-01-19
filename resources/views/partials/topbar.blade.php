<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow d-print-none">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span
                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <i class="fas fa-user fa-fw" title="Calendarios"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                @auth
                @can('Admin')
                <a class="dropdown-item" href="{{ route('parameters.index') }}">
                    <i class="fas fa-cog fa-fw"></i> Configuración
                </a>
                <a class="dropdown-item" href="{{ route('settings.index') }}">
                    <i class="fas fa-cogs fa-fw"></i> Ajustes
                </a>
                @endcan
                <a class="dropdown-item" target="_blank" href="https://www.youtube.com/channel/UCynVYUM4qEu9eGPvM_3Z-WA">
                    Tutoriales
                </a>
                @can('Developer')
                <a class="dropdown-item" href="{{ route('patients.tracings.withouttracing') }}">Pacientes (+) sin tracing</a>
                <a class="dropdown-item" href="{{ route('patients.tracings.cartoindex') }}">BETA Pacientes CAR que pasaron a Indice</a>
                @endcan
                <a class="dropdown-item" href="{{ route('users.password.show_form') }}">
                    Cambiar clave
                </a>
                <div class="dropdown-divider"></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-fw"></i> {{ __('Cerrar sesión') }}
                </a>
                @endauth
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->
