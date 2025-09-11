<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

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

            // new Middleware('permission:'.self::PERMISSIONS['create'], only: ['create', 'store']),
            // new Middleware('permission:'.self::PERMISSIONS['show'], only: [ 'index','show']),
            // new Middleware('permission:'.self::PERMISSIONS['edit'], only: ['edit', 'update']),

            
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
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try {

            $role= new Role($request->all());
            $role->save();
            
            $status = 'success';
            $content = 'El rol se ha creado correctamente';

        } catch (\Throwable $th) {
            
            $status = 'error';
            $content = 'Ha ocurrido un error al crear el rol';
        }

        return redirect()
                ->route('admin.role.show', $role->id)
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);;
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
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
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {

            $role->update($request->all());
            
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
