@extends('layouts.admin')
@section('header')
    Editar Noticia
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.news.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.news.update', $news->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('titulo') has-error @enderror">
                            <label class="control-label" for="titulo">Título<small class="required"> *</small></label>
                            <input type="text" data-model="news"  data-id="{{$news->id}}"class="form-control" name="titulo" value="{{old('titulo',$news->titulo)}}" placeholder="Título">
                            <span class="error-container"></span>
                            @error('titulo')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('fuente') has-error @enderror">
                            <label class="control-label" for="fuente">Fuente<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="fuente"  value="{{old('fuente',$news->fuente)}}" placeholder="Fuente">
                            <span class="error-container"></span>
                            @error('fuente')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="publica" @if(old('publica',$news->publica)==1 || old('publica',$news->publica)==='on')checked @endif> Pública
                            </label>
                            @error('publica')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('imagen') has-error @enderror">
                            <label for="imagen">Imagen</label>
                            <input type="file" accept="image/*" name="imagen" class="@error('imagen') is-invalid @enderror">
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
                            <img src="{{asset('/storage/'.$news->imagen)}}" class="img-responsive img-thumbnail" width="75px"
                                 height="75px" alt="User Image">
                        </div>
                        <div class="form-group @error('descripcion') has-error @enderror">
                            <label for="descripcion">Descripción<small class="required"> *</small></label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                       id="editor" placeholder="Descripción">{{old('descripcion',$news->descripcion)}}</textarea>
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
                    fuente: {
                        required: true,
                    },
                    descripcion: {
                        required: true,
                    },
                    imagen: {
                        extension: "jpg,jpeg,png",
                        checkDim: [390, 210],
                        maxsize: 200000,
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo título es obligatorio',
                        remote: 'El campo título debe ser único'
                    },
                    fuente: {
                        required: 'El campo fuente es obligatorio',
                    },
                    descripcion: {
                        required: 'El campo descripción es obligatorio',
                    },
                    imagen: {
                        extension: 'Las extensiones permitidas son jpg,jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    }
                }
            });
        });
    </script>
@endsection