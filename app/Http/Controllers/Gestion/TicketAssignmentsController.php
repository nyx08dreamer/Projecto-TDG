<?php

namespace App\Http\Controllers\Gestion;

use App\Helpers\PriorityHelper;
use App\Helpers\TypeHelper;
use App\Http\Controllers\Controller;
use App\Models\Entities\Admin\User;
use App\Models\Entities\Configure\Department;
use App\Models\Entities\Configure\Priority;
use App\Models\Entities\Configure\Type;
use Illuminate\Http\Request;
use App\Models\Entities\Tickets\Ticket as CustomTicket;
use Yajra\DataTables\DataTables;


class TicketAssignmentsController extends Controller
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


        return view('gestion.assign.index', [
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
        $tickets = $ticket_model->get_unassigned_tickets_list();

        $users = User::role('ITsupport')->get(); 

        //dd($tickets);

        return view('gestion.assign.create', [
            'users' => $users,
            'tickets' => $tickets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function UnassignedTicketList (Request $request)
    {
        if ($request->ajax()) {

            $tickets = CustomTicket::get_unassigned_tickets($request->type_id,
                                                $request->priority_id,
                                                $request->department_id,
                                                $request->from_date, 
                                                $request->until_date);

            $datatables = DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_show = route('gestion.assign.show', $row->id);
                    $url_edit = route('ticket.edit', $row->id);

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

        return view('gestion.assign.show', [
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        //
    }

    public function assign(Request $request)
    {
        $status = 'success';
        $content = 'Se han asignado correctamente las solicitudes';

        $userId = $request->user_id;
        $ticketIds = $request->ticket_ids;

        try {
            
            CustomTicket::whereIn('id', $ticketIds)->update(['assigned_to' => $userId]);


        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al asignar las solicitudes';
        }

        return redirect()
                ->route('gestion.assign.index')
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
