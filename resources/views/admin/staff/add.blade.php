@extends('layouts.admin')
@section('header')
    Crear Miembro
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.staff.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.staff.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('nombre') has-error @enderror">
                            <label class="control-label" for="nombre">Nombre(s)<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre" placeholder="Nombre">
                            <span class="error-container"></span>
                            @error('nombre')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('apellido') has-error @enderror">
                            <label class="control-label" for="titulo">Apellidos<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('apellido') }}" name="apellido" placeholder="Apellidos">
                            <span class="error-container"></span>
                            @error('apellido')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label class="control-label" for="email">Correo electrónico<small class="required"> *</small></label>
                            <input type="text" data-model="staff" class="form-control" value="{{ old('email') }}" name="email" placeholder="Correo electronico">
                            <span class="help-block">{{__('bpa.email')}}</span>
                            <span class="error-container"></span>
                            @error('nombre')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('telefono') has-error @enderror">
                            <label class="control-label" for="telefono">Teléfono<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('telefono') }}" name="telefono" placeholder="Telefono">
                            <span class="help-block">{{__('bpa.phone')}}</span>
                            <span class="error-container"></span>
                            @error('telefono')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('foto') has-error @enderror">
                            <label for="foto">Foto<small class="required"> *</small></label>
                            <input type="file" accept="image/*" name="foto" class="@error('foto') is-invalid @enderror">
                            <span class="help-block">{{__('bpa.dimensiones', ['dim' => '200x200'])}}</span>
                            <span class="help-block">{{__('bpa.extensiones')}}</span>
                            <span class="error-container"></span>
                            @error('foto')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Cargo<small class="required"> *</small></label>
                            <select class="form-control" name="rank_id">
                                <option value="">--Seleccionar--</option>
                                @foreach($ranks as $rank)
                                    <option value="{{$rank->id}}">{{$rank->cargo}}</option>
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
                    nombre: {
                        required: true,
                        word_especials: true,
                    },
                    apellido: {
                        required: true,
                        word_especials: true
                    },
                    telefono: {
                        required: true,
                        phone: true,
                    },
                    rank_id: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email:true,
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
                    foto: {
                        required: true,
                        extension:'jpg|jpeg|png',
                        checkDim: [200, 200],
                        maxsize: 200000
                    }
                },
                messages: {
                    nombre: {
                        required: 'El campo nombre(s) es obligatorio',
                        word_especials: "El campo nombre(s) solo admite letras y caracteres especiales.",

                    },
                    apellido: {
                        required: 'El campo apellidos es obligatorio',
                        word_especials: "El campo apellido solo admite letras y caracteres especiales.",

                    },
                    rank_id: {
                        required: 'El campo cargo es obligatorio'
                    },
                    telefono: {
                        required: 'El campo teléfono es obligatorio'
                    },
                    email: {
                        required: 'El campo correo electrónico es obligatorio',
                        remote: 'El campo correo electrónico debe ser único'

                    },
                    foto: {
                        required: 'El campo foto es obligatorio',
                        extension: 'Las extensiones permitidas son jpg,jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    }
                }
            });
        });
    </script>
@endsection