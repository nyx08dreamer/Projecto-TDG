<?php

namespace App\Http\Controllers\Configure;

use App\Helpers\FlagStatusHelper;
use App\Http\Controllers\Controller;
use App\Models\Entities\Configure\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PrioritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('configure.priority.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configure.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = 'success';
        $content = 'La prioridad se ha creado correctamente';

        try {
            $priority = new Priority;
            $priority->name = $request->name;
            $priority->created_by = Auth::id();
            $priority->updated_by = Auth::id();
            $priority->save();

        } catch (\Throwable $th) {

            $status = 'error';
            $content = 'Ha ocurrido un error al crear la prioridad';

        }

        return redirect()
                ->route('config.priority.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function PriorityList (Request $request)
    {
    
        if ($request->ajax()) {

            $priority_model = new Priority;
            $priorities = $priority_model->get_priorities();

            $datatables = DataTables::of($priorities)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_edit = route('config.priority.edit', $row->id);
                    $url_delete = route('config.priority.destroy', $row->id);

                    $button_edit = '<a class="btn btn-sm btn-info icon"  
                                    href="' . $url_edit . '"
                                    title="Clic para editar">
                                        <i class="fas fa-edit"></i>
                                    </a>';
                    $button_delete =  '<form action="' . $url_delete . '" method="POST" style="display: inline;  " onsubmit="return confirm(\'¿Estás seguro de eliminar esta prioridad?\');">
                                        ' . csrf_field() . '  <!-- Token CSRF -->
                                        <input type="hidden" name="_method" value="DELETE">
                                        
                                    <button type="submit" class="btn btn-sm btn-danger icon ml-1" title="Clic para borrar">
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
     * Show the form for editing the specified resource.
     */
    public function edit(Priority $priority)
    {
        return view('configure.priority.edit', [
            'priority' => $priority,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Priority $priority)
    {
        $status = 'success';
        $content = 'Se ha actualizado correctamente la prioridad';

        try {

            $priority->name = $request->name;
            $priority->flag_status = $request->flag_status;
            $priority->updated_by = Auth::id();
            $priority->save();

        } catch (\Throwable $th) {
            
            $status = 'error';
            $content = 'Ha ocurrido un error al actualizar la prioridad';
        }

        return redirect()
                ->route('config.priority.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Priority $priority)
    {
        $status = 'success';
        $content = 'El rol se ha eliminado correctamente';

        try {

            $priority->delete(); 

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al eliminar la prioridad';
        }

        return redirect()
                ->route('config.priority.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }
}
