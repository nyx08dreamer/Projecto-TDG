<div class="tab-pane" id="permissions">
    <div class="ml-1 mb-1">
        @php
            $userPermissionIds = [];

            if (isset($user)) {
                $directPermissions = $user->permissions->pluck('id')->toArray();

                $rolePermissions = $user->roles->flatMap(function($role) {
                    return $role->permissions->pluck('id');
                })->unique()->toArray();

                $userPermissionIds = array_unique(array_merge($directPermissions, $rolePermissions));
            }
        @endphp

        @foreach ($permissions as $permission)
            <div class="row">
                <div class="form-check col-12">
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        name="permission[]" 
                        id="permission_{{ $permission->id }}" 
                        value="{{ $permission->id }}"
                        {{ in_array($permission->id, old('permission', $userPermissionIds)) ? 'checked' : '' }}
                        @disabled(true)
                    >
                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                        {{ $permission->description }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>