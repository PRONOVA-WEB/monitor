@extends('layouts.app')

@section('title', 'Listado de exámenes con resultados')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')

    <h3 class="mb-3">Listado de exámenes con resultados</h3>

    <a class="btn btn-outline-success btn-sm mb-3" id="downloadLink" onclick="exportF(this)">Descargar en excel</a>

    <div class="table-responsive">
        <table class="table table-sm datatable" id="tabla_files">
            <thead>
            <tr>
                <th>Run o (ID)</th>
                <th>Nombre</th>
                <th>Fecha toma de muestra</th>
                <th>Fecha de resultado</th>
                <th>Resultado</th>
                <th>Archivo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($suspectCases as $suspectCase)
                <tr @if ($suspectCase->pcr_sars_cov_2 == 'positive') style="background-color: crimson; color:#fff" @endif>
                    <td>{{ $suspectCase->patient->identifier }}</td>
                    <td>
                        @if($suspectCase->patient != null)
                            {{ $suspectCase->patient->fullName }}
                        @endif
                    </td>
                    <td>{{ $suspectCase->sample_at }}</td>
                    <td>{{ $suspectCase->pcr_sars_cov_2_at }}</td>
                    <td>@switch($suspectCase->pcr_sars_cov_2)
                        @case('pending')
                           {{ 'Pendiente' }}
                        @break
                        @case('negative')
                           {{ 'Negativo' }}
                        @break
                        @case('positive')
                           {{ 'Positivo' }}
                        @break
                        @case('rejected')
                           {{ 'Rechazado' }}
                        @break
                        @default
                            {{ 'Indeterminado' }}
                        @endswitch
                    </td>
                    <td>
                        @if ($suspectCase->file)
                            <a href="{{ route('lab.suspect_cases.download', $suspectCase->id) }}"
                            target="_blank" data-toggle="tooltip" data-placement="top"
                            data-original-title="{{ $suspectCase->id . '.pdf' }}">
                        @else
                            <a href="{{ route('lab.print', $suspectCase) }}"
                           target="_blank" data-toggle="tooltip" data-placement="top">
                        @endif
                        <i class="fas fa-paperclip"></i>&nbsp</a>
                    </td>
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
            "order": [ 2, "desc" ],
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
