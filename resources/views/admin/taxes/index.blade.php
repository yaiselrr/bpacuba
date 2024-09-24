@extends('layouts.admin')
@section('header')
    Tasas de cambio
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de Tasas de cambio</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-condensed">
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Actualizado</th>
                            <th colspan="1" class="text-center">Operaciones</th>
                        </tr>
                        @forelse($taxes as $tax)
                            <tr>
                                <td>{{__('bpa.taxes')}}</td>
                                <td>{{ $tax->created_by }}</td>
                                <td>{{ \Carbon\Carbon::parse($tax->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;">
                                    @can('taxes.edit')
                                    <a href="{{route('admin.content.taxes.edit', $tax->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
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
                    {{ $taxes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection