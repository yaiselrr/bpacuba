@extends('layouts.admin')
@section('header')
    Crear Municipio
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.nomenclator.municipalities.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.nomenclator.municipalities.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('municipio') has-error @enderror">
                            <label class="control-label" for="municipio">Municipio<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('municipio') }}" name="municipio" placeholder="Municipio">
                            <span class="error-container"></span>
                            @error('municipio')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Provincia<small class="required"> *</small></label>
                            <select class="form-control" name="province_id">
                                <option value="">--Seleccionar--</option>
                                @foreach($provinces as $prov)
                                    <option value="{{$prov->id}}">{{$prov->provincia}}</option>
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
                    municipio: {
                        required: true,
                    },
                    province_id: {
                        required: true,
                    }
                },
                messages: {
                    municipio: {
                        required: 'El campo municipio es obligatorio'
                    },
                    province_id: {
                        required: 'El campo provincia es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection