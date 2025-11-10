<?php

namespace App\Http\Controllers\Gestion;

use App\Helpers\PriorityHelper;
use App\Helpers\TypeHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entities\Configure\Department;
use App\Models\Entities\Configure\Priority;
use App\Models\Entities\Configure\Type;
use App\Models\Entities\Admin\User;
use App\Models\Entities\Tickets\Document;
use App\Models\Entities\Tickets\Ticket as CustomTicket;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArchivedTicketsController extends Controller implements HasMiddleware
{
    const PERMISSIONS = [
        'create' => 'gestion-archived-create',
        'show' => 'gestion-archived-show',
        'edit' => 'gestion-archived-edit',
        'delete' => 'gestion-archived-delete',

    ];
    
    public static function middleware(): array
    {
        return [
            new Middleware('permission:'.self::PERMISSIONS['create'], only: [ 'create','unarchive']),
            new Middleware('permission:'.self::PERMISSIONS['show'], only: [ 'index', 'show']),
            new Middleware('permission:'.self::PERMISSIONS['edit'], only: ['update']),
            new Middleware('permission:'.self::PERMISSIONS['delete'], only: ['destroy']),
            
        ];
    }

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


        return view('gestion.archived_tickets.index', [
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
        $ticket_model = new CustomTicket;
        $tickets = $ticket_model->get_archived_tickets_list();

        return view('gestion.archived_tickets.create', [
            'tickets' => $tickets,
        ]);
    }

    public function ArchivedTicketList (Request $request)
    {
        if ($request->ajax()) {

            $tickets = CustomTicket::get_archived_tickets($request->type_id,
                                                $request->priority_id,
                                                $request->department_id,
                                                $request->from_date, 
                                                $request->until_date);

            $datatables = DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_show = route('gestion.archived-tickets.show', $row->id);
                    $url_delete = route('gestion.archived-tickets.destroy', $row->id);


                    $button_show = '<a class="btn btn-sm btn-info icon"  
                                    href="' . $url_show . '"
                                    title="Clic para ver detalles">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>';

                    $button_delete =  '<form action="' . $url_delete . '" method="POST" style="display: inline;  " onsubmit="return confirm(\'¿Estás seguro de eliminar esta solicitud?\');">
                                        ' . csrf_field() . '  <!-- Token CSRF -->
                                        <input type="hidden" name="_method" value="DELETE">
                                        
                                    <button type="submit" class="btn btn-sm btn-danger icon" title="Clic para borrar">
                                            <i class="fas fa-trash"></i>  
                                        </button>
                                      </form>';

                    $buttons = $button_show; 
                    if (Auth::user()->can('gestion-archived-delete')) {
                        $buttons .= $button_delete; 
                    }

                    return '<div role="group">' . $buttons . '</div>';
                })
                ->editColumn('title', function($row) {
                    return Str::limit($row->title, 20, '...');
                })
                ->addColumn('priority_name', function ($row) {
                    $td = '<span class="badge '.PriorityHelper::get_priority_color($row->priority_id).'">'.$row->priority_name.'</span>';
                    return $td;
                })
                ->addColumn('type_name', function ($row) {
                    $td = '<span class="badge '.TypeHelper::get_type_color($row->type_id).'">'.$row->type_name.'</span>';
                    return $td;
                })
                ->rawColumns(['actions', 'priority_name', 'type_name'])
                ->make(true);
            return $datatables;
        }
    }

    public function unarchive(Request $request)
    {
        $status = 'success';
        $content = 'Se han desarchivado correctamente las solicitudes';

        $ticketIds = $request->ticket_ids;
        try {
            
            CustomTicket::whereIn('id', $ticketIds)->update(['is_archived' => false]);

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al desarchivar las solicitudes';
        }

        return redirect()
                ->route('gestion.archived-tickets.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
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

        $document_model = new Document;
        $documents =  $document_model->get_documents_by_id($ticket->id);

        return view('gestion.archived_tickets.show', [
            'ticket' => $ticket,
            'department' => $department,
            'priority' => $priority,
            'type' => $type,
            'solicitor' => $solicitor,
            'support' => $support,
            'documents' => $documents,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CustomTicket $ticket)
    {
        $status = 'success';
        $content = 'Se ha desarchivado correctamente la solicitud';

        try {
            $ticket->update(['is_archived' => false]);

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al desarchivar la solicitud';
        }

        return redirect()
                ->route('gestion.archived-tickets.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomTicket $ticket)
    {
        $status = 'success';
        $content = 'Se ha eliminado correctamente la solicitud';

        try {
            $ticket->delete();

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al eliminar la solicitud';
        }


        return redirect()
                ->route('gestion.archived-tickets.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }
}
