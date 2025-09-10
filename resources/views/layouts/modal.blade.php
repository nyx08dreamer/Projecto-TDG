<div class="modal fade" id="modal-userImage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Foto de Perfil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
            @csrf
                <div class="modal-body">
                    <p class="card-text">Los archivos a subir deben estar en formato PNG, JPEG, JPG...</p>
                    <input type="file" id="archivos" name="archivos" class="basic-filepond">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Subir Imagen</button>
                </div>
            </form>
            
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->