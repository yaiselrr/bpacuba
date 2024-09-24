@extends('layouts.bpa')
@section('about-us')
active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Noticias</li>
@endsection
@section('title')
    Noticias
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div class="row p-3">
         @foreach($news as $n)
         <div class="card mb-3 w-100" style="min-height: 220px">
             <div class="row no-gutters h-100">
                 <div class="col-md-3">
                     <div class="card-news-image" style="background-image:url('{{asset('storage/'.$n->imagen)}}')"></div>
                 </div>
                 <div class="col-md-9">
                     <div class="card-body">
                         <h5 class="card-title">{{$n->titulo}}</h5>
                         <div class="divider"> </div>
                         <p class="card-text">{!! Str::limit(strip_tags($n->descripcion), 400, ' ...') !!}</p>

                         <div class="row pl-3">
                             <div class="col-md-6">
                                 <div class="row">
                                     <div class="card-text"><small class="text-muted text-uppercase">Por: {{$n->fuente}}</small></div>
                                     <div><small class="text-muted pl-1 text-uppercase">{{\Carbon\Carbon::parse($n->fecha_publicacion)->format('d/m/Y')}}</small></div>

                                 </div>
                             </div>

                             <div class="col-md-2 offset-md-4 offset-sm-0 pl-0">
                             <a href="{{route('home.news.details',$n->id)}}">Leer más...</a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         @endforeach
         </div>
         <div class="pagination-layer">{{ $news->links() }}</div>
     </div>
 </div>
@endsection
<style>

</style>