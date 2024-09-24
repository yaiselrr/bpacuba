@extends('layouts.admin')
@section('header')
    Editar Pregunta de encuesta
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.squestions.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.squestions.update', $squestion->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('pregunta') has-error @enderror">
                            <label class="control-label" for="pregunta">Pregunta<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="pregunta" value="{{old('pregunta',$squestion->pregunta)}}" placeholder="Pregunta">
                            <span class="error-container"></span>
                            @error('pregunta')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
{{--                        <div class="form-group @error('si') has-error @enderror">--}}
{{--                            <label class="control-label" for="no">Sí<small class="required"> *</small></label>--}}
{{--                            <input type="text" class="form-control" name="si" value="{{old('si',$squestion->si)}}" placeholder="Sí">--}}
{{--                            <span class="error-container"></span>--}}
{{--                            @error('si')--}}
{{--                            <span class="help-block" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group @error('no') has-error @enderror">--}}
{{--                            <label class="control-label" for="no">No<small class="required"> *</small></label>--}}
{{--                            <input type="text" class="form-control" name="no" value="{{old('no',$squestion->no)}}" placeholder="No">--}}
{{--                            <span class="error-container"></span>--}}
{{--                            @error('no')--}}
{{--                            <span class="help-block" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group @error('mejorar') has-error @enderror">--}}
{{--                            <label class="control-label" for="mejorar">Mejorar<small class="required"> *</small></label>--}}
{{--                            <input type="text" class="form-control" name="mejorar" value="{{old('mejorar',$squestion->mejorar)}}" placeholder="Mejorar">--}}
{{--                            <span class="error-container"></span>--}}
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
                    pregunta: {
                        required: true,
                    },
                    mejorar: {
                        required: true,
                    },
                    no: {
                        required: true,
                    },
                    si: {
                        required: true,
                        }
                },
                messages: {
                    pregunta: {
                        required: 'El campo pregunta es obligatorio',
                    },
                    mejorar: {
                        required: 'El campo mejorar es obligatorio',
                    },
                    no: {
                        required: 'El campo no es obligatorio',
                    },
                    si: {
                        required: 'El campo sí es obligatorio',
                    }
                }
            });
        });
    </script>
@endsection