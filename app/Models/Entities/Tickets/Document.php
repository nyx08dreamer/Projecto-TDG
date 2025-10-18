<?php

namespace App\Models\Entities\Tickets;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "documents";

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
        'name',
        'ticket_id',
        'user_id',
        'type',
        'route', 
        'created_at',
        'updated_at',
    ];


    public function get_documents_by_id($id){
        $resultado = self::select(
                'id',
                'name',
                'ticket_id',
                'user_id',
                'type',
                'route',
        )->where('ticket_id', $id)->get();

        return $resultado;
    }
}
