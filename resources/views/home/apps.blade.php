@extends('layouts.bpa')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Aplicaciones móviles</li>
@endsection
@section('title')
    Aplicaciones móviles
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div class="row p-3">
         @foreach($apps as $n)
         <div class="card mb-3 w-100" style="min-height: 220px">
             <div class="row no-gutters h-100">
                 <div class="col-md-3">
                     <div class="card-news-image" style="background-image:url('{{asset('storage/'.$n->imagen)}}')"></div>
                 </div>
                 <div class="col-md-8">
                     <div class="card-body">
                         <h5 class="card-title">{{$n->titulo}}</h5>
                         <div class="divider"> </div>
                         <p class="card-text">{!! Str::limit(strip_tags($n->descripcion), 400, ' ...') !!}</p>
                     </div>
                 </div>
                 <div class="col-md-1">
                     <div class="d-flex justify-content-center align-items-center h-100">
                         <a href="{{route('home.download',["file"=>"apps","id"=>$n->id])}}" class="p-3 download-link"><i class="fa fa-download fa-2x"></i></a>
                     </div>
                 </div>
             </div>
         </div>
         @endforeach
         </div>
         <div class="pagination-layer">{{ $apps->links() }}</div>
     </div>
 </div>
@endsection
<style>
.download-link{
    border-left: 1px solid darkgrey;
}
@media screen and (max-width: 576px) {
    .download-link{
        border-left: 0px;
        border-top: 1px solid darkgrey;
    }

}
</style>