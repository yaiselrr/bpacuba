@extends('layouts.bpa')
@section('about-us')
active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Sobre nosotros</li>
@endsection
@section('title')
    sobre nosotros
@endsection
@section('page')
 <div class="row">
     <div class="col-md-6">
         <div class="text-muted text-uppercase text-center bpa-subtitle"><h5>misión</h5></div>
         <div class="pb-4">{!! $about->mision !!}</div>
     </div>
     <div class="col-md-6">
         <div class="text-muted text-uppercase text-center bpa-subtitle"><h5>visión</h5></div>
         <div class="pb-4">{!! $about->vision !!}</div>
     </div>
     <div class="col-md-12 pt-2">
         <div class="text-muted text-uppercase text-cente bpa-subtitle"><h5>objetivos</h5></div>
         <div class="pb-4">{!! $about->objetivos !!}</div>
     </div>
     <div class="col-md-12 pt-2">
         <div class="text-muted text-uppercase text-center pb-4 bpa-subtitle"><h5>consejo de dirección</h5></div>
         <div class="card-deck">
             @foreach($staff as $s)
             <div class="staff-container col-md-2 m-0 p-1 pb-4">

             <div class="card rounded-circle m-0 p-0">
             <div class="staff-imagen rounded-circle" style="background-image: url('{{asset('storage/'.$s->foto)}}')">
                 <div class="staff-layer rounded-circle text-center">
                     <div>{{$s->nombre}} {{$s->apellido}}</div>
                     <div>{{$s->email}}</div>
                     <div style="padding-left:57px; padding-right:57px;"><div class="divider"></div></div>
                     <div>{{$s->telefono}}</div>
                 </div>
             </div>
             </div>
                 <div class="text-center pt-2 text-uppercase text-muted">
                     @if($s->cargo){{$s->cargo->cargo}}@else &nbsp @endif
                 </div>
             </div>
             @endforeach
         </div>
     </div>
 </div>
@endsection
<style>
    .staff-imagen{
         height: 180px;
        background-position: center center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: 100% 100%;
    }
    .staff-layer{
        position: absolute;
        background-color: rgba(0,0,0,0.6);
        height: 100%;
        width: 100%;
        opacity: 0;
        color: white;
        padding-top: 45px;
        z-index: 2;
        transition: all 1s ease;
    }
    .staff-container{
        display: flex;
        flex: 1 0 0%;
        flex-direction: column;
        margin-right: 15px;
        margin-bottom: 0;
        margin-left: 15px;
        position: relative;
        min-width: 0;
        word-wrap: break-word;
    }
    .staff-layer:hover{
        opacity: 1;
    }
</style>