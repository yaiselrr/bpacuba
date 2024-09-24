@extends('layouts.admin')
@section('header')
    Editar {{__('bpa.'.$info->tipo)}}
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.terms.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="editForm" role="form" method="post" enctype="multipart/form-data" action="
                    {{route('admin.content.terms.update', $info->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        @foreach($info->imagenes as $imagen)
                            <div class="form-group">
                                <input type="hidden" value="{{$imagen->id}}" name="id[]">
                                <label for="imagen[{{$imagen->id}}]">{{$imagen->nombre}}<small class="required"> *</small></label>
                                <input type="file" name="imagen[{{$imagen->id}}]" accept="application/pdf">
                                <span class="error-container"></span>
                            </div>
                            <div class="mt-3">
                                <a href="{{asset('/storage/'.$imagen->imagen)}}" target="_blank">{{asset('/storage/'.$imagen->imagen)}}</a>
                            </div>
                        @endforeach
                        <div class="form-group @error('descripcion') has-error @enderror">
                            <label for="descripcion">Descripción<small class="required"> *</small></label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                       id="editor1" placeholder="Descripcion">{{old('descripcion',$info->descripcion)}}</textarea>
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
            var count = 1;

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
                    }

                },
                messages: {
                    descripcion: {
                        required: 'El campo descripción es obligatorio'
                    }
                }
            });
            $('input[name^=imagen]').each(function(e) {
                $(this).rules('add', {
                    extension: "pdf",
                    maxsize: 200000,
                    messages:{
                        extension: 'Las extensiones permitidas son pdf',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    }
                });
            });
        });
    </script>
@endsection