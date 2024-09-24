@extends('layouts.bpa')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item"><a href="{{route('home.news')}}">Noticias</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$news->titulo}}</li>
@endsection
@section('title')
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         <div class="col-md-4 pull-left">
             <div class="card-image-details rounded" style="background-image:url('{{asset('storage/'.$news->imagen)}}')"></div>
         </div>
         <div class="col-md-8 pull-left">
             <h3>{{$news->titulo}}</h3>
             <div class="d-flex justify-content-sm-start mb-1 share-links">
                 <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(Request::url())}}" class="rounded-circle pl-2 pr-2 pt-1 pb-1  mr-1"><i class="fa fa-facebook"></i></a>
                 <a href="http://twitter.com/share?text={{$news->titulo}}&url={{urlencode(Request::url())}}" class="rounded-circle pl-2 pr-2 pt-1 pb-1 mr-1"><i class="fa fa-twitter"></i></a>
                 <a href="https://www.linkedin.com/shareArticle?mini=true&url={{urlencode(Request::url())}}&title={{$news->titulo}}" class="rounded-circle pl-2 pr-2 pt-1 pb-1"><i class="fa fa-linkedin"></i></a>
             </div>
             <div class="divider"></div>
         </div>
         <div class="col-md">
             {!! $news->descripcion !!}
         </div>
     </div>
 </div>
@endsection
<style>
    .card-image-details{
        height: 280px;
        background-position: center center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: 100% 100%;
    }
</style>