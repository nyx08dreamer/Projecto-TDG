<?php

namespace App\Http\Controllers\Tickets;

use App\Helpers\PriorityHelper;
use App\Helpers\TypeHelper;
use App\Http\Controllers\Controller;
use App\Models\Entities\Configure\Department;
use App\Models\Entities\Configure\Priority;
use App\Models\Entities\Configure\Type;
use Illuminate\Http\Request;

use Coderflex\LaravelTicket\Models\Ticket;
use App\Models\Entities\Tickets\Ticket as CustomTicket;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Label;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ticket.index');
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

        //dd($request->all());

        $ticket = CustomTicket::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'department_id' => $request->department,
            'priority_id' => $request->priority,
            'type_id' => $request->type,
            'status' => 'open', 
        ]);

        return redirect()
                ->route('ticket.index')
                ->with('process_result', [
                    'status' => $status,
                    'content' => $content,
                ]);;
    }

    public function TicketsList (Request $request)
    {
        if ($request->ajax()) {

            // $ticket_model = new CustomTicket;
            // $tickets = $ticket_model->get_tickets();

            // $tickets = Ticket::orderBy('id', 'asc');

            $tickets = CustomTicket::get_tickets();

            $datatables = DataTables::of($tickets)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $url_show = route('ticket.show', $row->id);
                    $url_edit = route('ticket.edit', $row->id);
                    $url_delete = route('ticket.destroy', $row->id);

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

                    $button_delete =  '<form action="' . $url_delete . '" method="POST" style="display: inline;  " onsubmit="return confirm(\'¿Estás seguro de eliminar esta solicitud?\');">
                                        ' . csrf_field() . '  <!-- Token CSRF -->
                                        <input type="hidden" name="_method" value="DELETE">
                                        
                                    <button type="submit" class="btn btn-sm btn-danger icon" title="Clic para borrar">
                                            <i class="fas fa-trash"></i>  
                                        </button>
                                      </form>';

                    return '<div role="group">
                                ' . $button_show . '
                                ' . $button_edit . '
                                ' . $button_delete . '
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
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomTicket $ticket)
    {
        return view('ticket.show', [
            'ticket' => $ticket,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomTicket $ticket)
    {
        return view('ticket.edit', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
