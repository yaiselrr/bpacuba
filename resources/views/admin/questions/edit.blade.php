@extends('layouts.admin')
@section('header')
    Editar Preguntas frecuentes
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.questions.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.questions.update', $question->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('pregunta') has-error @enderror">
                            <label class="control-label" for="pregunta">Pregunta<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="pregunta" value="{{old('pregunta',$question->pregunta)}}" placeholder="Título">
                            <span class="error-container"></span>
                            @error('pregunta')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('respuesta') has-error @enderror">
                            <label for="respuesta">Respuesta<small class="required"> *</small></label>
                            <textarea name="respuesta" class="form-control @error('respuesta') is-invalid @enderror"
                                       id="editor" placeholder="Respuesta">{{old('respuesta',$question->respuesta)}}</textarea>
                            <span class="error-container"></span>
                            @error('respuesta')
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
                    pregunta: {
                        required: true,
                    },
                    respuesta: {
                        required: true,
                        }
                },
                messages: {
                    pregunta: {
                        required: 'El campo pregunta es obligatorio'
                    },
                    respuesta: {
                        required: 'El campo respuesta es obligatorio',
                        }
                }
            });
        });
    </script>
@endsection