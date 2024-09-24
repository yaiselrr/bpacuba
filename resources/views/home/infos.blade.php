@extends('layouts.bpa')
@section('general-info')
active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('bpa.'.$info->tipo)}}</li>
@endsection
@section('title')
    {{__('bpa.'.$info->tipo)}}
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div>{!! $info->descripcion !!}</div>
     </div>
     <div class="col-md-12">
    @if($info->tipo != 'tarifas-terminos')
       <div class="row justify-content-center">
           @foreach($info->imagenes as $img)
               <div class="col-md-6 pb-4">
                   <img class="responsive-image" src="{{asset('storage/'.$img->imagen)}}"/>
               </div>
           @endforeach
       </div>
        @else
        <div class="row justify-content-start text-left">
             @foreach($info->imagenes as $img)
             <div class="p-2"><a class="btn btn-success text-capitalize" href="{{asset('storage/'.$img->imagen)}}" target="_blank">{{$img->nombre}}
                     <i class="fa fa-download"></i></a></div>
            @endforeach
        </div>
     @endif

     </div>
 </div>
@endsection
<style>
    .responsive-image{
        width: inherit;
        max-width: max-content;
    }
</style>