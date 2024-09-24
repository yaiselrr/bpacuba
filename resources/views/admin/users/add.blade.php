@extends('layouts.admin')
@section('header')
    Crear Usuario
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.manager.users.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.manager.users.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('email') has-error @enderror">
                            <label class="control-label" for="email">Correo electrónico<small class="required"> *</small></label>
                            <input type="text" data-model="user"  class="form-control" value="{{ old('email') }}" name="email" placeholder="Correo electrónico">
                            <span class="help-block">{{__('bpa.email')}}</span>
                            <span class="error-container"></span>
                            @error('email')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('name') has-error @enderror">
                            <label class="control-label" for="name">Nombre y apellidos<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Nombre y apellidos">
                            <span class="error-container"></span>
                            @error('name')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('password') has-error @enderror">
                            <label class="control-label" for="password">Contraseña<small class="required"> *</small></label>
                            <input id="password" type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="Contraseña">
                            <span class="error-container"></span>
                            @error('password')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('confirm') has-error @enderror">
                            <label class="control-label" for="confirm">Confirmar contraseña<small class="required"> *</small></label>
                            <input  type="password" class="form-control" value="{{ old('confirm') }}" name="confirm" placeholder="Confirmar contraseña">
                            <span class="error-container"></span>
                            @error('confirm')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('avatar') has-error @enderror">
                            <label for="avatar">Avatar</label>
                            <input type="file" name="avatar" accept="image/*" class="@error('avatar') is-invalid @enderror">
                            <span class="help-block">{{__('bpa.dimensiones', ['dim' => '200x200'])}}</span>
                            <span class="help-block">{{__('bpa.extensiones')}}</span>
                            <span class="error-container"></span>
                            @error('avatar')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Rol<small class="required"> *</small></label>
                            <select class="form-control" name="role_id">
                                <option value="">--Seleccionar--</option>
                                @foreach($roles as $rol)
                                    <option value="{{$rol->id}}">{{$rol->name}}</option>
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
                    name: {
                        required: true,
                        word_especials: true,

                    },
                    email: {
                        required: true,
                        email: true,
                        remote:{
                            url:"/api/extra/unique/",
                            type:"get",
                            data: {
                                value: function () {
                                    return $('#form :input[name="email"]').val();
                                }
                                , id: function () {
                                    return $('#form :input[name="email"]').data('id')
                                },
                                model: function () {
                                    return $('#form :input[name="email"]').data('model')
                                }
                            }
                        }
                    },
                    confirm:{
                        required: true,
                        equalTo: '#password'
                    },
                    password:{
                      required: true,
                    },
                    role_id: {
                        required: true,
                    },
                    avatar:{
                        extension: 'jpg|jpeg|png',
                        checkDim: [200, 200],
                        maxsize: 200000
                    }
                },
                messages: {
                    name: {
                        required: 'El campo nombre y apellidos es obligatorio',
                        word_especials: "El campo nombre y apellidos solo admite letras y caracteres especiales.",
                    },
                    password: {
                        required: 'El campo contraseña es obligatorio'
                    },
                    confirm: {
                        required: 'El campo confirmar contraseña es obligatorio'
                    }
                    ,email: {
                        required: 'El campo correo electrónico es obligatorio',
                        remote: 'El campo correo electrónico debe ser único'
                    },
                    role_id: {
                        required: 'El campo rol es obligatorio',
                    },
                    avatar:{
                        extension: 'Las extensiones permitidas son jpg,jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    }
                }
            });
        });
    </script>
@endsection