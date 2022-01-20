@extends('layouts.app')

@section('title', 'Listado de Establecimientos')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
@include('parameters.nav')


<h3 class="mb-3">Listado de Establecimientos</h3>

<a class="btn btn-primary mb-3" href="{{ route('parameters.establishment.create')}}">Crear nuevo establecimiento</a>

<div class="table-responsive">
<table class="table table-sm table-bordered datatable">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Alias</th>
            <th>Nuevo Código DEIS</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($establishments as $establishment)

        <tr>
            <td>{{$establishment->name}}</td>
            <td>{{$establishment->alias}}</td>
            <td>{{$establishment->new_code_deis}}</td>
            <td>{{$establishment->address}}</td>
            <td>{{$establishment->telephone}}</td>
            <td>{{$establishment->email}}</td>
            <td>
                <a href="{{route('parameters.establishment.edit', $establishment)}}">
                <i class="fas fa-edit"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
</div>



@endsection

@section('custom_js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
<script>
$(document).ready(function() {
        $.fn.dataTable.moment( 'DD-MM-YYYY' );
        $('.datatable').DataTable({
        "order": [ 0, "asc" ],
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
