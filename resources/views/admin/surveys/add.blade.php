@extends('layouts.admin')
@section('header')
    Crear Encuesta
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.surveys.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="addForm" name="addForm" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.content.surveys.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('estrellas') has-error @enderror">
                            <label class="control-label" for="estrellas">Valoración<small class="required"> *</small></label>
                            <input type="text" class="form-control" maxlength="1" value="{{ old('estrellas') }}" name="estrellas" placeholder="Valoración">
                            <span class="error-container">
                            </span>
                            @error('estrellas')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('sugerencias') has-error @enderror">
                            <label for="sugerencias">Sugerencias</label>
                            <textarea name="sugerencias" class="form-control @error('sugerencias') is-invalid @enderror"  placeholder="Sugerencias">{{ old('sugerencias') }}</textarea>
                            <span class="error-container">
                            </span>
                            @error('sugerencias')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div></div>
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
                    estrellas: {
                        required: true,
                        range: [1, 5]
                    },
                    sugerencias: {
                        required: true,
                    }
                },
                messages: {
                    estrellas: {
                        required: 'El campo valoración es obligatorio'
                    },
                    sugerencias: {
                        required: 'El campo sugerencias es obligatorio'
                    },
                }
            });
        });
    </script>
@endsection