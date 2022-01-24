@extends('layouts.app')

@section('title', 'Casos totales por comuna incremental')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

    <h3 class="mb-3">Casos totales por comuna incremental (últimos 30 días)</h3>
    <p>Fuente: <a href="https://www.minciencia.gob.cl/covid19/" target="_blank">Base de Datos COVID-19</a><p>
    <a class="btn btn-outline-success btn-sm mb-3" id="downloadLink" onclick="exportF(this)">Descargar en excel</a>

    <div class="table-responsive">
        <table class="table table-sm datatable" id="tabla_files">
            <thead>
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
                <th>{{ (int)$case->population }}</th>
                <th>{{ \Carbon\Carbon::parse($case->date)->format('d-m-Y') }}</th>
                <th>{{ (int)$case->commit_cases }}</th>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        function exportF(elem) {
            var table = document.getElementById("tabla_files");
            var html = table.outerHTML;
            var html_no_links = html.replace(/<a[^>]*>|<\/a>/g, "");//remove if u want links in your table
            var url = 'data:application/vnd.ms-excel,' + escape(html_no_links); // Set your html table into url
            elem.setAttribute("href", url);
            elem.setAttribute("download", "files.xls"); // Choose the file name
            return false;
        }
    </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
    <script>
    $(document).ready(function() {
            $.fn.dataTable.moment( 'DD-MM-YYYY' );
            $('.datatable').DataTable({
            "order": [ 5, "desc" ],
            "pageLength": 50,
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
