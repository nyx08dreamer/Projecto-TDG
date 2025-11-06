<?php

namespace App\Http\Controllers\Tickets;

use App\Helpers\PriorityHelper;
use App\Helpers\TicketStatusHelper;
use App\Helpers\TypeHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entities\Admin\User;
use App\Models\Entities\Configure\Department;
use App\Models\Entities\Configure\Priority;
use App\Models\Entities\Configure\Type;
use Illuminate\Support\Str;
use App\Models\Entities\Tickets\Document;


use App\Models\Entities\Tickets\Ticket as CustomTicket;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SupportTicketsController extends Controller
{
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

        return view('support-ticket.index', [
            'departments' => $departments,
            'priorities' => $priorities,
            'types' => $types,
        ]);
    }

    public function SupportTicketList (Request $request)
    {
        if ($request->ajax()) {

            $tickets = CustomTicket::get_support_tickets($request->status,
                                                $request->priority_id,
                                                $request->type_id,
                                                $request->department_id,
                                                $request->from_date, 
                                                $request->until_date);

            $datatables = DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_show = route('ticket.support.show', $row->id);
                    $url_edit = route('ticket.support.edit', $row->id);

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
                    return Str::limit($row->title, 20, '...');
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
                ->editColumn('created_at', function($row) {
                    return \Carbon\Carbon::parse($row->created_at)->tz('America/Caracas')->format('d-m-Y h:i A');
                })
                ->rawColumns(['actions','status', 'priority_name', 'type_name'])
                ->make(true);
            return $datatables;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        return view('support-ticket.show', [
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
     * Show the form for editing the specified resource.
     */
    public function edit(CustomTicket $ticket)
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

        return view('support-ticket.edit', [
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
    public function update(Request $request, CustomTicket $ticket)
    {
        try {
            
            switch ($request->option) {
                case '1':
                    $ticket->closeAsResolved()->markAsLocked();
                    $status = 'success';
                    $content = 'La solicitud se ha cerrado como resuelta exitosamente';
                    break;
                
                case '2':
                    $ticket->closeAsUnresolved()->markAsLocked();
                    $status = 'success';
                    $content = 'La solicitud se ha cerrado como inconclusa exitosamente';
                    break;

                case '3':
                    $ticket->reopenAsUnresolved()->markAsUnlocked();
                    $status = 'success';
                    $content = 'La solicitud se ha reabierto exitosamente';
                    break;
            }

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al cambiar el estatus de la solicitud';
        }

        

        return redirect()
                ->route('ticket.support.index')
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
