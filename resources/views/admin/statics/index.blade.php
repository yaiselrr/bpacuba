@extends('layouts.admin')
@section('header')
    Otras informaciones del sitio
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de otras informaciones del sitio</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-condensed">
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Actualizado</th>
                            <th class="text-center">Operaciones</th>
                        </tr>
                        @forelse($statics as $static)
                            <tr>
                                <td>{{ __('bpa.'.$static->tipo) }}</td>
                                <td>{{ $static->created_by }}</td>
                                <td>{{ \Carbon\Carbon::parse($static->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;">
                                    @can('statics.edit')
                                    <a href="{{route('admin.content.statics.edit', $static->tipo)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
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