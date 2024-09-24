<div class="modal fade" id="modal-val">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('home.service.store')}}" method="post">
                @csrf
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title p-1 text-muted text-uppercase">Deje su evaluación</div>
                                <div class="card-text text-muted">
                                    {!! $service->valoracion !!}</div>
                                <div class="d-flex justify-content-center">
                                    @for($i = 0;$i< 5; $i++)
                                        <div id="star{{$i}}" class="p-2 stars"><i class="fa fa-star fa-2x"></i></div>
                                    @endfor
                                    <input type="hidden" id="valoracion" name="valoracion" value="{{ old('valoracion') }}" />
                                    <input type="hidden" id="tipo" name="tipo" value="{{ $service->tipo }}" />
                                </div>
                                @error('valoracion')
                                <span class="error-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button disabled type="submit" id="valorar" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-default ml-1" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<style>
    .star-active i{
        color: orange;
    }
</style>