@extends('layouts.app')

@section('title', 'Crear Parámetro')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Crear Parámetro
            </h1>
        </div>
        <form action="{{ route('settings.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="formGroupNameInput">Clave*</label>
                    <input type="text" class="form-control" id="key" placeholder="será usada para el template" name="key"
                        required="required">
                </div>
                <div class="form-group col-lg-6">
                    <label for="name">Nombre a mostrar*</label>
                    <input type="text" class="form-control" id="display_name" name="display_name" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="name">Descripción</label>
                    <input type="text" class="form-control" id="details" name="details" required="required">
                </div>
                <div class="form-group col-lg-6">
                    <label for="name">Tipo*</label>
                    <select class="form-control" name="type">
                        <option value="text">Texto</option>
                        <option value="text_area">Área de Texto</option>
                        <option value="rich_text_box">Texto Enriquecido</option>
                        <option value="image">Imágen</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        <form>
    </div>

@endsection
