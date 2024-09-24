@extends('layouts.bpa')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Búsqueda</li>
@endsection
@section('title')
    Resultados de búsqueda
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         @if(count($news)==0 && count($apps)==0 && count($downloads)==0 && count($questions)==0)
         <div class="row justify-content-center">
             <div class="text-muted">No se encontraron resultados a la búsqueda : <strong>{{$search}}</strong></div>
         </div>
         @else
         @if(count($apps)>0)
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
         @endif
         @if(count($downloads)>0)
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
         @endif
         @if(count($news)>0)
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
         @endif
         @if(count($questions)>0)
         <div class="col-md-12">
             @foreach($questions as $q)
                 <div class="card mb-1">
                     <div class="card-header question_header p-0" id="headingOne">
                         <h2 class="mb-0">
                             <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#question{{$q->id}}" aria-expanded="true" aria-controls="collapseOne">
                                 {{$q->pregunta}}
                             </button>
                         </h2>
                     </div>
                     <div id="question{{$q->id}}" class="questions collapse show" aria-labelledby="headingOne">
                         <div class="card-body">
                             {!! $q->respuesta !!}
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
         @endif
         @endif
     </div>
 </div>
@endsection
<style>
.download-link{
    border-left: 1px solid darkgrey;
}
.question_header{
    background-color: rgba(12, 97, 86, 0.749019607843137)!important;
    color: white;
}
.question_header .btn{
    color: white;
}
.question_header .btn:hover{
    color: white;
}
@media screen and (max-width: 576px) {
    .download-link{
        border-left: 0px;
        border-top: 1px solid darkgrey;
    }

}
</style>
@section('morejs')
    @parent
    <script>
        $(document).ready(function () {
            $('.questions').on('show.bs.collapse', function () {
                $(this).parent('div').children(':first-child').addClass('question_header')
            });
            $('.questions').on('hide.bs.collapse', function () {
                $(this).parent('div').children(':first-child').removeClass('question_header')
            });
        });

    </script>
@endsection