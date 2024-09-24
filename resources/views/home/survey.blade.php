@extends('layouts.bpa')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Encuesta</li>
@endsection
@section('title')
    Encuestas
@endsection
@section('page')
    <form action="{{route('home.survey.store')}}" method="post">
    @csrf
    <div class="row justify-content-center">
     <div class="col-md-12">
         <div class="text-muted text-center">
             Por favor, dedique unos minutos rellenar esta encuesta. Gracias por su atención.
         </div>
     </div>
     <div class="col-md-10 p-2 text-center">
         <div class="card">
             <div class="card-body">
                 <div class="card-text text-muted">Por favor, responda las siguientes preguntas sobre del sitio web:</div>
                 <div class="row text-left pt-2">
                     @foreach($preg as $p)
                         <div class="col-md-8 text-muted">{{$p->pregunta}}</div>
                         <div class="col-md-1" ><input type="radio" value="si" name="respuesta{{$p->id}}" @if(old('respuesta'.$p->id)=="si") checked @endif/> Si</div>
                         <div class="col-md-1" ><input type="radio" value="no" name="respuesta{{$p->id}}" @if(old('respuesta'.$p->id)=="no") checked @endif/> No</div>
                         <div class="col-md-2" ><input type="radio" value="mejorar" name="respuesta{{$p->id}}" @if(old('respuesta'.$p->id)=="mejorar") checked @endif/> Debe mejorar</div>
                     @endforeach
                 </div>
                 @error('respuesta*')
                 <span class="error-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                 @enderror
                 <div class="row justify-content-start p-3">
                      <textarea class="col-md-12" name="sugerencias" placeholder="Sugerencias">{{old('sugerencias')}}</textarea>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-md-12 text-center">
         <button type="submit" class="btn btn-success">Guardar</button>
     </div>
    </div>
    </form>
@endsection

@section('morejs')
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