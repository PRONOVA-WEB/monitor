<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow d-print-none">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link text-gray-700" href="{{ route('lab.suspect_cases.reports.minci.national_totals') }}">
                <i class="fas fa-address-book fa-fw" title="Totales nacionales"></i> Totales nacionales
            </a>

        </li>
        <li class="nav-item">
            <a class="nav-link text-gray-700" href="{{ route('lab.suspect_cases.reports.minci.covid_cases_by_commmune') }}">
                <i class="fas fa-calendar-alt fa-fw" title="Casos acumulados"></i> Casos acumulados
            </a>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span
                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <i class="fas fa-user fa-fw"></i>
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
