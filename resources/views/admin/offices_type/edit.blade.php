@extends('layouts.admin')
@section('header')
    Editar Tipo de oficina
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.nomenclator.type-offices.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" action="{{route('admin.nomenclator.type-offices.update', $office_type->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('tipo') has-error @enderror">
                            <label class="control-label" for="titulo">Tipo de oficina<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="tipo" value="{{old('tipo',$office_type->tipo)}}" placeholder="Título">
                            <span class="error-container"></span>
                            @error('tipo')
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
                    tipo: {
                        required: true,
                    }
                },
                messages: {
                    tipo: {
                        required: 'El campo tipo de oficina es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection