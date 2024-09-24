@extends('layouts.admin')
@section('header')
    Editar {{__('bpa.'.$info->tipo)}}
@endsection
@section('content')
    @if($info->tipo == 'info-financiera')
    @include('admin.cancel', ['route'=>route('admin.content.finances-info.index')])
    @elseif($info->tipo == 'actividad-internacional')
    @include('admin.cancel', ['route'=>route('admin.content.international-activity.index')])
    @elseif($info->tipo == 'tasa_interes')
        @include('admin.cancel', ['route'=>route('admin.content.interes.index')])
    @endif
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="editForm" role="form" method="post" enctype="multipart/form-data" action="
                    @if($info->tipo == 'info-financiera')
                    {{route('admin.content.finances-info.update', $info->id)}}
                    @elseif($info->tipo == 'actividad-internacional')
                    {{route('admin.content.international-activity.update', $info->id)}}
                    @elseif($info->tipo == 'tasa_interes')
                    {{route('admin.content.interes.update', $info->id)}}
                    @endif">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        @foreach($info->imagenes as $imagen)
                            <div class="form-group">
                                <input type="hidden" value="{{$imagen->id}}" name="id[]">
                                <label for="imagen[{{$imagen->id}}]">{{$imagen->nombre}}<small class="required"> *</small></label>
                                <input type="file" name="imagen[{{$imagen->id}}]" accept="image/*">
                                <span class="help-block">{{__('bpa.dimensiones', ['dim' => '458x185'])}}</span>
                                <span class="help-block">{{__('bpa.extensiones')}}</span>
                                <span class="error-container"></span>
                            </div>
                            <div class="mt-3">
                                <img src="{{asset('/storage/'.$imagen->imagen)}}" class="img-responsive img-thumbnail" width="75px"
                                     height="75px" alt="User Image">
                            </div>
                        @endforeach
                        @if($info->tipo == 'tasa_interes')
                            <div class="form-group @error('home_text') has-error @enderror" style="margin-top: 15px;">
                                <label for="home_text">Descripción principal<small class="required"> *</small></label>
                                <textarea name="home_text" class="form-control @error('home_text') is-invalid @enderror"
                                          id="editor" placeholder="home_text">{{old('home_text',$info->home_text)}}</textarea>
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
                    home_text: {
                        required: true,
                    },
                    descripcion: {
                        required: true,
                    }
                },
                messages: {

                    home_text: {
                        required: 'El campo descripción principal es obligatorio'
                    },
                    descripcion: {
                        required: 'El campo descripción es obligatorio'
                    }
                }
            });
            $('input[name^=imagen]').each(function(e) {
                $(this).rules('add', {
                    extension: "jpeg|jpg|png",
                    checkDim: [458, 185],
                    maxsize: 200000,
                    messages:{
                        extension: 'Las extensiones permitidas son jpg,jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    }
                });
            });
        });
    </script>
@endsection