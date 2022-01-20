@extends('layouts.app')

@section('title', 'Crear Residencia')

@section('content')



<h3 class="mb-3">Aceptar/Rechazar pauta de evaluación residencia sanitaria</h3>

<hr>
<form method="POST" class="form-horizontal" action=" {{ route('sanitary_residences.admission.update', $admission) }} ">
    @csrf
    @method('PUT')
    <h5 class="mb-6">Identificación de Paciente</h5>

    <div class="form-row">
        <fieldset class="form-group col-8 col-md-8">
            <label for="for_name">Nombre completo</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="" autocomplete="off" value="{{$admission->patient->fullname}}" readonly>
        </fieldset>

        <fieldset class="form-group col-4 col-md-4">
            <label for="for_address">RUT o ID</label>
            <input type="text" class="form-control" name="address" id="for_address" required placeholder="" autocomplete="off" value="{{$admission->patient->identifier}}" readonly>
        </fieldset>
    </div>

    <div class="form-row">
        <fieldset class="form-group col-6 col-md-6">
            <label for="for_name">Domicilio</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="" autocomplete="off" value="{{($admission->patient->demographic)?$admission->patient->demographic->fulladdress:''}}" readonly>
        </fieldset>

        <fieldset class="form-group col-3 col-md-3">
            <label for="for_address">Nacionalidad</label>
            <input type="text" class="form-control" name="address" id="for_address" required placeholder="" autocomplete="off" value="{{ ($admission->patient->demographic)?$admission->patient->demographic->nationality:'' }}" readonly>
        </fieldset>

        <fieldset class="form-group col-3 col-md-3">
            <label for="for_address">Comuna</label>
            <input type="text" class="form-control" name="address" id="for_address" required placeholder="" autocomplete="off" value="{{ ($admission->patient->demographic->commune)?$admission->patient->demographic->commune->name:'' }}" readonly>
        </fieldset>
    </div>


    <div class="form-row">

        <fieldset class="form-group col-2 col-md-2">
            <label for="for_name">Telefono</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="" autocomplete="off" value="{{ ($admission->patient->demographic)?$admission->patient->demographic->telephone:'' }}" readonly>
        </fieldset>

        <fieldset class="form-group col-2 col-md-2">
            <label for="for_name">Edad</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="" autocomplete="off" value="{{ $admission->patient->age }}" readonly>
        </fieldset>

        <fieldset class="form-group col-4 col-md-4">
            <label for="for_name">Fecha de Confirmación de COVID 19- Positivo</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="" autocomplete="off" value="{{ ($admission->patient->suspectCases->where('pcr_sars_cov_2', 'positive')->last())? $admission->patient->suspectCases->where('pcr_sars_cov_2', 'positive')->last()->pcr_sars_cov_2_at->format('d-m-Y H:i'):''  }}" readonly>
        </fieldset>

        <fieldset class="form-group col-3 col-md-3">
            <label for="for_address">Centro de Salud de Origen</label>
            <input type="text" class="form-control" name="address" id="for_address" required placeholder="" autocomplete="off" value="{{ ($admission->patient->suspectCases->where('pcr_sars_cov_2', 'positive')->last())? $admission->patient->suspectCases->where('pcr_sars_cov_2', 'positive')->last()->origin:''  }}" readonly>
        </fieldset>

    </div>

    <div class="form-row">

        <fieldset class="form-group col-4 col-md-4">
            <label for="for_created_at">Fecha y Hora de Encuesta en Terreno*</label>
            <input type="text" name="created_at" id="for_created_at" class="form-control"  value="{{ $admission->created_at->format('d-m-Y H:i') }}" readonly>
            </input>
        </fieldset>

        <fieldset class="form-group col-3 col-md-3">
            <label for="for_address">Telefono(s) Contacto Emergencia</label>
            <input type="text" class="form-control" name="contactnumber" id="for_contactnumber" placeholder="" autocomplete="off" value="{{$admission->contactnumber}}" readonly>
        </fieldset>

        <fieldset class="form-group col-4 col-md-4">
            <label for="for_symptoms_epivigila">Fecha de Inicio de Sintomas (Epivigila)</label>
            <input type="date" class="form-control" name="symptoms_epivigila" id="for_symptoms_epivigila" placeholder="" max="{{ date('Y-m-d') }}" value="{{ $admission->symptoms_epivigila }}" autocomplete="off" required>
        </fieldset>



    </div>


    <div class="form-row">
        <fieldset class="form-group col-12 col-md-7">
            <label for="for_indications">Antecedentes Morbidos</label>
            <textarea class="form-control" id="for_morbid_history" rows="6" name="morbid_history">{{$admission->morbid_history}}</textarea>
        </fieldset>

        <fieldset class="form-group col-12 col-md-5">
            <label for="for_observations">Observaciones</label>
            <textarea type="textarea" class="form-control" rows="6" name="observations" id="for_observations">{{$admission->observations}}</textarea>
        </fieldset>
    </div>

    <hr>
    <h5 class="mb-6">Condiciones de habitabilidad</h5>

    <div class="form-row">
        <fieldset class="form-group col-4 col-md-4">
            <label for="for_name">¿Cuantas personas viven en su domicilio?</label>
            <input type="number" class="form-control" name="people" id="for_people" required placeholder="" autocomplete="off" value="{{$admission->people}}" readonly>
        </fieldset>
        <fieldset class="form-group col-4 col-md-4">
            <label for="for_name">¿Con cuantas habitaciones cuenta el hogar?</label>
            <input type="number" class="form-control" name="rooms" id="for_rooms" required placeholder="" autocomplete="off" value="{{$admission->rooms}}" readonly>
        </fieldset>
        <fieldset class="form-group col-4 col-md-4">
            <label for="for_name">¿Cuantos Baños Tiene en la casa?</label>
            <input type="number" class="form-control" name="bathrooms" id="for_bathrooms" required placeholder="" autocomplete="off" value="{{$admission->bathrooms}}" readonly>
        </fieldset>
    </div>

    <div class="form-check">
        <h5 class="mb-6">¿Tiene Agua en su Domicilio?</h5>
        <input class="form-check-input" type="radio" name="water" id="exampleRadios1" value="1" readonly required {{ ($admission->water=='1')?'checked':'disabled' }}>
        <label class="form-check-label" for="exampleRadios1">
            SÍ
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="water" id="exampleRadios2" value="0" readonly required {{ ($admission->water=='0')?'checked':'disabled' }}>
        <label class="form-check-label" for="exampleRadios2">
            NO
        </label>
    </div>
    <br>

    <div class="form-check">
        <h5 class="mb-6">¿ES POSIBLE AISLAR AL PACIENTE? (Seguir con la encuesta si el paciente no puede aislarse correctamente)</h5>
        <input class="form-check-input" type="radio" name="isolate" id="exampleRadios1" value="1" readonly required {{ ($admission->isolate=='1')?'checked':'disabled' }} >
        <label class="form-check-label" for="exampleRadios1">
            SÍ
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="isolate" id="exampleRadios2" value="0" {{ ($admission->isolate=='0')?'checked':'disabled' }}>
        <label class="form-check-label" for="exampleRadios2">
            NO
        </label>
    </div>

    <hr>
    <h5 class="mb-6">Criterios de Inclusión/Exclusión</h5>
    <table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th class="text-center">PREGUNTA</th>
            <th class="text-center">SÍ</th>
            <th class="text-center">NO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>¿Tiene algún problema respiratorio: ejemplo fiebre alta, dificultad para respirar?</td>
            <td class="text-center"><input name="respiratory" id="for_respiratory" type="radio" value="1" {{ ($admission->respiratory=='1')?'checked':'disabled' }}></td>
            <td class="text-center"><input name="respiratory" id="for_respiratory" type="radio" value="0" {{ ($admission->respiratory=='0')?'checked':'disabled' }}></td>
        </tr>
        <tr>
            <td>¿Tiene alguna dificultad para realizar sus actividades básicas (o diarias) sin ningún tipo de ayuda?</td>
            <td class="text-center"><input name="basicactivities" id="for_basicactivities" type="radio" value="1" {{ ($admission->basicactivities=='1')?'checked':'disabled' }}></td>
            <td class="text-center"><input name="basicactivities" id="for_basicactivities" type="radio" value="0" {{ ($admission->basicactivities=='0')?'checked':'disabled' }}></td>
        </tr>
        <tr>
            <td>¿Actualmente se encuentra o se ha encontrado en tratamiento por alguna adicción (como alcohol, drogas o tabaco)?</td>
            <td class="text-center"><input name="drugs" id="for_drugs" type="radio" value="1" {{ ($admission->drugs=='1')?'checked':'disabled' }}></td>
            <td class="text-center"><input name="drugs" id="for_drugs" type="radio" value="0" {{ ($admission->drugs=='0')?'checked':'disabled' }}></td>
        </tr>
        <tr>
            <td>¿Tiene enfermedades crónicas no compensadas (ej: hipertensión, diabetes)?</td>
            <td class="text-center"><input name="chronic" id="for_chronic" type="radio" value="1" {{ ($admission->chronic=='1')?'checked':'disabled' }}></td>
            <td class="text-center"><input name="chronic" id="for_chronic" type="radio" value="0" {{ ($admission->chronic=='0')?'checked':'disabled' }}></td>
        </tr>
        <tr>
            <td>¿Tiene algún otro problema de salud en este momento?</td>
            <td class="text-center"><input name="healthnow" id="for_healthnow" type="radio" value="1" {{ ($admission->healthnow=='1')?'checked':'disabled' }}></td>
            <td class="text-center"><input name="healthnow" id="for_healthnow" type="radio" value="0" {{ ($admission->healthnow=='0')?'checked':'disabled' }}></td>
        </tr>
        <tr>
            <td>¿Convive usted con personas portadoras de enfermedades crónicas (ej: Cancer, Hierpertención, Diabetes, Lupus, etc)?</td>
            <td class="text-center"><input name="risk" type="radio" value="1" {{ ($admission->risk=='1')?'checked':'disabled' }}></td>
            <td class="text-center"><input name="risk" type="radio" value="0" {{ ($admission->risk=='0')?'checked':'disabled' }}></td>
        </tr>
        <tr>
            <td>¿Hay personas mayores de 60 años en su hogar?</td>
            <td class="text-center"><input name="old" type="radio" value="1" {{ ($admission->old=='1')?'checked':'disabled' }}></td>
            <td class="text-center"><input name="old" type="radio" value="0" {{ ($admission->old=='0')?'checked':'disabled' }}></td>
        </tr>


    </tbody>



    </table>





    <div class="form-check">
        <h5 class="mb-6">¿CALIFICA RESIDENCIA?</h5>
        <input class="form-check-input" type="radio" name="residency" id="exampleRadios1" value="1" required {{ ($admission->residency=='1')?'checked':'disabled' }}>
        <label class="form-check-label" for="exampleRadios1">
            SÍ
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="residency" id="exampleRadios2" value="0" {{ ($admission->residency=='0')?'checked':'disabled' }}>
        <label class="form-check-label" for="exampleRadios2">
            NO
        </label>
    </div>

    <br>

    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
    <a class="btn btn-outline-secondary" href="{{ URL::previous() }}">Volver a Bandeja</a>

    </form>

    <br>
    <br>


    <div class="text-center">
        <a class="btn btn-success text-center" href="{{ route('sanitary_residences.admission.accept', $admission) }}"  onclick="return confirm('Recuerde que si va a confirmar ingreso debe tener el dato de Fecha de Inicio de Sintomas' )">VISTO BUENO INGRESO</a>
        <a class="btn btn-danger text-center" href="{{ route('sanitary_residences.admission.rejected', $admission) }}">RECHAZO INGRESO</a>
    </div>





@endsection

@section('custom_js')

@endsection
