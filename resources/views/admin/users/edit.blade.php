@extends('layouts.admin')
@section('header')
    Editar Cargo
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.manager.users.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.manager.users.update', $user->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('email') has-error @enderror">
                            <label class="control-label" for="email">Correo electrónico<small class="required"> *</small></label>
                            <input type="text"  data-model="user"  data-id="{{$user->id}}" class="form-control" value="{{ old('email',$user->email) }}" name="email" placeholder="Correo electrónico">
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
                            <input type="text" class="form-control" value="{{ old('name',$user->name) }}" name="name" placeholder="Nombre y apellidos">
                            <span class="error-container"></span>
                            @error('name')
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
                        @if($user->avatar)
                        <div class="mt-3">
                            <img src="{{asset('/storage/'.$user->avatar)}}" class="img-responsive img-thumbnail" width="75px"
                                 height="75px" alt="User Image">
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Rol<small class="required"> *</small></label>
                            <select class="form-control" name="role_id">
                                @foreach($roles as $rol)
                                    @if($user->rol->id  == $rol->id)
                                        <option value="{{$rol->id}}" selected>{{$rol->name}}</option>
                                    @else
                                        <option value="{{$rol->id}}">{{$rol->name}}</option>
                                    @endif
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
                        required: 'El campo nombre y apellidos es obligatorio'
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