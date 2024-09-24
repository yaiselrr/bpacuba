@extends('layouts.admin')
@section('header')
    Crear Rol
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.manager.roles.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="{{route('admin.manager.roles.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('name') has-error @enderror">
                            <label class="control-label" for="name">Nombre del rol<small class="required"> *</small></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="name">
                            <span class="error-container"></span>
                            @error('name')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Permisos<small class="required"> *</small></label>
                            <select multiple="multiple" class="form-control" style="min-height: 200px;" name="permisos[]">
                                @foreach($permisos as $perm)
                                    <option value="{{$perm->id}}">{{$perm->display_name}}</option>
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
                    name: {
                        required: true,
                    },
                    'permisos[]':{
                        required:true
                    }
                },
                messages: {
                    name: {
                        required: 'El campo nombre del rol es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection