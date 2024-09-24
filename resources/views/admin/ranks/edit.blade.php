@extends('layouts.admin')
@section('header')
    Editar Cargos de directivos
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.nomenclator.ranks.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.nomenclator.ranks.update', $rank->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('cargo') has-error @enderror">
                            <label class="control-label" for="cargo">Cargo<small class="required"> *</small></label>
                            <input type="text" class="form-control" name="cargo" value="{{old('cargo',$rank->cargo)}}" placeholder="Cargo">
                            <span class="error-container"></span>
                            @error('cargo')
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
                    cargo: {
                        required: true,
                    }
                },
                messages: {
                    cargo: {
                        required: 'El campo cargo es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection