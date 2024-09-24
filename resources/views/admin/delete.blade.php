<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar elemento</h4>
            </div>
            <form name="form_delete" id="form_delete" action="" method="post">
                @csrf
                @method('DELETE')
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar este elemento?</p>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-danger">Aceptar</button>
                    <button type="button" class="btn btn-default ml-1" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
