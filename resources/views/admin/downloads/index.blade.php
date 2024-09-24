@extends('layouts.admin')
@section('header')
    Descargas
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de descargas</h3>
                    <div class="pull-right">
                        @can('downloads.create')
                        <a class="btn btn-block btn-social  btn-success" href="{{route('admin.content.downloads.create')}}">
                            <i class="fa fa-plus fa-2x"></i> Adicionar
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-condensed">
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Pública</th>
                            <th>Actualizado</th>
                            <th colspan="2" class="text-center">Operaciones</th>
                        </tr>
                        @forelse($downloads as $download)
                            <tr>
                                <td>{{ $download->titulo }}</td>
                                <td>{{ $download->created_by }}</td>
                                <td>
                                    @if($download->publica)
                                    <span class="badge bg-green"><i class="fa fa-check-circle"></i></span>
                                    @else
                                        <span class="badge bg-red"><i class="fa fa-close"></i></span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($download->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;">
                                    @can('downloads.edit')
                                    <a href="{{route('admin.content.downloads.edit', $download->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td style="width: 5px;">
                                    @can('downloads.destroy')
                                    <a data-toggle="modal" data-route="{{route('admin.content.downloads.destroy', $download->id)}}" data-target="#modal-delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
                    {{ $downloads->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection