@extends('layouts.admin')
@section('header')
    Usuarios
@endsection
@section('content')
    @include('admin.delete')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de Usuarios</h3>
                    <div class="pull-right">
                        @can('users.create')
                        <a class="btn btn-block btn-social  btn-success" href="{{route('admin.manager.users.create')}}">
                            <i class="fa fa-plus fa-2x"></i> Adicionar
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-condensed">
                        <tr>
                            <th>Nombre y apellidos</th>
                            <th>Correo electrónico</th>
                            <th>Rol</th>
                            <th colspan="3" class="text-center">Operaciones</th>
                        </tr>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->rol->name }}</td>
                                <td style="width: 5px;">
                                    @can('users.edit')
                                    <a href="{{route('admin.manager.users.edit', $user->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td style="width: 5px;">
                                    @can('users.edit')
                                    <a href="{{route('admin.manager.users.password-reset', $user->id)}}" class="btn btn-info"><i class="fa fa-key"></i></a>
                                    @endcan
                                </td>
                                <td style="width: 5px;">
                                @can('users.destroy')
                                @if(Auth::user()->id == $user->id)
                                    <button class="btn btn-default" disabled><i class="fa fa-trash"></i></button></td>
                                @else
                                    <a data-toggle="modal" data-route="{{route('admin.manager.users.destroy', $user->id)}}" data-target="#modal-delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection