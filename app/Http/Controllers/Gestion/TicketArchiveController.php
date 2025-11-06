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

class TicketArchiveController extends Controller
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


        return view('gestion.archive.index', [
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
        $tickets = $ticket_model->get_unarchive_tickets_list();


        return view('gestion.archive.create', [
            'tickets' => $tickets,
        ]);
    }

    public function UnarchivedTicketList (Request $request)
    {
        if ($request->ajax()) {

            $tickets = CustomTicket::get_unarchive_tickets($request->type_id,
                                                $request->priority_id,
                                                $request->department_id,
                                                $request->from_date, 
                                                $request->until_date);

            $datatables = DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_show = route('gestion.archive.show', $row->id);

                    $button_show = '<a class="btn btn-sm btn-info icon"  
                                    href="' . $url_show . '"
                                    title="Clic para ver detalles">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>';

                    return '<div role="group">
                                ' . $button_show . '
                            </div>';
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

    public function archive(Request $request)
    {
        $status = 'success';
        $content = 'Se han archivado correctamente las solicitudes';

        $ticketIds = $request->ticket_ids;
        try {
            
            CustomTicket::whereIn('id', $ticketIds)->update(['is_archived' => true]);

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al archivar las solicitudes';
        }

        return redirect()
                ->route('gestion.archive.index')
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

        return view('gestion.archive.show', [
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
        $content = 'Se ha archivado correctamente la solicitud';

        try {
            $ticket->update(['is_archived' => true]);

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al archivar la solicitud';
        }

        return redirect()
                ->route('gestion.archive.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }

}
