<?php

namespace App\Http\Controllers\Configure;

use App\Helpers\FlagStatusHelper;
use App\Http\Controllers\Controller;
use App\Models\Entities\Configure\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('configure.department.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configure.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = 'success';
        $content = 'El departamento se ha creado correctamente';

        try {
            
            $department = new Department;
            $department->name = $request->name;
            $department->created_by = Auth::id();
            $department->updated_by = Auth::id();
            $department->save();

        } catch (\Throwable $th) {
            
            $status = 'error';
            $content = 'Ha ocurrido un error al crear el departamento';
        }

            
        
        return redirect()
                ->route('config.department.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

    public function DepartmentList (Request $request)
    {
    
        if ($request->ajax()) {

            $department_model = new Department;
            $departments = $department_model->get_departments();

            $datatables = DataTables::of($departments)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_edit = route('config.department.edit', $row->id);
                    $url_delete = route('config.department.destroy', $row->id);

                    $button_edit = '<a class="btn btn-sm btn-primary icon"  
                                    href="' . $url_edit . '"
                                    title="Clic para editar">
                                        <i class="fas fa-edit"></i>
                                    </a>';
                    $button_delete =  '<form action="' . $url_delete . '" method="POST" style="display: inline;  " onsubmit="return confirm(\'¿Estás seguro de eliminar este departamento?\');">
                                        ' . csrf_field() . '  <!-- Token CSRF -->
                                        <input type="hidden" name="_method" value="DELETE">
                                        
                                    <button type="submit" class="btn btn-sm btn-danger icon" title="Clic para borrar">
                                            <i class="fas fa-trash"></i>  
                                        </button>
                                      </form>';

                    return '<div role="group">
                                ' . $button_edit . '
                                ' . $button_delete . '
                            </div>';
                })
                ->addColumn('flag_status', function ($row) {
                    $td = '<span class="badge '.FlagStatusHelper::get_flag_status_color($row->flag_status).'">'.FlagStatusHelper::get_flag_status($row->flag_status).'</span>';
                    return $td;
                })
                
            ->rawColumns(['flag_status', 'actions']) 
            ->make(true);

            return $datatables;
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('configure.department.edit', [
            'department' => $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $status = 'success';
        $content = 'Se ha actualizado correctamente el departamento';

        try {

            $department->name = $request->name;
            $department->flag_status = $request->flag_status;
            $department->updated_by = Auth::id();
            $department->save();

        } catch (\Throwable $th) {
            
            $status = 'error';
            $content = 'Ha ocurrido un error al actualizar el departamento';
        }

        return redirect()
                ->route('config.department.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $status = 'success';
        $content = 'El departamento se ha eliminado correctamente';

        try {
            
            $department->delete(); 
            
        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al eliminar el departamento';
        }

        return redirect()
                ->route('config.department.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }
}
