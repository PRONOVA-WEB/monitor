@extends('layouts.app')

@section('title', 'Casos totales por comuna incremental')


@section('content')

    <h3 class="mb-3">Totales nacionales - {{ \Carbon\Carbon::parse($items->first()->date)->format('d-m-Y') }}</h3>
    <p>Fuente: <a href="https://www.minciencia.gob.cl/covid19/" target="_blank">Base de Datos COVID-19</a><p>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead class="thead-dark">
            <tr style="font-weight: bold">
                <th>Dato</th>
                <th>Fecha</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
            <tr  {{ ($item->item == 'Casos nuevos totales') ? 'style=color:red' : ''; }}>
                <th>{{ $item->item }}</th>
                <th>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</th>
                <th>{{ number_format((int)$item->total, 0, ',', '.') }}</th>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
