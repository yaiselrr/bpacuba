@extends('layouts.admin')
@section('header')
    Editar {{__('bpa.'.$static->tipo)}}
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.statics.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="form" role="form" method="post" action="{{route('admin.content.statics.update', $static->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <input type="hidden" value="{{$static->tipo}}" name="tipo"/>
                        @if($static->tipo == 'tarifas-terminos' || $static->tipo == 'productos-servicios')
                        <div class="form-group @error('home_text') has-error @enderror">
                            <label for="home_text">Descripción Principal<small class="required"> *</small></label>
                            <textarea name="home_text" class="form-control @error('home_text') is-invalid @enderror"
                                      id="editor" placeholder="Descripción Principal">{{old('home_text',$static->home_text)}}</textarea>
                            <span class="error-container"></span>
                            @error('home_text')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        @endif
                        <div class="form-group @error('descripcion') has-error @enderror">
                            <label for="descripcion">Descripción<small class="required"> *</small></label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                       id="editor1" placeholder="Descripción">{{old('descripcion',$static->descripcion)}}</textarea>
                            <span class="error-container"></span>
                            @error('descripcion')
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
                    home_text: {
                        required: true,
                    },
                    descripcion: {
                        required: true,
                        }
                },
                messages: {
                    home_text: {
                        required: 'El campo descripcion principal es obligatorio'
                    },
                    descripcion: {
                        required: 'El campo descripcion es obligatorio',
                        }
                }
            });
        });
    </script>
@endsection