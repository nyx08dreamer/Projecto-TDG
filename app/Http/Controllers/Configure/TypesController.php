<?php

namespace App\Http\Controllers\Configure;

use App\Helpers\FlagStatusHelper;
use App\Http\Controllers\Controller;
use App\Models\Entities\Configure\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('configure.incident.type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configure.incident.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = 'success';
        $content = 'El tipo de incidencia se ha creado correctamente';

        try {
            
            $type = new Type;
            $type->name = $request->name;
            $type->created_by = Auth::id();
            $type->updated_by = Auth::id();
            $type->save();

        } catch (\Throwable $th) {
            
            $status = 'error';
            $content = 'Ha ocurrido un error al crear el tipo de incidencia';
        }

        return redirect()
                ->route('config.incidents.type.index')
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

    public function TypeList (Request $request)
    {
    
        if ($request->ajax()) {

            $type_model = new Type;
            $types = $type_model->get_types();

            $datatables = DataTables::of($types)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_edit = route('config.incidents.type.edit', $row->id);
                    $url_delete = route('config.incidents.type.destroy', $row->id);

                    $button_edit = '<a class="btn btn-sm btn-primary icon"  
                                    href="' . $url_edit . '"
                                    title="Clic para editar">
                                        <i class="fas fa-edit"></i>
                                    </a>';
                    $button_delete =  '<form action="' . $url_delete . '" method="POST" style="display: inline;  " onsubmit="return confirm(\'¿Estás seguro de eliminar este tipo de incidencia?\');">
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
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('configure.incident.type.edit', [
            'type' => $type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $status = 'success';
        $content = 'Se ha actualizado correctamente el tipo de incidencia';

        try {

            $type->name = $request->name;
            $type->flag_status = $request->flag_status;
            $type->updated_by = Auth::id();
            $type->save();

        } catch (\Throwable $th) {

            $status = 'error';
            $content = 'Ha ocurrido un error al actualizar el tipo de incidencia';
        }
        
        return redirect()
                ->route('config.incidents.type.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $status = 'success';
        $content = 'El tipo de incidencia se ha eliminado correctamente';

        try {
            
            $type->delete(); 

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al eliminar el tipo de incidencia';
        }

        return redirect()
                ->route('config.incidents.type.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }
}
