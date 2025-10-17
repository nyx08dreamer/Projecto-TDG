<?php

namespace App\Http\Controllers\Tickets;

use App\Helpers\PriorityHelper;
use App\Helpers\TicketStatusHelper;
use App\Helpers\TypeHelper;
use App\Http\Controllers\Controller;
use App\Models\Entities\Admin\User;
use App\Models\Entities\Configure\Department;
use App\Models\Entities\Configure\Priority;
use App\Models\Entities\Configure\Type;
use App\Models\Entities\Tickets\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Entities\Tickets\Ticket as CustomTicket;
use App\Services\DocumentService;
use App\Traits\Controllers\UploadFilesTrait;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Label;

class TicketsController extends Controller
{
    use UploadFilesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department_model = new Department;
        $departments = $department_model->get_departments();

        $priority_model = new Priority;
        $priorities = $priority_model->get_priorities();

        $type_model = new Type;
        $types = $type_model->get_types();

        return view('ticket.index', [
            'departments' => $departments,
            'priorities' => $priorities,
            'types' => $types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department_model = new Department;
        $departments = $department_model->get_departments();

        $priority_model = new Priority;
        $priorities = $priority_model->get_priorities();

        $type_model = new Type;
        $types = $type_model->get_types();


        

        return view('ticket.create', [
            'departments' => $departments,
            'priorities' => $priorities,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $status = 'success';
        $content = 'El ticket se ha creado correctamente';

        // dd($request->get('archivos'));
            
            $ticket = CustomTicket::create([
                'title' => $request->title,
                'uuid' => (string) Str::uuid(),
                'user_id' => Auth::id(),
                'message' => $request->message,
                'department_id' => $request->department,
                'priority_id' => $request->priority,
                'type_id' => $request->type,
                'status' => 'open', 
            ]);


            foreach($request->get('archivos') as $archivo){

                if ($archivo !== null && !empty($archivo)) {

                    $ultimoDocumento = Document::orderby('id', 'desc')->first();
                    $nuevoIdDocumento = $ultimoDocumento ? $ultimoDocumento->id + 1 : 1;

                    $nombre_archivo = $ticket->id . 'datosSolicitud_' . ($nuevoIdDocumento) . '.' . pathinfo($archivo, PATHINFO_EXTENSION);

                    DocumentService::copiar('temp/'.$archivo, 'documentos/'.$nombre_archivo);

                    DocumentService::guardar([
                            'name' => $nombre_archivo,
                            'ticket_id' => $ticket->id,
                            'user_id' => Auth::id(),
                            'type' => 1,
                            'route'  => 'storage/documentos/', 
                        ]);

                    DocumentService::eliminar('temp/'.$archivo);
                }
            }

        

        return redirect()
                ->route('ticket.all.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);;
    }

    public function TicketsList (Request $request)
    {
        if ($request->ajax()) {

            $tickets = CustomTicket::get_tickets($request->status,
                                                $request->priority_id,
                                                $request->type_id,
                                                $request->department_id,
                                                $request->assigned,
                                                $request->from_date, 
                                                $request->until_date);

            $datatables = DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_show = route('ticket.all.show', $row->id);
                    $url_edit = route('ticket.all.edit', $row->id);

                    $button_show = '<a class="btn btn-sm btn-info icon"  
                                    href="' . $url_show . '"
                                    title="Clic para ver detalles">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>';

                    $button_edit = '<a class="btn btn-sm btn-primary icon"  
                                    href="' . $url_edit . '"
                                    title="Clic para editar">
                                        <i class="fas fa-edit"></i>
                                    </a>';

                    return '<div role="group">
                                ' . $button_show . '
                                ' . $button_edit . '
                            </div>';
                })
                ->editColumn('uuid', function($row) {
                    return Str::limit($row->uuid, 15, '...');
                })
                ->editColumn('title', function($row) {
                    return Str::limit($row->title, 15, '...');
                })
                ->addColumn('status', function ($row) {
                    $td = '<span class="badge '.TicketStatusHelper::get_ticket_status_color($row->status).'">'.TicketStatusHelper::get_ticket_status($row->status).'</span>';
                    return $td;
                })
                ->addColumn('priority_name', function ($row) {
                    $td = '<span class="badge '.PriorityHelper::get_priority_color($row->priority_id).'">'.$row->priority_name.'</span>';
                    return $td;
                })
                ->addColumn('type_name', function ($row) {
                    $td = '<span class="badge '.TypeHelper::get_type_color($row->type_id).'">'.$row->type_name.'</span>';
                    return $td;
                })
                ->editColumn('department_name', function($row) {
                    return Str::limit($row->department_name, 20, '...');
                })
                ->editColumn('created_at', function($row) {
                    return \Carbon\Carbon::parse($row->created_at)->tz('America/Caracas')->format('d-m-Y');
                })
                ->rawColumns(['actions', 'status', 'priority_name', 'type_name'])
                ->make(true);
            return $datatables;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomTicket $ticket)
    {
        $department_model = new Department;
        $department = $department_model->get_department_by_id($ticket->department_id);

        $priority_model = new Priority;
        $priority = $priority_model->get_priority_by_id($ticket->priority_id);

        $type_model = new Type;
        $type = $type_model->get_type_by_id($ticket->type_id);

        $solicitor_model = new User;
        $solicitor = $solicitor_model->get_solicitor_by_id($ticket->user_id);

        $support_model = new User;
        $support = $support_model->get_support_by_id($ticket->assigned_to);

        $document = '';

        return view('ticket.show', [
            'ticket' => $ticket,
            'department' => $department,
            'priority' => $priority,
            'type' => $type,
            'solicitor' => $solicitor,
            'support' => $support,
            'document' => $document,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomTicket $ticket)
    {
        $department_model = new Department;
        $departments = $department_model->get_departments();

        $priority_model = new Priority;
        $priorities = $priority_model->get_priorities();

        $type_model = new Type;
        $types = $type_model->get_types();


        $selected_department_model = new Department;
        $selected_department = $selected_department_model->get_department_by_id($ticket->department_id);

        $selected_priority_model = new Priority;
        $selected_priority = $selected_priority_model->get_priority_by_id($ticket->priority_id);

        $selected_type_model = new Type;
        $selected_type = $selected_type_model->get_type_by_id($ticket->type_id);


        return view('ticket.edit', [
            'ticket' => $ticket,
            'departments' => $departments,
            'priorities' => $priorities,
            'types' => $types,

            'selected_department' => $selected_department,
            'selected_priority' => $selected_priority,
            'selected_type' => $selected_type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomTicket $ticket)
    {
        $status = 'success';
        $content = 'Se ha actualizado correctamente la solicitud';

        try {

            $ticket->update([
                'title' => $request->title,
                'message' => $request->message,
                'department_id' => $request->department,
                'priority_id' => $request->priority,
                'type_id' => $request->type,
            ]);

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al actualizar la solicitud';
        }

        return redirect()
                ->route('ticket.all.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
