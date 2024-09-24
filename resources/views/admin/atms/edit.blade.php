@extends('layouts.admin')
@section('header')
    Editar Cajeros automáticos
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.atms.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.atms.update', $atm->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label" for="titulo">Título<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{old('titulo',$atm->titulo)}}" name="titulo" placeholder="Título">
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="codigo">Código<small class="required"> *</small></label>
                            <input type="text" data-model="atm" data-id="{{$atm->id}}" maxlength="4" class="form-control" value="{{old('codigo',$atm->codigo)}}" name="codigo" placeholder="Código">
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="referencia">Referencia</label>
                            <input type="text" class="form-control" value="{{old('referencia',$atm->referencia)}}" name="referencia" placeholder="Referencia">
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group">
                            <label>Provincia<small class="required"> *</small></label>
                            <select id="province" class="form-control" name="province_id">
                                @foreach($provinces as $prov)
                                    @if($prov->id == $atm->provincia->id)
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
                                    @if($mun->id == $atm->municipio->id)
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
                            <textarea class="form-control" name="direccion" placeholder="Dirección">{{ old('direccion',$atm->direccion) }}</textarea>
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
                    // referencia: {
                    //     required: true,
                    // },
                    direccion: {
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
                    // referencia: {
                    //     required: 'El campo referencia es obligatorio',
                    // },
                    codigo: {
                        required: 'El campo código es obligatorio',
                        remote: 'El campo código debe ser único'
                    },
                    direccion: {
                        required: 'El campo dirección es obligatorio',
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