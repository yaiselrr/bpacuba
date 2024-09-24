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
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.manager.users.password-update', $user->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('password') has-error @enderror">
                            <label class="control-label" for="password">Contraseña</label>
                            <input id="password" type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="Contraseña">
                            <span class="error-container"></span>
                            @error('password')
                            <span class="help-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="form-group @error('confirm') has-error @enderror">
                        <label class="control-label" for="confirm">Confirmar contraseña</label>
                        <input  type="password" class="form-control" value="{{ old('confirm') }}" name="confirm" placeholder="Confirmar contraseña">
                        <span class="error-container"></span>
                        @error('confirm')
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
                    confirm:{
                        required: true,
                        equalTo: '#password'
                    },
                    password:{
                        required: true,
                    },
                },
                messages: {
                    confirm:{
                        required: 'El campo confirmar contraseña es obligatorio',
                    },
                    password:{
                        required: 'El campo contraseña es obligatorio',
                    },
                }
            });
        });
    </script>
@endsection