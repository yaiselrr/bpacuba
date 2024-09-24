@extends('layouts.bpa')
@section('downloads')
    active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Descargas</li>
@endsection
@section('title')
    Descargas
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div class="col-md-12">
             {!! $info->descripcion !!}
         </div>
         <div class="row p-3">
         @foreach($downloads as $n)
         <div class="card mb-3 w-100" style="min-height: 180px">
             <div class="row no-gutters h-100">
                 <div class="col-md-11">
                     <div class="card-body">
                         <h5 class="card-title">{{$n->titulo}}</h5>
                         <div class="divider"> </div>
                         <p class="card-text">{!! Str::limit(strip_tags($n->descripcion), 400, ' ...') !!}</p>
                     </div>
                 </div>
                 <div class="col-md-1">
                     <div class="d-flex justify-content-center align-items-center h-100">
                         <a href="{{route('home.download',["file"=>"downloads","id"=>$n->id])}}" class="p-3 download-link"><i class="fa fa-download fa-2x"></i></a>
                     </div>
                 </div>
             </div>
         </div>
         @endforeach
         </div>
         <div class="pagination-layer">{{ $downloads->links() }}</div>
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