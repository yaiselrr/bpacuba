@extends('layouts.admin')
@section('header')
    Crear Red social
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.socials.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.socials.store')}}">
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
                            <label class="control-label" for="url">Url<small class="required"> *</small></label>
                            <input type="text" data-model="social" class="form-control" value="{{ old('url') }}" name="url" placeholder="url">
                            <span class="error-container"></span>
                            @error('url')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Red social<small class="required"> *</small></label>
                            <select  class="form-control" name="red_social">
                                <option value="">--Seleccionar--</option>
                                @foreach($redes as $red)
                                    <option value="{{$red->id}}">{{$red->red}}</option>
                                @endforeach
                            </select>
                            <span class="error-container"></span>
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
                    url:{
                        required: true,
                        url: true,
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
                    },
                    red_social:{
                      required: true
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo título es obligatorio'
                    },
                    url:{
                        required: 'El campo url es obligatorio',
                        remote: 'El campo url debe ser único'
                    },
                    red_social:{
                        required: 'El campo red social es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection