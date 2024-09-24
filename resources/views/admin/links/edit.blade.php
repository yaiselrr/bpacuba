@extends('layouts.admin')
@section('header')
    Editar Enlace de interes
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.links.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.links.update', $link->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('titulo') has-error @enderror">
                            <label class="control-label" for="titulo">Título<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="titulo" value="{{old('titulo',$link->titulo)}}" placeholder="Título">
                            <span class="error-container"></span>
                            @error('titulo')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('url') has-error @enderror">
                            <label class="control-label" for="titulo">Url<small class="required"> *</small></label>
                            <input type="text"  data-model="link"  data-id="{{$link->id}}" class="form-control" name="url" value="{{old('url',$link->url)}}" placeholder="Url">
                            <span class="error-container"></span>
                            @error('url')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('logo') has-error @enderror">
                            <label for="logo">Logo</label>
                            <input type="file" accept="image/*" name="logo" class="@error('logo') is-invalid @enderror">
                            <span class="error-container"></span>
                            @error('logo')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <img src="{{asset('/storage/'.$link->logo)}}" class="img-responsive img-thumbnail" width="75px"
                                 height="75px" alt="User Image">
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
                        extension: "jpg,jpeg,png",
                        maxsize: 200000,
                    },
                    url:{
                        required: true,
                        url:true,
                        remote:{
                            url:"/api/extra/unique/",
                            type:"get",
                            data: {
                                value: function () {
                                    return $('#form :input[name="url"]').val();
                                }
                                , id: function () {
                                    return $('#form :input[name="url"]').data('id')
                                },
                                model: function () {
                                    return $('#form :input[name="url"]').data('model')
                                }
                            }
                        }
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo título es obligatorio'
                    },
                    logo: {
                        extension: 'Las extensiones permitidas son jpg,jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    },
                    url:{
                        required: 'El campo url es obligatorio',
                        remote: 'El campo url debe ser único'
                    }
                }
            });
        });
    </script>
@endsection