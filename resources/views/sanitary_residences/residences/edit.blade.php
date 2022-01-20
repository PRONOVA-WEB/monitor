@extends('layouts.app')

@section('title', 'Editar Residencia')

@section('content')

@include('sanitary_residences.nav')

<h3 class="mb-3">Editar Residencia</h3>

<form method="POST" class="form-horizontal" action="{{ route('sanitary_residences.residences.update', $residence) }}">
    @csrf
    @method('PUT')

    <div class="form-row">
        <fieldset class="form-group col-lg-4">
            <label for="for_name">Nombre</label>
            <input type="text" class="form-control" name="name" id="for_name"
                required placeholder="" autocomplete="off" value ="{{$residence->name}}">
        </fieldset>

        <fieldset class="form-group col-lg-4">
            <label for="for_commune geo">Comuna</label>
            <select class="form-control" name="commune_id" id="comunas">
                @foreach ($communes as $commune)
                <option value="{{ $commune->id }}" {{ ($residence->commune_id == $commune->id) ? 'selected' : '' }}>{{ $commune->name }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset class="form-group col-lg-4 geo">
            <label for="for_address">Calle / Avenida</label>
            <input type="text" class="form-control" name="address" id="for_address"
                required placeholder="" autocomplete="off" value ="{{$residence->address}}">
        </fieldset>
    </div>
    <div class="form-row">
        <fieldset class="form-group col-lg-4 geo">
            <label for="for_number">Número</label>
            <input type="text" class="form-control" name="number" id="for_number" value="{{$residence->number}}" required>
        </fieldset>

        <fieldset class="form-group col-lg-4">
            <label for="for_latitude">Latitud</label>
            <input type="number" class="form-control" name="latitude" step="00.00000001" id="for_latitude"
                 value ="{{$residence->latitude}}">
        </fieldset>

        <fieldset class="form-group col-lg-4">
            <label for="for_longitude">Longitud</label>
            <input type="number" class="form-control" name="longitude" step="00.00000001"    id="for_longitude"
                 value ="{{$residence->longitude}}">
        </fieldset>

    </div>

    <div class="form-row">

        <fieldset class="form-group col-lg-4">
            <label for="for_telphone">Teléfono</label>
            <input type="number" class="form-control" name="telephone" id="for_telephone"
                 placeholder="" value ="{{$residence->telephone}}">
        </fieldset>

        <fieldset class="form-group col-lg-3">
            <label for="for_width">Ancho (en Pixeles, ej:172)*</label>
            <input type="number" class="form-control" name="width" id="for_width"
                required value ="{{$residence->width}}">
        </fieldset>

        <fieldset class="form-group col-lg-3">
            <label for="for_height">Largo (en Pixeles, ej:172)*</label>
            <input type="number" class="form-control" name="height" id="for_height"
                required value ="{{$residence->height}}">
        </fieldset>

    </div>


    <button type="submit" class="btn btn-primary">Guardar</button>

    <a class="btn btn-outline-secondary" href="{{ route('sanitary_residences.residences.index') }}">Cancelar</a>

</form>

@endsection

@section('custom_js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        //obtener coordenadas
        jQuery('.geo').change(function () {
            // Instantiate a map and platform object:
            var platform = new H.service.Platform({
                'apikey': '{{ env('API_KEY_HERE') }}'
            });

            var address = jQuery('#for_address').val();
            var number = jQuery('#for_number').val();
            // var regiones = jQuery('#regiones').val();
            // var comunas = jQuery('#comunas').val();
            var regiones = $("#regiones option:selected").html();
            var comunas = $("#comunas option:selected").html();

            if (address != "" && number != "" && regiones != "Seleccione región" && comunas != "Seleccione comuna") {
                // Create the parameters for the geocoding request:
                var geocodingParams = {
                    searchText: address + ' ' + number + ', ' + comunas + ', chile'
                };console.log(geocodingParams);

                // Define a callback function to process the geocoding response:

                jQuery('#for_latitude').val("");
                jQuery('#for_longitude').val("");
                var onResult = function(result) {
                    console.log(result);
                    var locations = result.Response.View[0].Result;

                    // Add a marker for each location found
                    for (i = 0;  i < locations.length; i++) {
                        //alert(locations[i].Location.DisplayPosition.Latitude);
                        jQuery('#for_latitude').val(locations[i].Location.DisplayPosition.Latitude);
                        jQuery('#for_longitude').val(locations[i].Location.DisplayPosition.Longitude);
                    }
                };

                // Get an instance of the geocoding service:
                var geocoder = platform.getGeocodingService();

                // Error
                geocoder.geocode(geocodingParams, onResult, function(e) {
                    alert(e);
                });
            }

        });
    });
</script>
@endsection
