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

    public static function get_tickets() {

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

        )->join('users as creator', 'tickets.user_id', '=', 'creator.id')  
        ->join('priorities', 'tickets.priority_id', '=', 'priorities.id') 
        ->join('types', 'tickets.type_id', '=', 'types.id')  
        ->orderBy('tickets.id', 'asc')
        ->get();

        return $resultado;
    }
}
