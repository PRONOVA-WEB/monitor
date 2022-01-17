<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ settings('site.logo') }}" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-3">{{ settings('site.title') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 mt-3" id="sidebarToggle"></button>
    </div>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menú
    </div>
    @auth
    @can('Patient: list')
    <li class="nav-item {{ active(['patients.*']) }}">
        <a class="nav-link" href="{{ route('patients.index') }}">
            <i class="fas fa-user-injured"></i>
            <span>Pacientes</span>
        </a>
    </li>
    @endcan
    @canany(['SuspectCase: admission','SuspectCase: reception','SuspectCase: own','SuspectCase: list','Patient: tracing', 'SuspectCase: bulk load', 'DialysisCenter: user'])
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCasos"
            aria-expanded="true" aria-controls="collapseCasos">
            <i class="fas fa-lungs-virus"></i>
            <span>Casos</span>
        </a>
        <div id="collapseCasos" class="collapse" aria-labelledby="headingCasos" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('SuspectCase: admission')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.admission') }}">Agregar nuevo caso</a>
                <a class="collapse-item" href="{{ route('lab.suspect_cases.search') }}">Buscar por ID</a>
                @endcan
                @can('SuspectCase: reception')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reception_inbox') }}">Recepcionar muestras</a>
                @endcan
                <hr class="sidebar-divider">
                <h6 class="collapse-header">Laboratorios</h6>
                @can('SuspectCase: list')
                @php
                $labs = App\Laboratory::where('external',0)->get();
                @endphp
                @foreach($labs as $lab)
                <a class="collapse-item" href="{{ route('lab.suspect_cases.index',$lab) }}?&text=&pendientes=on">Laboratorio {{ $lab->alias }}</a>
                @endforeach
                <a class="collapse-item" href="{{ route('lab.suspect_cases.index') }}?text=&pendientes=on">Todos los exámenes</a>
                <hr class="sidebar-divider">
                @endcan
                @can('DialysisCenter: user')
                @php
                $dialysis = App\EstablishmentUser::where('user_id',Auth::id())->get();
                @endphp
                @foreach($dialysis as $dialysi)
                @if(str_contains($dialysi->establishment->alias, 'Diálisis'))
                <a class="collapse-item" href="{{ route('lab.suspect_cases.dialysis.index', $dialysi->establishment) }}">{{$dialysi->establishment->alias}}</a>
                @endif
                @endforeach
                <hr class="sidebar-divider">
                @endcan
                @can('SuspectCase: own')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.ownIndex') }}?text=&filter%5B%5D=pending">Mis exámenes</a>
                @endcan
                <hr class="sidebar-divider">
                @can('Patient: tracing')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.notificationInbox') }}">Notificación<br> (excepto positivos)</a>
                <a class="collapse-item" href="{{ route('patients.tracings.communes') }}">Seguimiento<br> de mis comunas</a>
                <a class="collapse-item" href="{{ route('patients.tracings.establishments') }}">Seguimiento<br> de mis establecimientos</a>
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.tracing_minsal') }}">Seguimiento<br> SEREMI</a>
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.tracing_minsal_by_patient') }}">Seguimiento<br>SEREMI por paciente</a>
                <a class="collapse-item" href="{{ route('patients.tracings.withoutevents') }}">Pacientes<br> sin seguimiento</a>
                <a class="collapse-item" href="{{ route('patients.tracings.notifications_report') }}">Notificados<br> en mis establecimientos</a>
                @canany(['SocialTracing: seremi', 'SocialTracing: aps'])
                <a class="collapse-item" href="{{ route('patients.tracings.requests.social_index') }}">Seguimiento<br> de solicitudes</a>
                @endcanany
                @endcan
                <hr class="sidebar-divider">
                @can('Patient: tracing old')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.case_tracing') }}">Seguimiento (Antiguo)</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan

    @canany(['Lab: menu','SuspectCase: bulk load','SuspectCase: import results'])
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLab"
            aria-expanded="true" aria-controls="collapseLab">
            <i class="fas fa-vial"></i>
            <span>Laboratorios</span>
        </a>
        <div id="collapseLab" class="collapse" aria-labelledby="headingLab" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('lab.exams.covid19.index') }}">Exámenes externos</a>
                @can('Inmuno Test: list')
                <a class="collapse-item" href="{{ route('lab.inmuno_tests.index') }}">Inmunoglobulinas</a>
                @endcan
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.minsal_ws') }}">WS Minsal pendientes</a>
                @can('SuspectCase: sequencing')
                <a class="collapse-item" href="{{ route('sequencing.index') }}">Secuenciación</a>
                @endcan
                <hr class="sidebar-divider">
                @can('SuspectCase: bulk load')
                <a class="collapse-item" href="{{ route('lab.bulk_load.index') }}">Carga Masiva</a>
                @endcan
                @can('SuspectCase: import results')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.index_import_results') }}">Carga Masiva<br> Resultados</a>
                @endcan
                @can('SuspectCase: bulk load PNTM')
                <a class="collapse-item" href="{{ route('lab.bulk_load_from_pntm.index') }}">Carga Masiva<br> Resultados PNTM</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan

    @canany(['Patient: georeferencing', 'Geo: communes', 'Geo: region', 'Geo: establishments'] )
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGeo"
            aria-expanded="true" aria-controls="collapseGeo">
            <i class="fas fa-globe-americas"></i>
            <span>Georeferencia</span>
        </a>
        <div id="collapseGeo" class="collapse" aria-labelledby="headingGeo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['Patient: georeferencing', 'Geo: region'])
                <a class="collapse-item" href="{{ route('patients.georeferencing') }}">Geo Regional</a>
                @endcan
                @can('Geo: communes')
                <a class="collapse-item" href="{{ route('patients.tracings.mapbycommunes') }}">Geo Mis Comunas</a>
                @endcan
                @can('Geo: establishments')
                <a class="collapse-item" href="{{ route('patients.tracings.mapbyestablishments') }}">Geo Mis Establecimientos</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan

    @can('Epp: list')
    <li class="nav-item" {{ active(['epp.index']) }}>
        <a class="nav-link" href="{{ route('epp.index') }}">
            <i class="fas fa-head-side-mask"></i>
            <span>EPP</span>
        </a>
    </li>
    @endcan

    @canany(['SanitaryResidence: user', 'SanitaryResidence: admin' ,'SanitaryResidence: admission', 'Report: residences','SanitaryResidence: view'] )

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResidencia"
            aria-expanded="true" aria-controls="collapseResidencia">
            <i class="fas fa-hotel"></i>
            <span>Residencia</span>
        </a>
        <div id="collapseResidencia" class="collapse" aria-labelledby="headingResidencia" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['SanitaryResidence: user', 'SanitaryResidence: admin', 'Report: residences','SanitaryResidence: view'] )
                <a class="collapse-item" href="{{ route('sanitary_residences.home') }}">Residencias Sanitarias</a>
                <a class="collapse-item" href="{{ route('sanitary_residences.bookings.excelall') }}">Booking Actuales</a>
                <hr class="sidebar-divider">
                @endcan
                @canany(['SanitaryResidence: admin', 'Report: residences'])
                <a class="collapse-item" href="{{ route('sanitary_residences.residences.statusReport') }}">Consolidado Booking</a>
                <a class="collapse-item" href="{{ route('sanitary_residences.bookings.bookingByDate') }}">Booking Realizados<br> por Fechas</a>
                <a class="collapse-item" href="{{ route('sanitary_residences.residences.map') }}">Mapa de Residencias</a>
                <hr class="sidebar-divider">
                @endcan
                @can('SanitaryResidence: admin')
                <a class="collapse-item" href="{{ route('sanitary_residences.residences.index') }}">Mantenedor Residencias</a>
                <a class="collapse-item" href="{{ route('sanitary_residences.rooms.index') }}">Habitaciones</a>
                <a class="collapse-item" href="{{ route('sanitary_residences.users') }}">Usuarios</a>
                <hr class="sidebar-divider">
                @endcan
                @canany(['collapse: admin','SanitaryResidence: user'])
                <a class="collapse-item" href="{{ route('sanitary_residences.admission.index') }}">Aprobados por SEREMI</a>
                <hr class="sidebar-divider">
                @endcan
                @canany(['SanitaryResidence: admission','Developer'])
                <a class="collapse-item" href="{{ route('sanitary_residences.admission.inbox') }}">Bandeja SEREMI</a>
                <hr class="sidebar-divider">
                @endcan
            </div>
        </div>
    </li>
    @endcan
    @can('Basket:')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('help_basket.index')  }}">
            <i class="fas fa-shopping-basket"></i>
            <span>Canasta</span>
        </a>
    </li>
    @endcan
    @canany(['Report: positives',
    'Report: commune',
    'Report: hospitalized',
    'Report: deceased',
    'Report: other',
    'Report: historical',
    'Report: exams with result',
    'Report: gestants',
    'Report: positives demographics',
    'Report: residences',
    'Report: positives by range',
    'Report: user performance',
    'Report: more than two days',
    'Report: suspect cases by commune',
    'Report: positive average by commune',
    'Report: cases with barcodes'
    ])
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes"
            aria-expanded="true" aria-controls="collapseReportes">
            <i class="fas fa-clipboard"></i>
            <span>Reportes</span>
        </a>
        <div id="collapseReportes" class="collapse" aria-labelledby="headingReportes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
                @can('Report: positives')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.positives') }}">Reporte de positivos</a>
                @endcan
                @can('Report: commune')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.positives_own') }}">Reporte de mi comuna</a>
                @endcan
                @can('Report: hospitalized')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.hospitalized') }}">Hospitalizados</a>
                @endcan
                @can('Report: hospitalized commune')
                    <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.hospitalizedByUserCommunes') }}">Hospitalizados<br> de mis comunas</a>
                @endcan
                @can('Report: deceased')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.deceased') }}">Fallecidos</a>
                @endcan
                @can('Report: other')
                <!--a class="collapse-item" href="{{ route('lab.suspect_cases.report.index') }}">Reporte</a-->
                @endcan
                @can('Report: historical')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.report.historical_report') }}">Reporte Histórico</a>
                @endcan
                @can('Report: exams with result')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.exams_with_result') }}">Exámenes con resultados</a>
                @endcan
                @can('Report: suspect cases by commune')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.suspect_case_by_commune') }}">Exámenes por comuna</a>
                @endcan
                @can('Report: gestants')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.gestants') }}">Gestantes</a>
                @endcan
                <a class="collapse-item" href="{{ route('lab.suspect_cases.report.diary_lab_report') }}">Cantidad de muestras<br> diarias</a>
                <a class="collapse-item" href="{{ route('lab.suspect_cases.report.diary_by_lab_report') }}">Exámenes realizados<br> por laboratorios</a>
                @can('Report: positive average by commune')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.report.positive_average_by_commune') }}">Tasa de positividad<br> por comunas</a>
                @endcan
                @can('Report: positives demographics')
                <a class="collapse-item" href="{{ route('patients.exportPositives') }}">Reporte de positivos<br><code con dirección</a>
                @endcan
                @can('Report: residences')
                <a class="collapse-item" href="{{ route('sanitary_residences.residences.statusReport') }}">Reporte de residencias</a>
                @endcan
                @can('Report: positives by range')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.positivesByDateRange') }}">Reporte de positivos<br> por fecha</a>
                @endcan
                @can('Report: requires licence')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.requires_licence') }}">Reporte de pacientes<br> que requieren licencia médica</a>
                @endcan
                @can('Report: user performance')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.user_performance') }}">Reporte de rendimiento<br> usuario</a>
                @endcan
                @can('Report: more than two days')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.pending_more_than_two_days') }}">Reporte de casos<br> pendientes mayores<br> a 48 hrs.</a>
                @endcan
                @can('Report: cases without results')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.cases_without_results') }}">Casos sin resultados<br por fecha</a>
                @endcan
                @can('Report: cases with barcodes')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.cases_with_barcodes') }}">Casos códigos de barra</a>
                @endcan
                @can('Report: rapid test')
                <a class="collapse-item" href="{{ route('lab.suspect_cases.reports.all_rapid_tests') }}">Test Rápido</a>
                @endcan
            </div>
        </div>
    </li>
    @endcan
    @canany(['NotContacted: create',
    'NotContacted: list'])
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNoContactados"
            aria-expanded="true" aria-controls="collapseNoContactados">
            <i class="fas fa-phone"></i>
            <span>No Contactados</span>
        </a>
        <div id="collapseNoContactados" class="collapse" aria-labelledby="headingNoContactados" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('NotContacted: create')
                <a class="collapse-item" href="{{ route('pending_patient.create') }}">Crear paciente<br> no contactado</a>
                @endcan()
                @can('NotContacted: list')
                    <a class="collapse-item" href="{{ route('pending_patient.index') }}">Listar pacientes</a>
                @endcan
            </div>
        </div>
    </li>
    @endcanany
    @endauth
</ul>
{{-- <nav class="navbar navbar-expand-md navbar-light shadow-sm navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <i class="fas fa-ship"></i> {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('/home') }}">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li> -->

                @can('Patient: list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patients.index') }}">
                        <i class="fas fa-user-injured"></i>
                        Pacientes
                    </a>
                </li>
                @endcan



                @canany(['SuspectCase: admission','SuspectCase: reception','SuspectCase: own','SuspectCase: list','Patient: tracing', 'SuspectCase: bulk load', 'DialysisCenter: user'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-lungs-virus"></i>
                        Casos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('SuspectCase: admission')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.admission') }}">Agregar nuevo caso</a>

                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.search') }}">Buscar por ID</a>
                        @endcan

                        @can('SuspectCase: reception')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reception_inbox') }}">Recepcionar muestras</a>
                        @endcan

                        <div class="dropdown-divider"></div>

                        @can('SuspectCase: list')
                        @php
                        $labs = App\Laboratory::where('external',0)->get();
                        @endphp

                        @foreach($labs as $lab)
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.index',$lab) }}?&text=&pendientes=on">Laboratorio {{ $lab->alias }}</a>
                        @endforeach


                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.index') }}?text=&pendientes=on">Todos los exámenes</a>
                        <div class="dropdown-divider"></div>
                        @endcan

                        @can('DialysisCenter: user')
                        @php
                        $dialysis = App\EstablishmentUser::where('user_id',Auth::id())->get();
                        @endphp
                        @foreach($dialysis as $dialysi)
                        @if(str_contains($dialysi->establishment->alias, 'Diálisis'))

                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.dialysis.index', $dialysi->establishment) }}">{{$dialysi->establishment->alias}}</a>

                        @endif
                        @endforeach
                        <div class="dropdown-divider"></div>
                        @endcan







                        @can('SuspectCase: own')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.ownIndex') }}?text=&filter%5B%5D=pending">Mis exámenes</a>
                        @endcan

                        <div class="dropdown-divider"></div>

                        @can('Patient: tracing')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.notificationInbox') }}">Notificación (excepto positivos)</a>

                        <a class="dropdown-item" href="{{ route('patients.tracings.communes') }}">Seguimiento de mis comunas</a>

                        <a class="dropdown-item" href="{{ route('patients.tracings.establishments') }}">Seguimiento de mis establecimientos</a>

                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.tracing_minsal') }}">Seguimiento SEREMI</a>
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.tracing_minsal_by_patient') }}">Seguimiento SEREMI por paciente</a>

                        <a class="dropdown-item" href="{{ route('patients.tracings.withoutevents') }}">Pacientes sin seguimiento</a>

                        <a class="dropdown-item" href="{{ route('patients.tracings.notifications_report') }}">Notificados en mis establecimientos</a>

                        @canany(['SocialTracing: seremi', 'SocialTracing: aps'])
                        <a class="dropdown-item" href="{{ route('patients.tracings.requests.social_index') }}">Seguimiento de solicitudes</a>
                        @endcanany
                        @endcan


                        <div class="dropdown-divider"></div>

                        @can('Patient: tracing old')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.case_tracing') }}">Seguimiento (Antiguo)</a>
                        @endcan


                    </div>
                </li>
                @endcan

                @canany(['Lab: menu','SuspectCase: bulk load','SuspectCase: import results'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-vial"></i>
                        Lab
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('lab.exams.covid19.index') }}">Exámenes externos</a>
                        @can('Inmuno Test: list')
                        <a class="dropdown-item" href="{{ route('lab.inmuno_tests.index') }}">Inmunoglobulinas</a>
                        @endcan

                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.minsal_ws') }}">WS Minsal pendientes</a>

                        @can('SuspectCase: sequencing')
                        <a class="dropdown-item" href="{{ route('sequencing.index') }}">Secuenciación</a>
                        @endcan

                        <div class="dropdown-divider"></div>

                        @can('SuspectCase: bulk load')
                        <a class="dropdown-item" href="{{ route('lab.bulk_load.index') }}">Carga Masiva</a>
                        @endcan

                        @can('SuspectCase: import results')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.index_import_results') }}">Carga Masiva Resultados</a>
                        @endcan

                        @can('SuspectCase: bulk load PNTM')
                            <a class="dropdown-item" href="{{ route('lab.bulk_load_from_pntm.index') }}">Carga Masiva Resultados PNTM</a>
                        @endcan



                    </div>

                </li>
                @endcan


                @canany(['Patient: georeferencing', 'Geo: communes', 'Geo: region', 'Geo: establishments'] )
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe-americas"></i>
                        Geo
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @canany(['Patient: georeferencing', 'Geo: region'])
                        <a class="dropdown-item" href="{{ route('patients.georeferencing') }}">Geo Regional</a>
                        @endcan
                        @can('Geo: communes')
                        <a class="dropdown-item" href="{{ route('patients.tracings.mapbycommunes') }}">Geo Mis Comunas</a>
                        @endcan
                        @can('Geo: establishments')
                        <a class="dropdown-item" href="{{ route('patients.tracings.mapbyestablishments') }}">Geo Mis Establecimientos</a>
                        @endcan
                    </div>
                </li>
                @endcan

                @can('Epp: list')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('epp.index') }}">
                        <i class="fas fa-head-side-mask"></i>
                        EPP
                    </a>
                </li>
                @endcan



                @canany(['SanitaryResidence: user', 'SanitaryResidence: admin' ,'SanitaryResidence: admission', 'Report: residences','SanitaryResidence: view'] )
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-hotel"></i>
                        Residencia
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        @canany(['SanitaryResidence: user', 'SanitaryResidence: admin', 'Report: residences','SanitaryResidence: view'] )
                        <a class="dropdown-item" href="{{ route('sanitary_residences.home') }}">Residencias Sanitarias</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('sanitary_residences.bookings.excelall') }}">Booking Actuales</a>

                        @endcan

                        @canany(['SanitaryResidence: admin', 'Report: residences'])

                        <a class="dropdown-item" href="{{ route('sanitary_residences.residences.statusReport') }}">Consolidado Booking</a>

                        <a class="dropdown-item" href="{{ route('sanitary_residences.bookings.bookingByDate') }}">Booking Realizados por Fechas</a>

                        <a class="dropdown-item" href="{{ route('sanitary_residences.residences.map') }}">Mapa de Residencias</a>

                        @endcan

                        @can('SanitaryResidence: admin')

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('sanitary_residences.residences.index') }}">Mantenedor Residencias</a>

                        <a class="dropdown-item" href="{{ route('sanitary_residences.rooms.index') }}">Habitaciones</a>

                        <a class="dropdown-item" href="{{ route('sanitary_residences.users') }}">Usuarios</a>

                        @endcan

                        @canany(['SanitaryResidence: admin','SanitaryResidence: user'])

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('sanitary_residences.admission.index') }}">Aprobados por SEREMI</a>

                        @endcan



                        @canany(['SanitaryResidence: admission','Developer'])
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('sanitary_residences.admission.inbox') }}">Bandeja SEREMI</a>
                        @endcan

                    </div>
                </li>
                @endcan

                @can('Basket:')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('help_basket.index')  }}">
                        <i class="fas fa-shopping-basket"></i>
                        Canasta
                    </a>
                </li>
                @endcan


                @canany(['Report: positives',
                'Report: commune',
                'Report: hospitalized',
                'Report: deceased',
                'Report: other',
                'Report: historical',
                'Report: exams with result',
                'Report: gestants',
                'Report: positives demographics',
                'Report: residences',
                'Report: positives by range',
                'Report: user performance',
                'Report: more than two days',
                'Report: suspect cases by commune',
                'Report: positive average by commune',
                'Report: cases with barcodes'
                ])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-clipboard"></i>
                        Reportes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        @can('Report: positives')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.positives') }}">Reporte de positivos</a>
                        @endcan

                        @can('Report: commune')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.positives_own') }}">Reporte de mi comuna</a>
                        @endcan

                        @can('Report: hospitalized')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.hospitalized') }}">Hospitalizados</a>
                        @endcan

                        @can('Report: hospitalized commune')
                            <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.hospitalizedByUserCommunes') }}">Hospitalizados de mis comunas</a>
                        @endcan

                        @can('Report: deceased')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.deceased') }}">Fallecidos</a>
                        @endcan

                        @can('Report: other')
                        <!--a class="dropdown-item" href="{{ route('lab.suspect_cases.report.index') }}">Reporte</a-->
                        @endcan

                        @can('Report: historical')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.report.historical_report') }}">Reporte Histórico</a>
                        @endcan

                        @can('Report: exams with result')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.exams_with_result') }}">Exámenes con resultados</a>
                        @endcan

                        @can('Report: suspect cases by commune')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.suspect_case_by_commune') }}">Exámenes por comuna</a>
                        @endcan

                        @can('Report: gestants')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.gestants') }}">Gestantes</a>
                        @endcan

                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.report.diary_lab_report') }}">Cantidad de muestras diarias</a>
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.report.diary_by_lab_report') }}">Exámenes realizados por laboratorios</a>

                        @can('Report: positive average by commune')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.report.positive_average_by_commune') }}">Tasa de positividad por comunas</a>
                        @endcan

                        @can('Report: positives demographics')
                        <a class="dropdown-item" href="{{ route('patients.exportPositives') }}">Reporte de positivos con dirección</a>
                        @endcan

                        @can('Report: residences')
                        <a class="dropdown-item" href="{{ route('sanitary_residences.residences.statusReport') }}">Reporte de residencias</a>
                        @endcan

                        @can('Report: positives by range')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.positivesByDateRange') }}">Reporte de positivos por fecha</a>
                        @endcan

                        @can('Report: requires licence')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.requires_licence') }}">Reporte de pacientes que requieren licencia médica</a>
                        @endcan

                        @can('Report: user performance')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.user_performance') }}">Reporte de rendimiento usuario</a>
                        @endcan

                        @can('Report: more than two days')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.pending_more_than_two_days') }}">Reporte de casos pendientes mayores a 48 hrs.</a>
                        @endcan

                        @can('Report: cases without results')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.cases_without_results') }}">Casos sin resultados por fecha</a>
                        @endcan
                        @can('Report: cases with barcodes')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.cases_with_barcodes') }}">Casos códigos de barra</a>
                        @endcan
                        @can('Report: rapid test')
                        <a class="dropdown-item" href="{{ route('lab.suspect_cases.reports.all_rapid_tests') }}">Test Rápido</a>
                        @endcan

                    </div>
                </li>
                @endcan

                @canany(['NotContacted: create',
                        'NotContacted: list'])
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-phone"></i>
                            No Contactados
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            @can('NotContacted: create')
                                <a class="dropdown-item" href="{{ route('pending_patient.create') }}">Crear paciente no contactado</a>
                            @endcan()
                            @can('NotContacted: list')
                                <a class="dropdown-item" href="{{ route('pending_patient.index') }}">Listar pacientes</a>
                            @endcan
                        </div>
                    </li>
                @endcanany
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @can('Admin')
                        <a class="nav-link" href="{{ route('parameters.index') }}">
                            <i class="fas fa-cog fa-fw"></i> Configuracion
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
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav> --}}
