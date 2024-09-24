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
                        @forelse($services as $service)
                            <tr>
                                <td>{{__('bpa.'.$service->tipo)}}</td>
                                <td>{{ $service->created_by }}</td>
                                <td>{{ \Carbon\Carbon::parse($service->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;">
                                    @can('electronic-bank.edit')
                                    @if($service->tipo == 'banca-electronica')
                                    <a href="{{route('admin.content.electronic-bank.edit', $service->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @endcan
                                    @can('corporative-bank.edit')
                                    @if($service->tipo == 'banca-corporativa')
                                    <a href="{{route('admin.content.corporative-bank.edit', $service->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @endcan
                                    @can('personal-bank.edit')
                                    @if($service->tipo == 'banca-personal')
                                        <a href="{{route('admin.content.personal-bank.edit', $service->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @endcan
                                    @can('tcp-cna.edit')
                                    @if($service->tipo == 'tcp-cna')
                                        <a href="{{route('admin.content.tcp-cna.edit', $service->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
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