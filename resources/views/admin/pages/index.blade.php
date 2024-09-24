@extends('layouts.admin')
@section('header')
    Páginas internas
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de Páginas internas</h3>
                    <div class="pull-right">
                        @can('pages.create')
                            <a class="btn btn-block btn-social  btn-success" href="{{route('admin.content.pages.create')}}">
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
                            <th>Asociado a</th>
                            <th>Actualizado</th>
                            <th colspan="2" class="text-center">Operaciones</th>
                        </tr>
                        @forelse($pages as $page)
                            <tr>
                                <td>{{$page->titulo}}</td>
                                <td>{{ $page->created_by }}</td>
                                <td>{{$page->servicio->tipo}}</td>
                                <td>{{ \Carbon\Carbon::parse($page->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;">
                                    @can('pages.edit')
                                    <a href="{{route('admin.content.pages.edit', $page->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td style="width: 5px;">
                                    @can('pages.destroy')
                                        <a data-toggle="modal" data-route="{{route('admin.content.pages.destroy', $page->id)}}" data-target="#modal-delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" align="center">No existen elementos a mostrar</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection