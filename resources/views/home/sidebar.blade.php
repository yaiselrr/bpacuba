<div class="bg-white" style="position: fixed; width: 100%;z-index: 1000;">
<nav class="navbar navbar-expand-lg navbar-green">

<a class="navbar-brand" href="{{route('home')}}"><img style="height: 40px;" src="{{asset('files/bpa.png')}}"/></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto text-uppercase">
        <li class="nav-item @yield('about-us')">
            <a class="nav-link" href="{{route('home.about')}}">{{__("bpa.about-us")}}<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown @yield('products-services')">
            <a class="nav-link dropdown-toggle" href="#" id="products-services" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{__('bpa.productos-servicios')}}
            </a>
            <div class="dropdown-menu" aria-labelledby="products-services">
                <a class="dropdown-item" href="{{route('home.service','tcp-cna')}}">{{__('bpa.tcp-cna')}}</a>
                <a class="dropdown-item" href="{{route('home.service', 'banca-electronica')}}">{{__('bpa.banca-electronica')}}</a>
                <a class="dropdown-item" href="{{route('home.service','banca-corporativa')}}">{{__('bpa.banca-corporativa')}}</a>
                <a class="dropdown-item" href="{{route('home.service','banca-personal')}}">{{__('bpa.banca-personal')}}</a>
            </div>
        </li>
        <li class="nav-item dropdown @yield('general-info')">
            <a class="nav-link dropdown-toggle" href="#" id="general-info" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{__('bpa.general-info')}}
            </a>
            <div class="dropdown-menu" aria-labelledby="general-info">
                <a class="dropdown-item" href="{{route('home.notes')}}">Notas Generales</a>
                <a class="dropdown-item" href="{{route('home.info','actividad-internacional')}}">Actividades Internacionales</a>
                <a class="dropdown-item" href="{{route('home.offices')}}">Red de Oficinas</a>
                <a class="dropdown-item" href="{{route('home.info','info-financiera')}}">Informacion Financiera</a>
                <a class="dropdown-item" href="{{route('home.info','tasa_interes')}}">Tasas de Interes</a>
                <a class="dropdown-item" href="{{route('home.info','tarifas-terminos'
                )}}">Tarifas de Terminos</a>
            </div>
        </li>
        <li class="nav-item @yield('downloads')">
            <a class="nav-link" href="{{route('home.downloads')}}">{{__("bpa.descargas")}}<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item @yield('contacts')">
            <a class="nav-link" href="{{route('home.contact')}}">{{__("bpa.contactos")}}<span class="sr-only">(current)</span></a>
        </li>
    </ul>
    <form class="search-form form-inline my-2 my-lg-0 ml-md-4" action="{{route('home.search')}}" method="get">
        @csrf
        <div class="input-group">
            <input type="text" value="@isset($search){{$search}}@endisset" name="search" id="search" class="form-control" placeholder="Buscar" aria-label="Buscar">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="search_button" disabled><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
</nav>
</div>
<style>
    .navbar-green{
        box-shadow: 0px 1px 10px #999;
        z-index: 10;
    }
    .navbar-green .navbar-nav .nav-item.active .nav-link{
        color: #327B74;
        border-bottom: 1px solid rgba(50,126,116,0.8);
    }
    .navbar-green .navbar-nav .nav-item .nav-link,
    .navbar-green .navbar-nav .nav-item .dropdown-menu .dropdown-item{
        color: rgba(50,126,116,0.8);
    }
    .navbar-green .navbar-toggler-icon {

        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(50,126,116,1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");

    }
    @media screen and (min-width: 900px) {
        .search-form input[type="text"]{
            max-width: 140px;
        }
    }
</style>
@section('morejs')
<script>
    $(document).ready(function () {
        $("#search").on('keyup',function () {
            console.log('tecleando...',$(this).val().length);
            if($(this).val().length >3 ){
                $("#search_button").attr('disabled',false);
            }
            else {
                $("#search_button").attr('disabled',true);
            }
        })
    })
</script>
@endsection