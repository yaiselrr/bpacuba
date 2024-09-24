@extends('layouts.admin')
@section('header')
    Editar Descarga
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.downloads.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.downloads.update', $download->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('titulo') has-error @enderror">
                            <label class="control-label" for="titulo">Título<small class="required"> *</small></label>
                            <input type="text"  data-model="download" data-id="{{$download->id}}" class="form-control" name="titulo" value="{{old('titulo',$download->titulo)}}" placeholder="Título">
                            <span class="error-container"></span>
                            @error('titulo')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="publica" @if(old('publica',$download->publica)==1 || old('publica',$download->publica)==='on')checked @endif> Pública
                            </label>
                            @error('publica')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
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
                            <a href="{{asset('/storage/'.$download->fichero)}}" target="_blank">{{asset('/storage/'.$download->fichero)}}</a>
                        </div>
                        <div class="form-group @error('descripcion') has-error @enderror">
                            <label for="descripcion">Descripción<small class="required"> *</small></label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                       id="editor" placeholder="Descripción">{{old('descripcion',$download->descripcion)}}</textarea>
                            <span class="error-container"></span>
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
                        maxsize: 200000,
                    },
                    descripcion:{
                        required: true
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo título es obligatorio',
                        remote: 'El campo título debe ser único'
                    },
                    fichero: {
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    },
                    descripcion: {
                        required: 'El campo descripción es obligatorio',
                    }
                }
            });
        });
    </script>
@endsection