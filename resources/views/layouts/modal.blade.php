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
    </div>
</div>

{{-- Modal de confirmación para eliminar / TO DO --}}
<div class="modal fade" id="modal-confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta prioridad?</p>
                <p class="text-danger" id="priorityToDeleteName">Prioridad: <strong id="priorityName"></strong></p>
                <form id="priority-delete" action="{{ route('config.priority.destroy', 'data-id') }}" method="post" style="display: none;">
                    @csrf
                    @method('delete')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal tecnicos -->
<div class="modal fade" id="ItSupports" tabindex="-1" aria-labelledby="Label" aria-hidden="true" 
            data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Listado de Tecnicos de Soporte</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                
            </div>

            <div id="spinner-ItSupport" class="text-center pb-3">
                <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <h4 class="text-primary">Cargando...</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ItSupport">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Listado de Tecnicos de Soporte</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                
            </div>

            {{-- <div id="spinner-ItSupport" class="text-center pb-3">
                <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <h4 class="text-primary">Cargando...</h4>
            </div> --}}
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
