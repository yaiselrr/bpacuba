@extends('layouts.admin')
@section('header')
    Crear Páginas internas
@endsection
@section('content')
    @include('admin.cancel', ['route'=>route('admin.content.pages.index')])
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <form id="editForm" role="form" method="post" enctype="multipart/form-data" action="
                    {{route('admin.content.pages.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('nombre') has-error @enderror">
                            <label class="control-label" for="nombre">Título<small class="required"> *</small></label>
                            <input type="text" data-model="page" class="form-control" value="{{ old('titulo') }}" name="titulo" placeholder="Título">
                            <span class="error-container"></span>
                            @error('nombre')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Asociada<small class="required"> *</small></label>
                            <select class="form-control" name="services_id">
                                <option value="">--Seleccionar--</option>
                                @foreach($tipos as $t)
                                    <option value="{{$t->id}}">{{$t->tipo}}</option>
                                @endforeach
                            </select>
                            <span class="error-container"></span>
                        </div>
                        <div class="form-group @error('descripcion') has-error @enderror">
                            <label for="descripcion">Descripción<small class="required"> *</small></label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                       id="editor" placeholder="Descripción">{{old('descripcion')}}</textarea>
                            <span class="error-container"></span>
                            @error('descripcion')
                            <span class="help-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <div class="box-header">
                                            <div class="text-center clearfix">
                                                <h3>Archivos</h3>
                                            </div>
                                            <div class="pull-right">
                                                <button id="add-files" class="btn btn-block btn-social  btn-success">
                                                    <i class="fa fa-plus fa-2x"></i> Adicionar
                                                </button>
                                            </div>
                                        </div>
                                    <!-- /.box-header -->
                                        <div class="box-body table-responsive">
                                            <table class="table table-condensed">
                                                <thead>
                                                <tr>
                                                    <th>Nombre<small class="required"> *</small></th>
                                                    <th>Archivo<small class="required"> *</small></th>
                                                    <th class="text-center"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="file-container">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    nombre: {
                        required: true,
                        remote:{
                            url:"/api/extra/unique/",
                            type:"get",
                            data: {
                                value: function () {
                                    return $('#form :input[name="nombre"]').val();
                                }
                                , id: function () {
                                    return $('#form :input[name="nombre"]').data('id')
                                },
                                model: function () {
                                    return $('#form :input[name="nombre"]').data('model')
                                }
                            }
                        }
                    },
                    descripcion: {
                        required: true,
                    },
                    imagen: {
                        extension: "jpg,jpeg,png",
                        maxsize: 200000,
                    }
                },
                messages: {
                    nombre: {
                        required: 'El campo título es obligatorio',
                        remote: 'El campo título debe ser único'
                    },
                    descripcion: {
                        required: 'El campo descripcion es obligatorio'
                    },
                    imagen: {
                        required: 'El campo imagen es obligatorio',
                        extension: 'Las extensiones permitidas son jpg,jpeg y png',
                        maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                    }
                }
            });
            $("#add-files").click(function (evt) {
                evt.preventDefault()
                var elem =  '<tr>\n' +
                '<td>\n' +
                '<div class="form-group">\n' +
                '<input type="text" class="form-control" name="new_nombre['+count+']" placeholder="nombre">\n' +
                '<span class="error-container"></span>\n'+
                '</div>\n' +
                '</td>\n' +
                '<td>\n' +
                '<div class="form-group">\n' +
                '<input type="file" accept="application/pdf"  name="new_fichero['+count+']" >\n' +
                '<span class="error-container"></span>\n'+
                '</div>\n' +
                '</td>\n' +
                '<td style="width: 5px;"><button class="btn btn-danger remove-file"><i class="fa fa-trash"></i></button></td>\n' +
                '</tr>'
                $("#file-container").append(elem);
                count++;
                $('input[name^=new_fichero]').each(function(e) {
                    $(this).rules('add', {
                        required: true,
                        extension: "pdf",
                        // maxsize: 200000,
                        messages:{
                            required: 'El campo fichero es obligatorio',
                            extension: 'Las extensiones permitidas son pdf',
                            // maxsize: 'El tamaño del archivo no debe exceder los 2Mb',
                        }
                    });
                });
                $('input[name^=new_nombre]').each(function(e) {
                    $(this).rules('add', {
                        required: true,
                        messages:{
                            required: 'El campo nombre es obligatorio'
                        }
                    });
                });

            })
            $("#file-container").on('click','.remove-file', function (evt) {
                evt.preventDefault();
                $(this).parents('tr').remove();
            })
        });
    </script>
@endsection