
<div class="tab-pane" id="role">
    <div class="ml-1">
        <form id="user-update" method="post" action="{{ route('admin.user.role', $user->id)}}">
            @csrf
            @method('PATCH')
            @php
                // IDs de permisos asignados al rol
                $userRoleIds = isset($user) ? $user->roles->pluck('id')->toArray() : [];
            @endphp

            @foreach ($roles as $role)
                <div class="row">
                    <div class="form-check col-12">
                            <input type="checkbox" 
                            class="form-check-input" 
                            name="role[]" 
                            id="role_{{ $role->id }}" 
                            value="{{ $role->id }}"
                            {{ in_array($role->id, old('role', $userRoleIds)) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="role_{{ $role->id }}">{{$role->description}}</label>
                    </div>
                </div>
            @endforeach
            <div class="float-right">
                <button type="submit" class="ml-2 btn btn-success">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>