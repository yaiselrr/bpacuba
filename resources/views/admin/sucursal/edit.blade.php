@extends('layouts.admin')
@section('header')
    Editar Contactos de sucursales
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.sucursal.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.sucursal.update', $sucursal->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('email') has-error @enderror">
                            <label class="control-label" for="email">Correo electrónico<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="email"  value="{{old('email',$sucursal->email)}}" placeholder="Correo electrónico">
                            <span class="help-block">{{__('bpa.email')}}</span>
                            <span class="error-container"></span>
                            @error('email')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('telefono') has-error @enderror">
                            <label class="control-label" for="telefono">Teléfono<small class="required"> *</small></label>
                            <input type="text" data-model="sucursal" data-id="{{$sucursal->id}}" class="form-control" name="telefono"  value="{{old('telefono',$sucursal->telefono)}}" placeholder="Teléfono">
                            <span class="help-block">{{__('bpa.phone')}}</span>
                            <span class="error-container"></span>
                            @error('telefono')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Provincia<small class="required"> *</small></label>
                            <select id="province" class="form-control" name="province_id">
                                @foreach($provinces as $prov)
                                    @if($prov->id == $sucursal->provincia->id)
                                    <option value="{{$prov->id}}" selected>{{$prov->provincia}}</option>
                                    @else
                                    <option value="{{$prov->id}}">{{$prov->provincia}}</option>
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
                    email: {
                        required: true,
                        email: true
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
                    province_id: {
                        required: true,
                    }
                },
                messages: {
                    email: {
                        required: 'El campo correo electrónico es obligatorio',
                    },
                    telefono:{
                        required:'El campo teléfono es obligatorio',
                        remote: 'El campo teléfono debe ser único'
                    },
                    province_id: {
                        required: 'El campo provincia es obligatorio',
                    }
                }
            });
        });
    </script>
@endsection