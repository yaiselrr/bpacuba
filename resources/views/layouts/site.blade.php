@extends('layouts.app')
@section('content')
@include('home.sidebar')
<div class="d-flex social-container">
    @foreach($socialnetworks as $net)
        <a  href="{{$net->url}}" target="_blank" class="{{$net->red->clase}}"><i class="fa fa-{{$net->red->clase}}"></i></a>
    @endforeach
</div>
<main style="padding-top: 66px;">
    @yield('body')
</main>
@include('home.footer')
@endsection