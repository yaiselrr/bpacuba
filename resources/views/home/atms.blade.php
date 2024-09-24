@extends('layouts.bpa')
{{--@section('general-info')--}}
{{--active--}}
{{--@endsection--}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cajeros Automáticos</li>
@endsection
@section('title')
    Cajeros Automáticos
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div class="pb-4">{!! $info->descripcion !!}</div>
     </div>
     <div class="col-md-12 text-muted text-center">
         <div class="p-1 font-weight-bold">Ubicación de los Cajeros Automáticos en la red del BPA</div>
     </div>
     <div class="col-md-12">
         <div class="p-3 bg-light">
        <form id="form" role="form" class="form-inline mb-0 justify-content-center" method="get" action="{{route('home.atms')}}">
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
                    <div class="col-md-2">
                         <button type="submit" class="btn btn-success ">Buscar</button>
                    </div>
             </form>
         </div>
     </div>
     <div class="col-md-12 pt-2">
        <div class="row">
         @foreach($atms as $atm)
             @if($loop->index > 0)
                 @if($atms[$loop->index-1]->provincia->id != $atm->provincia->id)
                <div class="col-md-12 pr-4 pl-4 text-center text-muted">
                    <h3>{{$atm->provincia->provincia}}</h3>
                    <div class="divider"></div>
                </div>
                @endif
                 @if($atms[$loop->index-1]->municipio->id != $atm->municipio->id)
                 <div class="col-md-12 pl-2 pr-2 mb-2">
                     <div class="p-2 pl-5 h-100 bg-dark text-light rounded-pill">
                         <h5>{{$atm->municipio->municipio}}</h5>
                     </div>
                 </div>
                 @endif
            @else
                <div class="col-md-12 pr-4 pl-4 text-muted text-center">
                    <h3>{{$atm->provincia->provincia}} </h3>
                    <div class="divider"></div>
                </div>
                <div class="col-md-12 pl-2 pr-2 mb-2">
                    <div class="p-2 pl-5 h-100 bg-dark text-light rounded-pill">
                        <h5>{{$atm->municipio->municipio}}</h5>
                    </div>
                </div>
            @endif
             <div class="col-md-4 pb-2">
                <div class="card h-100">
                <div class="card-header">
                    <div class="card-text">{{$atm->titulo}}</div>
                </div>
                <div class="card-body">
                    <div class="card-text pb-1 text-muted"><small><strong>Código Sucursal:</strong> {{$atm->codigo}}</small></div>
                    <div class="card-text pb-1 text-muted"><small><strong>Dirección:</strong> {{$atm->direccion}}</small></div>
                    <div class="card-text text-muted pb-1"><small><strong>Referencia:</strong> {{$atm->referencia}}</small></div>
                </div>
            </div>
             </div>
        @endforeach
        </div>
     <div class="pagination-layer">{{ $atms->links() }}</div>
     </div>
 </div>
@endsection
<style>

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