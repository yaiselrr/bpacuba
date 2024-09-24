@extends('layouts.admin')
@section('header')
    Editar Aplicaciones móviles
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.apps.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.apps.update', $app->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('titulo') has-error @enderror">
                            <label class="control-label" for="titulo">Título<small class="required"> *</small></label>
                            <input type="text" data-model="app" data-id="{{$app->id}}"  class="form-control" name="titulo" value="{{old('titulo',$app->titulo)}}" placeholder="Título">
                            @error('titulo')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="publica" @if(old('publica',$app->publica)==1 || old('publica',$app->publica)==='on')checked @endif> Pública
                            </label>
                            @error('publica')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('imagen') has-error @enderror">
                            <label for="imagen">Imagen</label>
                            <input type="file" name="imagen" accept="image/*" class="@error('imagen') is-invalid @enderror">
                            <span class="help-block">{{__('bpa.dimensiones', ['dim' => '390x210'])}}</span>
                            <span class="help-block">{{__('bpa.extensiones')}}</span>
                            <span class="error-container"></span>
                            @error('imagen')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <img src="{{asset('/storage/'.$app->imagen)}}" class="img-responsive img-thumbnail" width="75px"
                                 height="75px" alt="User Image">
                        </div>
                        <div class="form-group @error('fichero') has-error @enderror">
                            <label for="fichero">Fichero</label>
                            <input type="file" name="fichero" class="@error('fichero') is-invalid @enderror">
                            <span class="error-container"></span>
                            @error('fichero')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <a href="{{asset('/storage/'.$app->fichero)}}" target="_blank">{{asset('/storage/'.$app->fichero)}}</a>
                        </div>
                        <div class="form-group @error('descripcion') has-error @enderror">
                            <label for="descripcion">Descripción<small class="required"> *</small></label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                       id="editor" placeholder="Descripcion">{{old('descripcion',$app->descripcion)}}</textarea>
                            @error('descripcion')
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
                        remote:{
                            url:"/api/extra/unique/",
                            type:"get",
                            data: {
                                value: function () {
                                    return $('#form :input[name="titulo"]').val();
                                }
                                , id: function () {
                                    return $('#form :input[name="titulo"]').data('id')
                                },
                                model: function () {
                                    return $('#form :input[name="titulo"]').data('model')
                                }
                            }
                        }
                    },
                    fichero: {
                        extension: "apk",
                        maxsize: 1000000,
                    },
                    imagen: {
                        extension: "jpg|jpeg|png",
                        checkDim: [390, 210],
                        maxsize: 200000,
                    },
                    descripcion:{
                        required: true
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo titulo es obligatorio',
                        remote: 'El campo título debe ser único'
                    },
                    fichero: {
                        extension: 'Las extensiones permitidas son apk',
                        maxsize: 'El tamaño del archivo no debe exceder los 10Mb',
                    },
                    imagen: {
                        extension: 'Las extensiones permitidas son jpg, jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    },
                    descripcion:{
                        required: 'El campo descripcion es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection