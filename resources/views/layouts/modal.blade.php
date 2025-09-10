<div class="modal fade" id="modal-userImage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Foto de Perfil</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('admin.user.image', auth()->user()->id) }}" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
                <div class="modal-body">
                    <p class="card-text">Los archivos a subir deben estar en formato PNG, JPEG, JPG...</p>
                    <input type="file" id="image" name="image">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Subir Imagen</button>
                </div>
            </form>
            
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->