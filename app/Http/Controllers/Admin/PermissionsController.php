<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class PermissionsController extends Controller implements HasMiddleware
{
    const PERMISSIONS = [
        'show' => 'admin-permission-show',

    ];
    
    public static function middleware(): array
    {
        return [
            //new Middleware('permission:'.self::PERMISSIONS['show'], only: [ 'index','show']),

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
}
