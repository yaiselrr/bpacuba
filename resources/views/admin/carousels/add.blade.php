@extends('layouts.admin')
@section('header')
    Crear Carrusel
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.carousels.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.carousels.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('titulo') has-error @enderror">
                            <label class="control-label" for="titulo">Título<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('titulo') }}" name="titulo" placeholder="Título">
                            <span class="error-container"></span>
                            @error('titulo')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('url') has-error @enderror">
                            <label class="control-label" for="url">Página relacionada</label>
                            <input type="text" data-model="carousel" class="form-control" value="{{ old('url') }}" name="url" placeholder="url">
                            <span class="error-container"></span>
                            @error('url')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('imagen') has-error @enderror">
                            <label for="imagen">Imagen<small class="required"> *</small></label>
                            <input type="file" name="imagen" accept="image/*" class="@error('imagen') is-invalid @enderror">
                            <span class="help-block">{{__('bpa.dimensiones', ['dim' => '1250x300'])}}</span>
                            <span class="help-block">{{__('bpa.extensiones')}}</span>
                            <span class="error-container"></span>
                            @error('imagen')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer ">
                        <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-cancel">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('jscript')
    <script>
        $(document).ready(function() {
            $("#form").validate({
                ignore: [],
                lang: 'es',
                onfocusout: function (element) {
                    $(element).valid();
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent(".form-group").find(".error-container"));
                },
                rules: {
                    titulo: {
                        required: true,
                    },
                    imagen: {
                        required: true,
                        extension: "jpg,jpeg,png",
                        checkDim: [1250, 300],
                        maxsize: 200000,
                    },
                    url:{
                        url:true
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo título es obligatorio'
                    },
                    imagen: {
                        required: 'El campo imagen es obligatorio',
                        extension: 'Las extensiones permitidas son jpg,jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    }
                }
            });
        });
    </script>
@endsection