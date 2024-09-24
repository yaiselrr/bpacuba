@extends('layouts.admin')
@section('header')
    Roles
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de roles</h3>
                    <div class="pull-right">
                        @can('roles.create')
                        <a class="btn btn-block btn-social  btn-success" href="{{route('admin.manager.roles.create')}}">
                            <i class="fa fa-plus fa-2x"></i> Adicionar
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-condensed">
                        <tr>
                            <th>Rol</th>
                            <th colspan="2" class="text-center">Operaciones</th>
                        </tr>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td style="width: 5px;">
                                    @can('roles.edit')
                                    <a href="{{route('admin.manager.roles.edit', $role->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td style="width: 5px;">
                                @can('roles.destroy')
                                @if(Auth::user()->rol->id == $role->id)
                                    <button class="btn btn-default" disabled><i class="fa fa-trash"></i></button>
                                @else
                                    <a data-toggle="modal" data-route="{{route('admin.manager.roles.destroy', $role->id)}}" data-target="#modal-delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                @endif
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
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection