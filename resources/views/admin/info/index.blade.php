@extends('layouts.admin')
@section('header')
    {{__('bpa.'.$tipo)}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__('bpa.'.$tipo)}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-condensed">
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Actualizado</th>
                            <th colspan="1" class="text-center">Operaciones</th>
                        </tr>
                        @forelse($infos as $info)
                            <tr>
                                <td>{{__('bpa.'.$info->tipo)}}</td>
                                <td>{{ $info->created_by }}</td>
                                <td>{{ \Carbon\Carbon::parse($info->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;">
                                    @can('finances-info.edit')
                                    @if($info->tipo == 'info-financiera')
                                    <a href="{{route('admin.content.finances-info.edit', $info->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @endcan
                                    @can('international-activity.edit')
                                    @if($info->tipo == 'actividad-internacional')
                                        <a href="{{route('admin.content.international-activity.edit', $info->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @endcan
                                    @can('interes.edit')
                                    @if($info->tipo == 'tasa_interes')
                                        <a href="{{route('admin.content.interes.edit', $info->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @endcan
                                    @can('terms.edit')
                                        @if($info->tipo == 'tarifas-terminos')
                                            <a href="{{route('admin.content.terms.edit', $info->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        @endif
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