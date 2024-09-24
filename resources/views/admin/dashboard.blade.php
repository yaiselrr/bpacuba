@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($stadistics as $s)
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{__('bpa.'.$s['type'])}}</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-center">
                                                <strong>Valoración promedio hasta el {{\Carbon\Carbon::now()->format('d/m/Y')}}</strong>
                                            </p>
                                            <div class="stars-container">
                                                <!-- Sales Chart Canvas -->
                                                @for($i=0;$i<5;$i++)
                                                    @if($i<$s['total'])
                                                    <div><i class="fa fa-star stars sactive" ></i></div>
                                                    @else
                                                    <div><i class="fa fa-star stars" ></i></div>
                                                    @endif
                                                @endfor
                                            </div>
                                            <!-- /.chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <p class="text-center">
                                                <strong>Porcentaje por valoracion</strong>
                                            </p>

                                            <div class="progress-group">
                                                <span class="progress-text">
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i></span>
                                                <span class="progress-number">{{$s['stars'][4]}}<small>%</small></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-yellow" style="width: {{$s['stars'][4]}}%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text"><i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star" ></i></span>
                                                <span class="progress-number">{{$s['stars'][3]}}<small>%</small></span>
                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-yellow" style="width: {{$s['stars'][3]}}%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star" ></i>
                                                    <i class="fa fa-star" ></i>
                                                </span>
                                                <span class="progress-number">{{$s['stars'][2]}}<small>%</small></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-yellow" style="width: {{$s['stars'][2]}}%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star" ></i>
                                                    <i class="fa fa-star" ></i>
                                                    <i class="fa fa-star" ></i>
                                                </span>
                                                <span class="progress-number">{{$s['stars'][1]}}<small>%</small></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-yellow" style="width: {{$s['stars'][1]}}%"></div>
                                                </div>
                                            </div>
                                            <div class="progress-group">
                                                <span class="progress-text">
                                                    <i class="fa fa-star sactive" ></i>
                                                    <i class="fa fa-star" ></i>
                                                    <i class="fa fa-star" ></i>
                                                    <i class="fa fa-star" ></i>
                                                    <i class="fa fa-star" ></i>
                                                </span>
                                                <span class="progress-number">{{$s['stars'][0]}}<small>%</small></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-yellow" style="width: {{$s['stars'][0]}}%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- ./box-body -->
                                <div class="box-footer">
                                    <!-- /.row -->
                                </div>
                                <!-- /.box-footer -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @if($loop->index == 0)
            <div class="row">
            <div class="col-md-10 col-sm-8 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-calendar" style="padding-top: 25px"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ultima actualización</span>
                        <span class="info-box-number">
                            @if($site->actualizacion)
                            {{\Carbon\Carbon::parse($site->actualizacion)->format('d/m/Y')}}
                            @else
                            -
                            @endif
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            </div>
            <div class="row">
            <!-- /.col -->
            <div class="col-md-10 col-sm-8 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-eye" style="padding-top: 25px"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Visitas</span>
                        <span class="info-box-number">{{$site->visitas}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
<style>
    .stars{
        font-size:8rem!important;
        color: rgba(99, 99, 99, 0.3);
    }
    .sactive{
        color: #f39c12;
    }
    .stars-container{
        display: flex;
        justify-content: space-around;
    }
    @media screen and (max-width: 746px) {
        .stars{
            font-size:3rem!important;
        }
    }
</style>