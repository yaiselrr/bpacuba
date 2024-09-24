@extends('layouts.admin')
@section('header')
    Editar Oficina
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.offices.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.offices.update', $office->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label" for="titulo">Título<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{old('titulo',$office->titulo)}}" name="titulo" placeholder="Título">
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="codigo">Código<small class="required"> *</small></label>
                            <input type="text" data-model="office" data-id="{{$office->id}}" maxlength="4" class="form-control" value="{{old('codigo',$office->codigo)}}" name="codigo" placeholder="Código">
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="identificación">Referencia</label>
                            <input type="text" class="form-control" value="{{ old('identificacion',$office->identificacion) }}" name="identificacion" placeholder="Referencia">
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="telefono">Teléfono</label>
                            <input type="text" class="form-control" value="{{ old('telefono',$office->telefono) }}" name="telefono" placeholder="Teléfono">
                            <span class="error-container"></span>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label class="control-label" for="punto">Puntos de Ventas<small class="required"> *</small></label>--}}
{{--                            <input type="text" class="form-control" value="{{ old('punto',$office->punto) }}" name="punto" placeholder="Punto">--}}
{{--                            <span class="error-container"></span>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label class="control-label" for="cajero">Cajeros Automáticos</label>
                            <input type="text" class="form-control" value="{{ old('cajero',$office->cajero) }}" name="cajero" placeholder="Cajero">
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label>Tipo de oficina<small class="required"> *</small></label>
                            <select  class="form-control" name="offices_type_id">
                                @foreach($typeOffices as $type)
                                    @if($type->id == $office->tipoOficina->id)
                                        <option value="{{$type->id}}" selected>{{$type->tipo}}</option>
                                    @else
                                        <option value="{{$type->id}}">{{$type->tipo}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label>Provincia<small class="required"> *</small></label>
                            <select id="province" class="form-control" name="province_id">
                                @foreach($provinces as $prov)
                                    @if($prov->id == $office->provincia->id)
                                    <option value="{{$prov->id}}" selected>{{$prov->provincia}}</option>
                                    @else
                                    <option value="{{$prov->id}}">{{$prov->provincia}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label>Municipio<small class="required"> *</small></label>
                            <select class="form-control" id="municipality" name="municipality_id">
                                @foreach($municipalities as $mun)
                                    @if($mun->id == $office->municipio->id)
                                        <option value="{{$mun->id}}" selected>{{$mun->municipio}}</option>
                                    @else
                                        <option value="{{$mun->id}}">{{$mun->municipio}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="direccion">Dirección<small class="required"> *</small></label>
                            <textarea class="form-control" name="direccion" placeholder="Dirección">{{ old('direccion',$office->direccion) }}</textarea>
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
            $('#province').on('change', function () {
                var formData = {id: $(this).val()};
                axios.get('/api/extra/municipalities/?id='+$(this).val()).then(resp=> {
                    $("#municipality").html('<option value="">--Seleccionar--</option>');
                    $.each(resp.data,function(key,value){
                        $("#municipality").append('<option value="'+key+'">'+value+'</option>');
                    });
                }).catch(
                    err=>{
                        console.log('Error', err);
                    }
                )
            });

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
                        phone: true,
                    },
                    codigo: {
                        required: true,
                        remote:{
                            url:"/api/extra/unique/",
                            type:"get",
                            data: {
                                value: function () {
                                    return $('#form :input[name="codigo"]').val();
                                }
                                , id: function () {
                                    return $('#form :input[name="codigo"]').data('id')
                                },
                                model: function () {
                                    return $('#form :input[name="codigo"]').data('model')
                                }
                            }
                        }
                    },
                    cajero: {
                        number:true
                    },
                    direccion: {
                        required: true,
                    },
                    offices_type_id: {
                        required: true,
                    },
                    province_id: {
                        required: true,
                    },
                    municipality_id: {
                        required: true,
                    },
                },
                messages: {
                    titulo: {
                        required: 'El campo título es obligatorio',
                    },
                    telefono: {
                        required: 'El campo teléfono es obligatorio',
                    },
                    punto: {
                        required: 'El campo punto es obligatorio',
                    },
                    cajero: {
                        required: 'El campo cajero es obligatorio',
                    },
                    identificacion: {
                        required: 'El campo identificación es obligatorio',
                    },
                    codigo: {
                        required: 'El campo código es obligatorio',
                        remote: 'El campo código debe ser único'
                    },
                    direccion: {
                        required: 'El campo dirección es obligatorio',
                    },
                    offices_type_id: {
                        required: 'El campo tipo de oficina es obligatorio',
                    },
                    province_id: {
                        required: 'El campo provincia es obligatorio',
                    },
                    municipality_id: {
                        required: 'El campo municipio es obligatorio',
                    }
                }
            });
        });
    </script>
@endsection