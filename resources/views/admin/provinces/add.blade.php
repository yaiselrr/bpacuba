@extends('layouts.admin')
@section('header')
    Crear Provincia
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.nomenclator.provinces.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.nomenclator.provinces.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('provincia') has-error @enderror">
                            <label class="control-label" for="provincia">Provincia<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('provincia') }}" name="provincia" placeholder="provincia">
                            <span class="error-container"></span>
                            @error('provincia')
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
                    provincia: {
                        required: true,
                    }
                },
                messages: {
                    provincia: {
                        required: 'El campo provincia es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection