@extends('layouts.admin')
@section('header')
    Crear Contacto
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.contacts.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.contacts.store')}}">
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
                        <div class="form-group @error('email') has-error @enderror">
                            <label class="control-label" for="email">Correo electrónico<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('email') }}" name="email" placeholder="Correo electrónico">
                            <span class="help-block">{{__('bpa.email')}}</span>
                            <span class="error-container"></span>
                            @error('email')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('telefono') has-error @enderror">
                            <label class="control-label" for="titulo">Teléfono<small class="required"> *</small></label>
                            <input type="text" data-model="contact" class="form-control" value="{{ old('telefono') }}" name="telefono" placeholder="Teléfono">
                            <span class="help-block">{{__('bpa.phone')}}</span>
                            <span class="error-container"></span>
                            @error('telefono')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('imagen') has-error @enderror">
                            <label for="imagen">Ubicación<small class="required"> *</small></label>
                            <input type="file" name="imagen" accept="image/*" class="@error('imagen') is-invalid @enderror">
                            <span class="help-block">{{__('bpa.dimensiones', ['dim' => '760x175'])}}</span>
                            <span class="help-block">{{__('bpa.extensiones')}}</span>
                            <span class="error-container"></span>
                            @error('imagen')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('direccion') has-error @enderror">
                            <label for="direccion">Dirección<small class="required"> *</small></label>
                            <textarea name="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Dirección">{{ old('direccion') }}</textarea>
                            <span class="error-container"></span>
                            @error('direccion')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('descripcion') has-error @enderror">
                            <label for="descripcion">Descripción<small class="required"> *</small></label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="editor" placeholder="Descripción">{{ old('descripcion') }}</textarea>
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
                    },
                    telefono: {
                        required: true,
                        phone: true,
                        remote:{
                            url:"/api/extra/unique/",
                            type:"get",
                            data: {
                                value: function () {
                                    return $('#form :input[name="telefono"]').val();
                                }
                                , id: function () {
                                    return $('#form :input[name="telefono"]').data('id')
                                },
                                model: function () {
                                    return $('#form :input[name="telefono"]').data('model')
                                }
                            }
                        }
                    },
                    direccion: {
                        required: true,
                    },
                    descripcion: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    titulo: {
                        required: 'El campo título es obligatorio'
                    },
                    telefono: {
                        required: 'El campo teléfono es obligatorio',
                        remote: 'El campo teléfono debe ser único'
                    },
                    descripcion: {
                        required: 'El campo descripción es obligatorio',
                    },
                    direccion: {
                        required: 'El campo dirección es obligatorio',
                    },
                    email: {
                        required: 'El campo correo electrónico es obligatorio',
                    }
                }
            });
        });
    </script>
@endsection