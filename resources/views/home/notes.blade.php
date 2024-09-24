@extends('layouts.bpa')
@section('general-info')
    active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notas Generales</li>
@endsection
@section('title')
    Notas Generales
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div class="pb-4">{!! $notes->descripcion !!}</div>
     </div>
 </div>
@endsection
<style>
</style>