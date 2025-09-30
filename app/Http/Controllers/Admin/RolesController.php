<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entities\Admin\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Entities\Admin\User;


class RolesController extends Controller implements HasMiddleware
{
    
    const PERMISSIONS = [
        'create' => 'admin-role-create',
        'show' => 'admin-role-show',
        'edit' => 'admin-role-edit',
        'delete' => 'admin-role-delete',

    ];
    
    public static function middleware(): array
    {
        return [

            new Middleware('permission:'.self::PERMISSIONS['create'], only: ['create', 'store']),
            new Middleware('permission:'.self::PERMISSIONS['show'], only: [ 'index','show']),
            new Middleware('permission:'.self::PERMISSIONS['edit'], only: ['edit', 'update']),
            new Middleware('permission:'.self::PERMISSIONS['delete'], only: ['destroy']),
            
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.role.index');
    }

    public function RoleList (Request $request)
    {
        if ($request->ajax()) {

            $roles = Role::orderBy('id', 'asc');

            $datatables = DataTables::of($roles)
                ->addIndexColumn()
                ->editColumn('name', function($role) {
                
                $url = route('admin.role.show', $role->id);
                return '<a href="' . $url . '">' . e($role->name) . '</a>';
            })
            ->rawColumns(['name']) 
                ->make(true);
            return $datatables;
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create', [
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try {

            $role= new Role;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();

            $role->permissions()->sync($request->permission);
            
            $status = 'success';
            $content = 'El rol se ha creado correctamente';

        } catch (\Throwable $th) {
            
            $status = 'error';
            $content = 'Ha ocurrido un error al crear el rol';
        }


        return redirect()
                ->route('admin.role.show', ['role' => $role->id])
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);;
    }

    public function RolePermissionsAndUsersList (Role $role, Request $request)
    {
        if ($request->ajax()) {

            // Verificar qué datos se solicitan: permisos o usuarios
            $type = $request->get('type');

            if ($type === 'permissions') {
                $rolePermissions = $role->permissions()->get();
                return DataTables::of($rolePermissions)
                ->addIndexColumn()
                ->editColumn('name', function($permission) {
                    /** @var User|null $user */
                    $user = Auth::user();

                    // Ignorar "Error", el metodo funciona
                    if ($user->can('admin-permission-show')) {
                        $url = route('admin.permission.show', $permission->id);
                        return '<a href="' . $url . '">' . e($permission->name) . '</a>';
                    } else {
                        // Usuario no tiene permiso, solo mostrar el nombre sin enlace
                        return e($permission->name);
                    }
                })
                ->rawColumns(['name'])
                ->make(true);
            }

            if ($type === 'users') {

                $roleUsers = $role->users()->get()->map(function($user) {
                    $user->full_name = $user->first_name . ' ' . $user->last_name;
                    return $user;
                });

                return DataTables::of($roleUsers)
                    ->addIndexColumn()
                    ->editColumn('full_name', function($user) {
                        
                        $url = route('admin.user.show', $user->id);
                        return '<a href="' . $url . '">' . e($user->full_name) . '</a>';
                    })
                    ->rawColumns(['full_name']) 
                    ->make(true);
            }
        // Si no se especifica tipo o es inválido, puedes devolver un error o vacío
        return response()->json(['error' => 'Tipo de datos no especificado o inválido'], 400);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role, Request $request)
    {

        return view('admin.role.show', [
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {

            $role->update($request->only(['name', 'description']));

            $role->permissions()->sync($request->permission);
            
            $status = 'success';
            $content = 'El rol se ha actualizado correctamente';

        } catch (\Throwable $th) {
            
            $status = 'error';
            $content = 'Ha ocurrido un error al actualizar el rol';
        }

        return redirect()
                ->route('admin.role.show', $role->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {

            $role->delete();
            
            $status = 'success';
            $content = 'El rol se ha eliminado correctamente';

        } catch (\Throwable $th) {
            
            $status = 'error';
            $content = 'Ha ocurrido un error al eliminar el rol';
        }

        return redirect()
                ->route('admin.role.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);;
    }
}
