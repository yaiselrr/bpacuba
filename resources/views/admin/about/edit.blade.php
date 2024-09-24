@extends('layouts.admin')
@section('header')
    Editar Sobre nosotros
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.about-us.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="editForm" role="form" method="post" action="{{route('admin.content.about-us.update', $about->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('mision') has-error @enderror">
                            <label for="home_text">Misión<small class="required"> *</small></label>
                            <textarea name="mision" class="form-control @error('mision') is-invalid @enderror"
                                      id="editor" placeholder="Mision">{{old('mision',$about->mision)}}</textarea>
                            <span class="error-container"></span>
                            @error('home_text')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('vision') has-error @enderror">
                            <label for="vision">Visión<small class="required"> *</small></label>
                            <textarea name="vision" class="form-control @error('vision') is-invalid @enderror"
                                       id="editor1" placeholder="Vision">{{old('vision',$about->vision)}}</textarea>
                            <span class="error-container"></span>
                            @error('vision')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('objetivos') has-error @enderror">
                            <label for="descripcion">Objetivos de trabajo<small class="required"> *</small></label>
                            <textarea name="objetivos" class="form-control @error('objetivos') is-invalid @enderror"
                                       id="editor2" placeholder="Objetivos">{{old('objetivos',$about->objetivos)}}</textarea>
                            <span class="error-container"></span>
                            @error('objetivos')
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
            $("#editForm").validate({
                ignore: [],
                lang: 'es',
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent(".form-group").find(".error-container"));
                },
                rules: {
                    mision: {
                        required: true,
                        editorlength: 600,
                    },
                    vision: {
                        required: true,
                        editorlength: 600,
                    },
                    objetivos: {
                        required: true,
                    }
                },
                messages: {
                    mision: {
                        required: 'El campo misión es obligatorio',
                        editorlength: 'El campo misión admite hasta 600 caracteres'
                    },
                    vision: {
                        required: 'El campo visión es obligatorio',
                        editorlength: 'El campo visión admite hasta 600 caracteres'
                    },
                    objetivos: {
                        required: 'El campo objetivos es obligatorio'
                    }
                }
            });
        });
    </script>
@endsection