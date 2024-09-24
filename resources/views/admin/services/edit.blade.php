@extends('layouts.admin')
@section('header')
    Editar {{__('bpa.'.$service->tipo)}}
@endsection
@section('content')
    @if($service->tipo == 'banca-electronica')
    @include('admin.cancel', ['route'=>route('admin.content.electronic-bank.index')])
    @elseif($service->tipo == 'banca-corporativa')
    @include('admin.cancel', ['route'=>route('admin.content.corporative-bank.index')])
    @elseif($service->tipo == 'banca-personal')
    @include('admin.cancel', ['route'=>route('admin.content.personal-bank.index')])
    @else
        @include('admin.cancel', ['route'=>route('admin.content.tcp-cna.index')])
    @endif
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="editForm" role="form" method="post" enctype="multipart/form-data" action="
                    @if($service->tipo == 'banca-electronica')
                    {{route('admin.content.electronic-bank.update', $service->id)}}
                    @elseif($service->tipo == 'banca-corporativa')
                    {{route('admin.content.corporative-bank.update', $service->id)}}
                    @elseif($service->tipo == 'banca-personal')
                    {{route('admin.content.personal-bank.update', $service->id)}}
                    @else
                    {{route('admin.content.tcp-cna.update', $service->id)}}
                    @endif">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('imagen') has-error @enderror">
                            <label for="imagen">Imagen</label>
                            <input type="file" name="imagen" accept="image/*"  class="@error('imagen') is-invalid @enderror">
                            <span class="help-block">{{__('bpa.dimensiones', ['dim' => '590x390'])}}</span>
                            <span class="help-block">{{__('bpa.extensiones')}}</span>
                            <span class="error-container"></span>
                            @error('imagen')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        @if($service->imagen)
                        <div class="mt-3">
                            <img src="{{asset('/storage/'.$service->imagen)}}" class="img-responsive img-thumbnail" width="75px"
                                 height="75px" alt="User Image">
                        </div>
                        @endif
                        <div class="form-group @error('descripcion') has-error @enderror">
                            <label for="descripcion">Descripción<small class="required"> *</small></label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                       id="editor" placeholder="Descripción">{{old('descripcion',$service->descripcion)}}</textarea>
                            <span class="error-container"></span>
                            @error('descripcion')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group @error('valoracion') has-error @enderror">
                            <label for="valoracion">Descripción de evaluación<small class="required"> *</small></label>
                            <textarea name="valoracion" class="form-control @error('valoracion') is-invalid @enderror"
                                       id="editor1" placeholder="Descripción">{{old('valoracion',$service->valoracion)}}</textarea>
                            <span class="error-container"></span>
                            @error('valoracion')
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
                onfocusout: function (element) {
                    $(element).valid();
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent(".form-group").find(".error-container"));
                },
                rules: {
                    descripcion: {
                        required: true,
                    },
                    valoracion: {
                        required: true,
                    },
                    imagen: {
                        extension: "jpg,jpeg,png",
                        checkDim: [590, 390],
                        maxsize: 200000,
                    }
                },
                messages: {
                    descripcion: {
                        required: 'El campo descripción es obligatorio'
                    },
                    valoracion: {
                        required: 'El campo descripción de evaluación es obligatorio'
                    },
                    imagen: {
                        required: 'El campo imagen es obligatorio',
                        extension: 'Las extensiones permitidas son jpg,jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    }
                }
            });
        });
    </script>
@endsection