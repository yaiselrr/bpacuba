@extends('layouts.admin')
@section('header')
    Oficinas
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de oficinas</h3>
                    <div class="pull-right">
                        @can('offices.create')
                        <a class="btn btn-block btn-social  btn-success" href="{{route('admin.content.offices.create')}}">
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
                            <th>Autor</th>
                            <th>Actualizado</th>
                            <th colspan="2" class="text-center">Operaciones</th>
                        </tr>
                        @forelse($offices as $office)
                            <tr>
                                <td>{{ $office->titulo }}</td>
                                <td>{{ $office->created_by }}</td>
                                <td>{{ \Carbon\Carbon::parse($office->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;">
                                    @can('offices.edit')
                                    <a href="{{route('admin.content.offices.edit', $office->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td style="width: 5px;">
                                    @can('offices.destroy')
                                    <a data-toggle="modal" data-route="{{route('admin.content.offices.destroy', $office->id)}}" data-target="#modal-delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
                    {{ $offices->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection