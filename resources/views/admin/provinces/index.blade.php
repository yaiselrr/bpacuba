@extends('layouts.admin')
@section('header')
    Provincias
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de provincias</h3>
                    <div class="pull-right">
                        @can('provinces.create')
                        <a class="btn btn-block btn-social  btn-success" href="{{route('admin.nomenclator.provinces.create')}}">
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
                        @forelse($provinces as $province)
                            <tr>
                                <td>{{ $province->provincia }}</td>
                                <td style="width: 5px;">
                                    @can('provinces.edit')
                                    <a href="{{route('admin.nomenclator.provinces.edit', $province->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td style="width: 5px;">
                                    @can('provinces.destroy')
                                    <a data-toggle="modal" data-route="{{route('admin.nomenclator.provinces.destroy', $province->id)}}" data-target="#modal-delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
                    {{ $provinces->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection