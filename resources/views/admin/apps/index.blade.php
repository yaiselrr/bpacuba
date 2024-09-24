@extends('layouts.admin')
@section('header')
    Aplicaciones móviles
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de aplicaciones móviles</h3>
                    <div class="pull-right">
                        @can('apps.create')
                        <a class="btn btn-block btn-social  btn-success" href="{{route('admin.content.apps.create')}}">
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
                        @forelse($apps as $app)
                            <tr>
                                <td>{{ $app->titulo }}</td>
                                <td>{{ $app->created_by }}</td>
                                <td>
                                    @if($app->publica)
                                    <span class="badge bg-green"><i class="fa fa-check-circle"></i></span>
                                    @else
                                        <span class="badge bg-red"><i class="fa fa-close"></i></span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($app->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;"><a href="{{route('admin.content.apps.edit', $app->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                                <td style="width: 5px;"><a data-toggle="modal" data-route="{{route('admin.content.apps.destroy', $app->id)}}" data-target="#modal-delete" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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
                    {{ $apps->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection