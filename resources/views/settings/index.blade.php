@extends('layouts.app')

@section('title', 'Parámetros')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Parámetros
                @can('Users: create')
                    <a href="{{ route('settings.create') }}" class="btn btn-primary">Crear</a>
                @endcan
            </h1>
        </div>
        <form action="{{ route('settings.store.values') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @foreach ($settings as $setting)
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header py-3 ">
                                <h6 class="m-0 font-weight-bold">{{ $setting->display_name }}</h6>
                                <code>{{ $setting->key }}</code>
                                <div class="float-right">
                                    <a href="#" class="delete" data-id="{{ $setting->id }}" data-href="{{ route('settings.destroy', $setting->id) }}" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash text-gray-600" title="Eliminar Parámetro"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($setting->type == 'text')
                                    <input type="text" class="form-control" name="{{ $setting->id }}"
                                        value="{{ $setting->value }}">
                                @elseif($setting->type == "text_area")
                                    <textarea class="form-control"
                                        name="{{ $setting->id }}">{{ $setting->value ?? '' }}</textarea>
                                @elseif($setting->type == "rich_text_box")
                                    <textarea class="form-control richTextBox"
                                        name="{{ $setting->id }}">{{ $setting->value ?? '' }}</textarea>
                                @elseif($setting->type == "image")
                                    @if($setting->value !== null && Storage::disk('public')->exists($setting->value))
                                        <a href="{{ Storage::url($setting->value) }}" target="_blank">
                                            <img src="{{ Storage::disk('public')->url($setting->value) }}" width="200px" class="img-fluid">
                                        </a>
                                    @endif
                                    <input type="file" name="{{ $setting->id }}" value="Cambiar Imágen">
                                @endif
                                <hr>
                                <small class="float-right">{{ $setting->details }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
        </form>
    </div>
    {{-- modal confirm --}}
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>¿Desea eliminar el parámetro?</h2>
                </div>
                <div class="modal-footer">
                    <form id="form-delete" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="setting" id="setting">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger btn-ok">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.richTextBox',
            language: 'es_MX',
            theme: 'modern',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table directionality emoticons template paste textcolor'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | removeformat ',
            browser_spellcheck: true
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
            console.log($(e.relatedTarget).data('href'));
            $('#setting').val($(e.relatedTarget).data('id'));
            $('#form-delete').attr('action', $(e.relatedTarget).data('href'));
            //$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@endsection
