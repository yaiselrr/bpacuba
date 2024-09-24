@extends('layouts.admin')
@section('header')
    Sobre nosotros
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Sobre nosotros</h3>
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
                        @forelse($about as $us)
                            <tr>
                                <td>Sobre nosotros</td>
                                <td>{{ $us->created_by }}</td>
                                <td>{{ \Carbon\Carbon::parse($us->updated_at)->format('d/m/Y') }}</td>
                                <td style="width: 5px;">
                                    @can('about-us.edit')
                                    <a href="{{route('admin.content.about-us.edit', $us->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
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