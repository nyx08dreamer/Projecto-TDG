<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Models\Entities\Admin\User;


class PermissionsController extends Controller implements HasMiddleware
{
    const PERMISSIONS = [
        'show' => 'admin-permission-show',

    ];
    
    public static function middleware(): array
    {
        return [
            // new Middleware('permission:'.self::PERMISSIONS['show'], only: [ 'index','show']),

        ];
    }

    public function index(){

        return view('admin.permission.index');

    }

    public function PermissionList(Request $request) {

        if ($request->ajax()) {

            $permissions = Permission::query();

            $datatables = DataTables::of($permissions)
                ->addIndexColumn()
                ->editColumn('name', function($permission) {
                
                $url = route('admin.permission.show', $permission->id);
                return '<a href="' . $url . '">' . e($permission->name) . '</a>';
            })
            ->rawColumns(['name']) 
                ->make(true);
            return $datatables;
        }
    }

    public function show(Permission $permission){
        
        return view('admin.permission.show', [
            'permission' => $permission,
        ]);
    }

    public function PermissionDetails (Permission $permission, Request $request)
    {
        if ($request->ajax()) {

            // Verificar qué datos se solicitan: permisos o usuarios
            $type = $request->get('type');
            
            //App\Models\Entities\Admin\User

            if ($type === 'users') {
                $directUsers = $permission->users()->get();
                $roleUsers = \App\Models\Entities\Admin\User::whereHas('roles.permissions', function($query) use ($permission) {
                    $query->where('id', $permission->id);
                })->get();
                $allUsers = $directUsers->merge($roleUsers)->unique('id')->map(function($user) {
                    $user->full_name = $user->first_name . ' ' . $user->last_name;
                    return $user;
                });
                return DataTables::of($allUsers)
                    ->addIndexColumn()
                    ->editColumn('full_name', function($user) {
                        $url = route('admin.user.show', $user->id);
                        return '<a href="' . $url . '">' . e($user->full_name) . '</a>';
                    })
                    ->rawColumns(['full_name'])
                    ->make(true);
            }

            if ($type === 'roles') {
                $permissionRoles = $permission->roles()->get();
                return DataTables::of($permissionRoles)
                ->addIndexColumn()
                ->editColumn('name', function($role) {
                    /** @var User|null $user */
                    $user = Auth::user();

                    // Ignorar "Error", el metodo funciona
                    if ($user->can('admin-role-show')) {
                        $url = route('admin.role.show', $role->id);
                        return '<a href="' . $url . '">' . e($role->name) . '</a>';
                    } else {
                        // Usuario no tiene permiso, solo mostrar el nombre sin enlace
                        return e($role->name);
                    }
                })
                ->rawColumns(['name'])
                ->make(true);
            }

            
        // Si no se especifica tipo o es inválido, puedes devolver un error o vacío
        return response()->json(['error' => 'Tipo de datos no especificado o inválido'], 400);
        }
        
    }
}
