@extends('layouts.app')

@section('title', 'Bienvenidos')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header text-center">
                    <h4>Bienvenido al sistema {{ settings('site.title') }}</h4>
                </div>
                <div class="card-body">
                    {!! settings('site.description') !!}
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <br>
                    Usted tiene acceso a los siguientes establecimientos:
                    @forelse ($establishmentsusers->take('20') as $establishmentsusers)
                    <br>{{ '- '.$establishmentsusers->establishment->alias }}
                    @empty
                    <br>No tiene establecimientos configurados
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
