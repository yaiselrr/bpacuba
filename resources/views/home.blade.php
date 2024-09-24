@extends('layouts.site')
@section('body')
    <div class="container-fluid pa-0 bg-white">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($carrousel as $c)
            <div class="carousel-item @if($loop->first)active @endif">
                @if($c->url)
                <a href="{{$c->url}}">
                <img src="{{asset('storage/'.$c->imagen)}}"  class="d-block w-100" style="max-height:500px;" alt="{{$c->titulo}}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$c->titulo}}</h5>
                </div>
                </a>
                @else
                <div>
                <img src="{{asset('storage/'.$c->imagen)}}"  class="d-block w-100" style="max-height:500px;" alt="{{$c->titulo}}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$c->titulo}}</h5>
                </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
        <div class="container-fluid mt-2 pt-5 bg-taxes">
            <div class="row">
                <div class="col-md-6 mb-3 text-center">
                    <div class="text-center mb-2"><h5 class="text-muted text-uppercase">{{__('bpa.tasa_interes')}}</h5></div>
                    <div class="text-muted">{!! $tasaInteres->home_text !!}</div>
                    <div class="text-center mt-3"><a class="btn btn-success text-uppercase" href="{{route('home.info','tasa_interes')}}">acceder</a></div>
                </div>

                <div class="col-md-6 mb-3 text-center">
                    <div class="text-center mb-2"><h5 class="text-muted text-uppercase">{{__('bpa.taxes')}}</h5></div>
                    <div class="row">
                        <div class="col-11 col-md-11 p-0 m-0">
                            <div class="card-taxes" style="background-image:url('{{asset('storage/'.$tasaCambio->imagen)}}')"></div>
                        </div>
                        <div class="col-1 col-md-1 m-0 p-0">
                            <div class="d-flex align-items-sm-start flex-column mb-1 share-links xl-shares">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(asset('storage/'.$tasaCambio->imagen))}}" class="rounded-circle pl-2 pr-2 pt-1 pb-1  mb-1"><i class="fa fa-facebook"></i></a>
                                <a href="http://twitter.com/share?text=tasasdecambio&url={{urlencode(asset('storage/'.$tasaCambio->imagen))}}" style="padding-left:6px;padding-right:6px;" class="rounded-circle  pt-1 pb-1 mb-1"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{urlencode(asset('storage/'.$tasaCambio->imagen))}}&title=tasascambio" style="padding-left:6px;padding-right:6px;" class="rounded-circle pt-1 pb-1"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-2 pt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="text-center pb-3"><h3 class="text-muted text-uppercase">{{__('bpa.productos-servicios')}}</h3></div>
                    <div class="text-muted">{!! $productos->home_text !!}</div>
                </div>
            </div>
        </div>
        <div class="container mt-1 pt-4 p-sm-2 p-md-5">
            <div class="card-deck">
                <a  href="{{route('home.service','banca-personal')}}" class="card">
                    <div class="service banca-personal">
                    </div>
                </a>
                <a  href="{{route('home.service','banca-electronica')}}" class="card">
                    <div class="service banca-electronica">
                    </div>
                </a>
                <a  href="{{route('home.service','banca-corporativa')}}" class="card">
                    <div class="service banca-corporativa">
                    </div>
                </a>
                <a  href="{{route('home.service','tcp-cna')}}" class="card">
                    <div class="service tcp-cna">
                    </div>
                </a>
            </div>
        </div>
        <div class="container-fluid mt-1" style="position: relative;" >
            <div class="row">
                <div class="out-border">
                    <div class="inner-border"></div>
                </div>
                <div class="col-md-6 atm-image rounded-md-left" style="background-image:url('{{asset('files/cajeros.png/')}}')"></div>
                <div class="col-md-6 atm-text rounded-md-right left-border-out-container">
                    <div class="left-border-inner-container">
                    <h1 style="padding-left:35px; padding-right:35px;" class="d-none d-md-block text-white text-center text-uppercase visible-md">cajeros automáticos al alcance de todos</h1>
                    <h4 class="text-white text-center text-uppercase d-md-none">cajeros automáticos al alcance de todos</h4>
                    <p class="text-white text-center text-uppercase" style="color:#5aaea1!important;">conozca la ubicación de los cajeros de forma rápida y sencilla</p>
                    <div class="divider-bold" style="border-color: white!important;"></div>
                    <p class="text-white text-center text-uppercase" style="color:#5aaea1!important;"><small>bancos populares de ahorro</small></p>

                    <div class="text-center mt-3"><a class="btn btn-success text-uppercase" href="{{route('home.atms')}}">consultar</a></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container mt-3 pl-md-5 pr-md-5 pl-sm-1 pr-sm-1 pb-3" style="margin-top: 3rem!important;">

            <div><h3 class="pb-3 text-uppercase text-muted text-center">últimas noticias</h3></div>
            <div class="card-deck">
                @foreach($news as $n)
                    <a href="{{route('home.news.details',$n->id)}}" class="card" style="max-width:450px;">
                        <div class="card-image" style="background-image:url('{{asset('storage/'.$n->imagen)}}')"></div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                            <p class="card-text"><small class="text-muted text-uppercase">Por: {{Str::limit($n->fuente, 15, ' ...')}}</small></p>
                            <p><small class="text-muted pl-1 text-uppercase">{{\Carbon\Carbon::parse($n->fecha_publicacion)->format('d/m/Y')}}</small></p>
                            </div>
                            <div class="divider"></div>
                            <strong class="card-title text-muted">{{Str::limit($n->titulo, 50, ' ...')}}</strong>
                            <p class="card-text text-muted">{!! Str::limit(strip_tags($n->descripcion), 200, ' ...') !!}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-center mt-3"><a class="btn btn-success text-uppercase" href="{{route('home.news')}}">más noticias</a></div>
        </div>
        <div class="container-fluid mt-1 pt-4 p-5"
             style="background-image:url('{{asset('files/banner-apps.jpg/')}}');
                     background-size: 100% 100%;">
            <div>
                <h2 class="pb-1 text-uppercase text-white text-center">descargue nuestras aplicaciones</h2>
                <h5 class="pb-3 text-white text-center">trabajamos pensando en usted</h5>
            </div>
            <div class="row justify-content-center">
                @foreach($apps as $app)
                    <div class="pr-2 pb-2">
                        <a  href="{{route('home.download',["file"=>"apps","id"=>$app->id])}}" class="btn text-uppercase app-btn">
                            <div><i class="fa fa-download"></i> {{Str::limit($app->titulo, 15, ' ...')}}</div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-3"><a class="btn btn-success text-uppercase" href="{{route('home.apps')}}">más aplicaciones</a></div>
        </div>
        <div class="container-fluid mt-3 pb-3">
            <div class="row justify-content-center">
            @foreach($enlaces as $link)
                <div class="col-md-2 pb-1">
                    <a  href="{{$link->url}}" class="">
                        <div class="link-image" style="background-image:url('{{asset('storage/'.$link->logo)}}')" >
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
<style>
.service{
    height: 100%; /* You must set a specified height */
    min-height: 180px;
    width: 100%;
    background-position: center center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: 100% 100%;
}
.banca-corporativa{
    background-image:url('{{asset('files/banca-corporativa-2.jpg')}}')
}
.banca-electronica{
    background-image:url('{{asset('files/banca-electronica-2.jpg/')}}')
}
.banca-personal{
    background-image:url('{{asset('files/banca-personal-2.jpg/')}}')
}

.tcp-cna{
    background-image:url('{{asset('files/tcp-cna-2.jpg/')}}')
}
.app-btn{
    color: white!important;
    border-color: white!important;
    min-width: 200px;
    transition: all .5s ease-in-out;
}
.app-btn:hover{
    /*background-color: #327B74!important;*/
    /*border-color: #1f6058!important;*/
    box-shadow: 0px 1px 10px black;
}
.card-taxes{
    height: 215px;
    background-position: top center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: contain;
}
.bg-taxes{
    background: #5a5a5a14;
}

</style>