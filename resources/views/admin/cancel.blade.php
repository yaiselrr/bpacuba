<div class="modal fade" id="modal-cancel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cancelar acción</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea cancelar esta acción? Todos los datos que no se hayan guardado se perderán.</p>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <a href="{{$route}}" class="btn btn-primary">Aceptar</a>
                    <button type="button" class="btn btn-default ml-1" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
