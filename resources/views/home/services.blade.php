@extends('layouts.bpa')
@section('products-services')
active
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('bpa.'.$service->tipo)}}</li>
@endsection
@section('title')
    {{__('bpa.'.$service->tipo)}}
@endsection
@section('page')
    @if($modal)
    @include('layouts.valoration', ['route'=>$service])
    @endif
    <div class="row">
     @if($service->imagen)
     <div class="col-md-5 mr-md-3">
         <img class="responsive-image" src="{{asset('storage/'.$service->imagen)}}">
     </div>
     @endif
     <div class="col-md">
         <div class="row">
         <div class="col-md">
         @foreach($service->paginas as $f)
           @if(count($service->paginas)>4 && $loop->index>0 && $loop->index%(ceil(count($service->paginas)/2))==0)
            </div>
             <div class="col-md">
           @endif
           <div class="file-container">
               <a class="file-links text-muted text-decoration-none" href="{{route('home.pages', ['service'=>$service->tipo,'slug'=>$f->slug])}}">
                    {{$f->titulo}}
               </a>
           </div>
         @endforeach
         </div>
         </div>
     </div>

     <div class="col-md-12 pt-4">
         <div class="pb-4">{!! $service->descripcion !!}</div>
     </div>
 </div>
@endsection
<style>
    .file-container{
        padding-bottom:12px
    }
    .file-links{
        text-decoration: none;
        border-bottom: 1px solid #5451513b;
        padding-right: 23px;
        padding-bottom: 2px;
        font-size: 18px;
    }
</style>
@section('morejs')
    <script>
        $(document).ready(function() {
            $('#modal-val').modal('show');
        });
    </script>
    <script>
        $(document).ready(function () {
            var v = $("#valoracion");
            if (v.val()) {
                for (let i = 0; i < 5; i++) {
                    $("#star" + i).removeClass('star-active');
                    if (i <= v.val()-1) {
                        $("#star" + i).addClass('star-active');
                    }
                }
            }
            $('.stars').each(function (index) {
                console.log('Entrando');
                $(this).on('click', function () {
                    $("#valoracion").val(index+1);
                    $("#valorar").attr('disabled',false)
                    for(let i=0;i<5;i++){
                        $("#star"+i).removeClass('star-active');
                        if(i<=index){
                            $("#star"+i).addClass('star-active');
                        }
                    }
                })
            })
        })
    </script>
@endsection