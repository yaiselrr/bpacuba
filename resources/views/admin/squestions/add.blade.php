@extends('layouts.admin')
@section('header')
    Crear Pregunta de encuesta
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.squestions.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="addForm" name="addForm" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.squestions.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('pregunta') has-error @enderror">
                            <label class="control-label" for="pregunta">Pregunta<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('pregunta') }}" name="pregunta" placeholder="Pregunta">
                            <span class="error-container">
                            </span>
                            @error('pregunta')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
{{--                        <div class="form-group @error('si') has-error @enderror">--}}
{{--                            <label class="control-label" for="si">Sí<small class="required"> *</small></label>--}}
{{--                            <input type="text" class="form-control"  value="{{ old('si',0) }}" name="si" placeholder="Sí">--}}
{{--                            <span class="error-container">--}}
{{--                            </span>--}}
{{--                            @error('si')--}}
{{--                            <span class="help-block" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group @error('no') has-error @enderror">--}}
{{--                            <label class="control-label" for="no">No<small class="required"> *</small></label>--}}
{{--                            <input type="text" class="form-control"  value="{{ old('no',0) }}" name="no" placeholder="No">--}}
{{--                            <span class="error-container">--}}
{{--                            </span>--}}
{{--                            @error('no')--}}
{{--                            <span class="help-block" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group @error('mejorar') has-error @enderror">--}}
{{--                            <label class="control-label" for="si">Mejorar<small class="required"> *</small></label>--}}
{{--                            <input type="text" class="form-control"  value="{{ old('mejorar',0) }}" name="mejorar" placeholder="Mejorar">--}}
{{--                            <span class="error-container">--}}
{{--                            </span>--}}
{{--                            @error('mejorar')--}}
{{--                            <span class="help-block" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
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
            $("#addForm").validate({
                ignore: [],
                lang: 'es',
                onfocusout: function (element) {
                    $(element).valid();
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent(".form-group").find(".error-container"));
                },
                rules: {
                    pregunta: {
                        required: true,
                    },
                    si: {
                        required: true,
                    },
                    no: {
                        required: true,
                    },
                    mejorar: {
                        required: true,
                    }
                },
                messages: {
                    pregunta: {
                        required: 'El campo pregunta es obligatorio'
                    },
                    si: {
                        required: 'El campo sí es obligatorio'
                    },
                    no: {
                        required: 'El campo no es obligatorio'
                    },
                    mejorar: {
                        required: 'El campo mejorar es obligatorio'
                    },
                }
            });
        });
    </script>
@endsection