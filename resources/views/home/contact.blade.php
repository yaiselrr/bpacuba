    @extends('layouts.bpa')
@section('contacts')
active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active text-capitalize" aria-current="page">{{__("bpa.contactos")}}</li>
@endsection
@section('title')
    {{__("bpa.contactos")}}
@endsection
@section('page')
 <div class="row contacts-info">
     <div class="col-md-12">
         @isset($central)
         <div class="pb-4">{!! $central->descripcion !!}</div>
         @endisset
     </div>
     <div class="col-md-3">
         <div class="owl-carousel owl-theme">
             @if(count($info)>0)
             <div class="item">
             @foreach($info as $c)
                    @if($loop->index>0 && $loop->index%3 == 0)
                        </div>
                         <div class="item">
                    @endif
                        <div class="row pb-2">
                         <div class="col-md-12 pb-3 text-muted text-uppercase bpa-subtitle">{{$c->provincia->provincia}}</div>
                         <div class="col-md-12">
                             <div><i class="fa fa-phone pr-2"></i>{{$c->telefono}}</div>
                         </div>
                         <div class="col-md-12">
                             <div><i class="fa fa-envelope pr-2"></i>{{$c->email}}</div>
                         </div>
                     </div>
                     <div class="divider"></div>
             @endforeach
                 </div>
             @endif
         </div>
     </div>
     <div class="col-md-4">
         @isset($central)
        <div class="row">
            <div class="col-md-12 pb-3 text-muted text-uppercase bpa-subtitle">{{$central->titulo}}</div>
            <div class="col-md-12 pb-3">
                <div><i class="fa fa-home pr-2"></i>{{$central->direccion}}</div>
            </div>
            <div class="col-md-12 pb-3">
                <div><i class="fa fa-phone pr-2"></i>{{$central->telefono}}</div>
            </div>
            <div class="col-md-12 pb-3">
                <div><i class="fa fa-envelope pr-2"></i>{{$central->email}}</div>
            </div>
        </div>
         @endisset
     </div>
     <div class="col-md-4">
             <div class="pb-3 text-muted text-uppercase bpa-subtitle">Contáctenos</div>
             <div class="box box-primary">
                 <form id="form" role="form" method="post"  action="{{route('home.contact.store')}}">
                     @csrf
                     <div class="box-body">
                         <div class="form-group @error('nombre') has-error @enderror">
                             <input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre" placeholder="Nombre">
                             @error('nombre')
                             <span class="error-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                         </div>
                         <div class="form-group @error('email') has-error @enderror">
                             <input type="text" class="form-control" value="{{ old('email') }}" name="email" placeholder="Correo">
                             @error('email')
                             <span class="error-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                         </div>
                         <div class="form-group @error('mensaje') has-error @enderror">
                             <textarea name="mensaje" class="form-control @error('mensaje') is-invalid @enderror" placeholder="Mensaje">{{ old('mensaje') }}</textarea>
                             @error('mensaje')
                             <span class="error-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                         </div>
                     </div>
                     <!-- /.box-body -->
                     <div class="box-footer ">
                         <div class="text-center">
                             <button type="submit" class="btn btn-success">Enviar</button>
                         </div>
                     </div>
                 </form>
             </div>
     </div>
     <div class="col-md-12">
         <div class="row">
             <div class="col-md-8 offset-md-3">
                 <img  class="responsive-image" src="{{asset('files/googlemap.png')}}"/>
             </div>
         </div>
     </div>
 </div>
@endsection
<style>
    .contacts-info i{
        color: grey;
        font-size: 18px;
    }
</style>
@section('morejs')
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 1,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 1,
                        nav: false,
                        loop: false,
                        margin: 20
                    }
                }
            });
        });
    </script>
@endsection
