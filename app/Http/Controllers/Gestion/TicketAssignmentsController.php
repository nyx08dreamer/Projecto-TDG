<?php

namespace App\Http\Controllers\Gestion;

use App\Helpers\PriorityHelper;
use App\Helpers\TypeHelper;
use App\Http\Controllers\Controller;
use App\Mail\TicketAssignedMailable;
use App\Mail\TicketAssignedToMailable;
use App\Models\Entities\Admin\User;
use App\Models\Entities\Configure\Department;
use App\Models\Entities\Configure\Priority;
use App\Models\Entities\Configure\Type;
use Illuminate\Http\Request;
use App\Models\Entities\Tickets\Ticket as CustomTicket;
use App\Notifications\TicketAssignedNotification;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Models\Entities\Tickets\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class TicketAssignmentsController extends Controller implements HasMiddleware
{
    const PERMISSIONS = [
        'create' => 'gestion-assign-create',
        'show' => 'gestion-assign-show',
        'edit' => 'gestion-assign-edit',

    ];
    
    public static function middleware(): array
    {
        return [
            new Middleware('permission:'.self::PERMISSIONS['create'], only: [ 'create','assign']),
            new Middleware('permission:'.self::PERMISSIONS['show'], only: [ 'index', 'show']),
            new Middleware('permission:'.self::PERMISSIONS['edit'], only: ['edit', 'update']),
            
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

        return view('gestion.assign.create', [
            'users' => $users,
            'tickets' => $tickets,
        ]);
    }

    public function ItSupportUsers (Request $request)
    {
        if ($request->ajax()) {
            $users = User::role('ITsupport')->get(); 
            return response()->json($users);
        }
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
                    $url_edit= route('gestion.assign.edit', $row->id);

                    $button_show = '<a class="btn btn-sm btn-info icon"  
                                    href="' . $url_show . '"
                                    title="Clic para ver detalles">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>';
                    
                    $button_edit = '<a class="btn btn-sm btn-primary icon ml-1"  
                                    href="' . $url_edit . '"
                                    title="Asignar">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </a>';

                    $buttons = $button_show; 
                    if (Auth::user()->can('gestion-assign-edit')) {
                        $buttons .= $button_edit; 
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


    /**
     * Display the specified resource.
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

        $users = User::role('ITsupport')->get(); 

        return view('gestion.assign.edit', [
            'ticket' => $ticket,
            'department' => $department,
            'priority' => $priority,
            'type' => $type,
            'solicitor' => $solicitor,
            'support' => $support,
            'documents' => $documents,
            'users' => $users,
        ]);
    }

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

        return view('gestion.assign.show', [
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
        $status = 'success';
        $content = 'Se ha asignado correctamente la solicitud';

        $id = $ticket->user_id;
        $userId = $request->user_id;

        $technician = User::find($userId);
        $solicitor = User::find($id);
        
        try {
            $ticket->update([
                'assigned_to' => $userId,
            ]);
        
            $creator = $ticket->user;  
            if ($creator) {
                
                $creator->notify(new TicketAssignedNotification($ticket));
                
                Mail::to($creator->email)->send(new TicketAssignedToMailable($ticket, $technician));
            }

            // if ($technician) {
                
            //     //$technician->notify(new TicketAssignedNotification($ticket));
                
            //     Mail::to($technician->email)->send(new TicketAssignedMailable($ticket, $solicitor));
            // }

        } catch (\Throwable $th) {
            $status = 'error';
            $content = 'Ha ocurrido un error al asignar la solicitud';
        }

        return redirect()
                ->route('gestion.assign.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);
    }


    public function assign(Request $request)
    {
        $status = 'success';
        $content = 'Se han asignado correctamente las solicitudes';

        $userId = $request->user_id;
        $ticketIds = $request->ticket_ids;

        try {
            
            $tickets = CustomTicket::whereIn('id', $ticketIds)->with('user')->get(); // Carga los tickets con su relación 'user'

            CustomTicket::whereIn('id', $ticketIds)->update(['assigned_to' => $userId]);

            // Ahora, envía notificaciones a los usuarios propietarios de los tickets
            $usersToNotify = $tickets->pluck('user')->unique('id'); // Obtiene los usuarios únicos

            foreach ($usersToNotify as $user) {
                // Envía la notificación al usuario, pasando los tickets relevantes
                $user->notify(new TicketAssignedNotification($tickets->where('user_id', $user->id)));

            }


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

}
