@extends('layouts.site')
@section('body')
    @include('home.session')
<div class="container-fluid bg-white p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @yield('breadcrumb')
        </ol>
    </nav>
    <div class="text-center text-uppercase text-muted"><h3 class="bpa-title">@yield('title')</h3></div>
    <div class="p-2">
        @yield('page')
    </div>
</div>
@endsection