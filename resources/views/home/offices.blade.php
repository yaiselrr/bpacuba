@extends('layouts.bpa')
@section('general-info')
active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Red de oficinas</li>
@endsection
@section('title')
    Red de Oficinas
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div class="pb-4">{!! $info->descripcion !!}</div>
     </div>
     <div class="col-md-12 text-muted text-center">
         <div class="p-1 font-weight-bold">Sucursales y Cajas de Ahorro</div>
     </div>
     <div class="col-md-12">
         <div class="p-3 bg-light">
        <form id="form" role="form" class="form-inline mb-0 justify-content-center" method="get" action="{{route('home.offices')}}">
                 @csrf
                     <div class="form-group col-md-3">

                         <select id="province" class="form-control w-100" name="province">
                             <option value="">--Provincia--</option>
                             @foreach($provinces as $prov)
                                 @if($selectedp && $selectedp==$prov->id)
                                 <option selected value="{{$prov->id}}">{{$prov->provincia}}</option>
                                 @else
                                 <option value="{{$prov->id}}">{{$prov->provincia}}</option>
                                 @endif
                             @endforeach
                         </select>
                     </div>
                     <div class="form-group col-md-3">
                         <select id="municipality" class="form-control w-100" name="municipality">
                             <option value="">--Municipio--</option>
                             @foreach($municipalities as $m)
                                 @if($selectedm && $selectedm==$m->id)
                                 <option selected value="{{$m->id}}">{{$m->municipio}}</option>
                                 @else
                                 <option value="{{$m->id}}">{{$m->municipio}}</option>
                                 @endif
                             @endforeach
                         </select>
                     </div>
                     <div class="form-group col-md-3">
                         <select class="form-control w-100" name="officeType">
                             <option value="">--Tipos de oficina--</option>
                             @foreach($types as $t)
                                 @if($selectedt && $selectedt==$t->id)
                                 <option selected value="{{$t->id}}">{{$t->tipo}}</option>
                                 @else
                                 <option value="{{$t->id}}">{{$t->tipo}}</option>
                                 @endif
                             @endforeach
                         </select>
                     </div>
                    <div class="col-md-2">
                         <button type="submit" class="btn btn-success ">Buscar</button>
                    </div>
             </form>
         </div>
     </div>
     <div class="col-md-12 pt-2">
        <div class="row">
         @foreach($offices as $office)
             @if($loop->index > 0)
                 @if($offices[$loop->index-1]->provincia->id != $office->provincia->id)
                <div class="col-md-12 pr-4 pl-4 text-center text-muted">
                    <h3>{{$office->provincia->provincia}}</h3>
                    <div class="divider"></div>
                </div>
                @endif
                 @if($offices[$loop->index-1]->municipio->id != $office->municipio->id)
                 <div class="col-md-12 pl-2 pr-2 mb-2">
                     <div class="p-2 pl-5 h-100 bg-dark text-light rounded-pill">
                         <h5>{{$office->municipio->municipio}}</h5>
                     </div>
                 </div>
                 @endif
            @else
                <div class="col-md-12 pr-4 pl-4 text-muted text-center">
                    <h3>{{$office->provincia->provincia}} </h3>
                    <div class="divider"></div>
                </div>
                <div class="col-md-12 pl-2 pr-2 mb-2">
                    <div class="p-2 pl-5 h-100 bg-dark text-light rounded-pill">
                        <h5>{{$office->municipio->municipio}}</h5>
                    </div>
                </div>
            @endif
             <div class="col-md-4 pb-2">
                <div class="card h-100">
                <div class="card-header">
                    <div class="card-text">{{$office->tipoOficina->tipo}}</div>
                </div>
                <div class="card-body">
                    <div class="card-text pb-1 text-muted"><small><strong>Código:</strong> {{$office->codigo}}</small></div>
                    <div class="card-text pb-1 text-muted"><small><strong>Referencia:</strong> {{$office->identificacion}}</small></div>
                    <div class="card-text pb-1 text-muted"><small><strong>Dirección:</strong> {{$office->direccion}}</small></div>
                    <div class="card-text text-muted pb-1"><small><strong>Teléfono:</strong> {{$office->telefono}}</small></div>
                    <div class="card-text text-muted pb-1"><small><strong>Cajeros Automáticos:</strong> {{$office->cajero}}</small></div>
{{--                    <div class="card-text text-muted pb-1"><small><strong>Puntos de Ventas:</strong> {{$office->punto}}</small></div>--}}
                </div>
            </div>
             </div>
        @endforeach
        </div>
     <div class="pagination-layer">{{ $offices->links() }}</div>
     </div>
 </div>
@endsection
<style>
    .pagination-layer ul{
        justify-content: center;
    }
</style>
@section('morejs')
    <script>
        $(document).ready(function() {
            $('#province').on('change', function () {
                var formData = {id: $(this).val()};
                axios.get('/api/extra/municipalities/?id='+$(this).val()).then(resp=> {
                    $("#municipality").html('<option value="">--Seleccionar--</option>');
                    $.each(resp.data,function(key,value){
                        $("#municipality").append('<option value="'+key+'">'+value+'</option>');
                    });
                }).catch(
                    err=>{
                        console.log('Error', err);
                    }
                )
            });
        });
    </script>
@endsection