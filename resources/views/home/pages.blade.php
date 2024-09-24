@extends('layouts.bpa')
@section('products-services')
active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('home.service',$service->tipo)}}">{{__('bpa.'.$service->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__($page->titulo)}}</li>
@endsection
@section('title')
    {{__($page->titulo)}}
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div>{!! $page->descripcion !!}</div>
     </div>
     <div class="col-md-12">
        <div class="row justify-content-start text-left">
             @foreach($page->ficheros as $img)
             <div class="p-2"><a class="btn btn-success text-capitalize" href="{{asset('storage/'.$img->fichero)}}" target="_blank">{{$img->nombre}}<i class="fa fa-download"></i></a></div>
            @endforeach
        </div>
     </div>
 </div>
@endsection
<style>
    .responsive-image{
        width: inherit;
        max-width: max-content;
    }
</style>