@extends('layouts.admin')
@section('header')
    Crear Consulta
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.consults.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.consults.store')}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('nombre') has-error @enderror">
                            <label class="control-label" for="nombre">Nombre<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}" placeholder="nombre">
                            <span class="error-container"></span>
                            @error('nombre')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label class="control-label" for="email">Correo electrónico<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="email">
                            <span class="error-container"></span>
                            @error('email')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('mensaje') has-error @enderror">
                            <label for="mensaje">Mensaje<small class="required"> *</small></label>
                            <textarea name="mensaje" class="form-control @error('mensaje') is-invalid @enderror"
                                       placeholder="mensaje">{{old('mensaje')}}</textarea>
                            @error('mensaje')
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
                    nombre: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email:true
                    },
                    mensaje: {
                        required: true,
                    }
                },
                messages: {
                    nombre: {
                        required: 'El campo nombre es obligatorio'
                    },
                    email: {
                        required: 'El campo correo electrónico es obligatorio',
                    },
                    mensaje: {
                        required: 'El campo mensaje es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection