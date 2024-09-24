@extends('layouts.bpa')
{{--@section('general-info')--}}
{{--    active--}}
{{--@endsection--}}
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Preguntas Frecuentes</li>
@endsection
@section('title')
    Preguntas Frecuentes
@endsection
@section('page')
 <div class="row">
     <div class="col-md-12">
         @foreach($questions as $q)
             <div class="card mb-1">
                 <div class="card-header @if($loop->index==0)question_header @endif p-0" id="headingOne">
                     <h2 class="mb-0">
                         <button class="btn btn-block" type="button" data-toggle="collapse" data-target="#question{{$q->id}}" aria-expanded="true" aria-controls="collapseOne">
                            {{$q->pregunta}}
                         </button>
                     </h2>
                 </div>
                 <div id="question{{$q->id}}" class="questions collapse @if($loop->index==0)show @endif" aria-labelledby="headingOne">
                     <div class="card-body">
                         {!! $q->respuesta !!}
                    </div>
                </div>
             </div>
         @endforeach
     </div>
     <div class="pagination-layer">{{ $questions->links() }}</div>
 </div>
@endsection
<style>
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
</style>
@section('morejs')
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