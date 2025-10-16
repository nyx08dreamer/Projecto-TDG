<?php

namespace App\Models\Entities\Tickets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Coderflex\LaravelTicket\Models\Ticket as BaseTicket; 

class Ticket extends BaseTicket
{

    protected $table = "tickets";

    protected $primaryKey = "id";
    protected $casts = [
        'created_at' => 'datetime:d-m-Y', 
        'updated_at' => 'datetime:d-m-Y',

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'uuid',
        'user_id',
        'title',
        'message', 
        'type_id',
        'priority_id',
        'status',
        'is_resolved',
        'is_locked',
        'assigned_to',
        'created_at',
        'updated_at',
        'department_id',
    ];

    

    public static function get_tickets($type_id, $priority_id, $department_id, $from_date, $until_date) {

        $resultado = self::select(
                'tickets.id',
                'tickets.uuid',
                'tickets.user_id',
                'tickets.title',
                'tickets.message', 
                'tickets.type_id',
                'tickets.priority_id',
                'tickets.status',
                'tickets.is_resolved',
                'tickets.is_locked',
                'tickets.assigned_to',
                'tickets.created_at',
                'tickets.updated_at',
                'tickets.department_id',

                
                'creator.first_name as creator_name',
                'priorities.name as priority_name',
                'types.name as type_name',
                'departments.name as department_name',

        )->join('users as creator', 'tickets.user_id', '=', 'creator.id')  
        ->join('priorities', 'tickets.priority_id', '=', 'priorities.id') 
        ->join('types', 'tickets.type_id', '=', 'types.id')
        ->join('departments', 'tickets.department_id', '=', 'departments.id');

        
        if($priority_id != null){
            $resultado->where('tickets.priority_id', $priority_id);
        }
        if($type_id != null){
            $resultado->where('tickets.type_id', $type_id);
        }
        if($department_id != null){
            $resultado->where('tickets.department_id', $department_id);
        }
        if ($from_date != null) {
            $resultado->whereBetween('tickets.created_at', [$from_date, $until_date]);
        }

        $resultado->orderBy('tickets.id', 'desc')->get();

        return $resultado;
    }


    public static function get_unassigned_tickets($type_id, $priority_id, $department_id, $from_date, $until_date) {

        $resultado = self::select(
                'tickets.id',
                'tickets.uuid',
                'tickets.user_id',
                'tickets.title',
                'tickets.message', 
                'tickets.type_id',
                'tickets.priority_id',
                'tickets.status',
                'tickets.is_resolved',
                'tickets.is_locked',
                'tickets.assigned_to',
                'tickets.created_at',
                'tickets.updated_at',
                'tickets.department_id',

                
                'creator.first_name as creator_name',
                'priorities.name as priority_name',
                'types.name as type_name',
                'departments.name as department_name',

        )->join('users as creator', 'tickets.user_id', '=', 'creator.id')  
        ->join('priorities', 'tickets.priority_id', '=', 'priorities.id') 
        ->join('types', 'tickets.type_id', '=', 'types.id')
        ->join('departments', 'tickets.department_id', '=', 'departments.id')
        ->where('tickets.assigned_to', null);

        
        if($priority_id != null){
            $resultado->where('tickets.priority_id', $priority_id);
        }
        if($type_id != null){
            $resultado->where('tickets.type_id', $type_id);
        }
        if($department_id != null){
            $resultado->where('tickets.department_id', $department_id);
        }
        if ($from_date != null) {
            $resultado->whereBetween('tickets.created_at', [$from_date, $until_date]);
        }

        $resultado->orderBy('tickets.id', 'desc')->get();

        return $resultado;
    }


    public function get_unassigned_tickets_list() {

        $resultado = self::select(
                'tickets.id',
                'tickets.uuid',
                'tickets.user_id',
                'tickets.title',
                'tickets.message', 
                'tickets.type_id',
                'tickets.priority_id',
                'tickets.status',
                'tickets.is_resolved',
                'tickets.is_locked',
                'tickets.assigned_to',
                'tickets.created_at',
                'tickets.updated_at',
                'tickets.department_id',

                'creator.first_name as creator_name',
                'priorities.name as priority_name',
                'types.name as type_name',
                'departments.name as department_name',

        )->join('users as creator', 'tickets.user_id', '=', 'creator.id')  
        ->join('priorities', 'tickets.priority_id', '=', 'priorities.id') 
        ->join('types', 'tickets.type_id', '=', 'types.id')
        ->join('departments', 'tickets.department_id', '=', 'departments.id')
        ->where('tickets.assigned_to', null)->get();

        return $resultado;
    }


    public static function get_ticket_by_id($id) {

        $resultado = self::select(
                'tickets.id',
                'tickets.uuid',
                'tickets.user_id',
                'tickets.title',
                
                'tickets.assigned_to',
        )
        ->where('tickets.id', $id)
        ->first();

        return $resultado;
    }
}
