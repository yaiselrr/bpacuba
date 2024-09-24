@extends('layouts.admin')
@section('header')
    Tipo de oficinas
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de tipos de oficinas</h3>
                    <div class="pull-right">
                        @can('type-offices.create')
                        <a class="btn btn-block btn-social  btn-success" href="{{route('admin.nomenclator.type-offices.create')}}">
                            <i class="fa fa-plus fa-2x"></i> Adicionar
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-condensed">
                        <tr>
                            <th>Título</th>
                            <th colspan="2" class="text-center">Operaciones</th>
                        </tr>
                        @forelse($offices_type as $office_type)
                            <tr>
                                <td>{{ $office_type->tipo }}</td>
                                <td style="width: 5px;">
                                    @can('type-offices.edit')
                                    <a href="{{route('admin.nomenclator.type-offices.edit', $office_type->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td style="width: 5px;">
                                    @can('type-offices.destroy')
                                    <a data-toggle="modal" data-route="{{route('admin.nomenclator.type-offices.destroy', $office_type->id)}}" data-target="#modal-delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">No existen elementos a mostrar</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {{ $offices_type->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection