@extends('layouts.app')

@section('title', 'Casos totales por comuna incremental')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush

@section('content')

    <h3 class="mb-3">Casos totales por comuna incremental (últimos 30 días)</h3>
    <p>Fuente: <a href="https://www.minciencia.gob.cl/covid19/" target="_blank">Base de Datos COVID-19</a><p>
    <div class="table-responsive">
        <table class="table table-sm datatable">
            <thead class="thead-dark">
            <tr>
                <th>Región</th>
                <th>Código de región</th>
                <th>Comuna</th>
                <th>Código de comuna</th>
                <th>Población</th>
                <th>Fecha</th>
                <th>Casos confirmados incremental</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cases as $case)
            <tr>
                <th>{{ $case->region }}</th>
                <th>{{ $case->region_code }}</th>
                <th>{{ $case->commune }}</th>
                <th>{{ $case->commune_code }}</th>
                <th>{{ number_format((int)$case->population, 0, ',', '.') }}</th>
                <th>{{ \Carbon\Carbon::parse($case->date)->format('d-m-Y') }}</th>
                <th>{{ number_format((int)$case->commit_cases, 0, ',', '.') }}</th>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('custom_js')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script>
    $(document).ready(function() {
            $.fn.dataTable.moment( 'DD-MM-YYYY' );
            $('.datatable').DataTable({
            "order": [ 5, "desc" ],
            "pageLength": 50,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: 'Exportar a Excel',
                    className: 'btn btn-info',
                    messageTop: 'Casos totales por comuna incremental (últimos 30 días)',
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button');
                    }
                }
            ],
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

    });
    </script>
@endsection
