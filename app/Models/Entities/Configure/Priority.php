<?php

namespace App\Models\Entities\Configure;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = "priorities";

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
        'flag_status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function get_priorities() {
        $resultado = self::select(
                'priorities.id',
                'priorities.name',
                'priorities.flag_status',
                'priorities.created_at',
                'priorities.updated_at',
                'priorities.created_by',
                'priorities.updated_by',
                'creator.first_name as creator_name',
                'updater.first_name as updater_name'  

        ) ->join('users as creator', 'priorities.created_by', '=', 'creator.id')  
        ->join('users as updater', 'priorities.updated_by', '=', 'updater.id')
        ->orderBy('priorities.id', 'asc')
        ->get();

        return $resultado;
    }

    public function get_priority_by_id($id) {
        $resultado = self::select(
                'priorities.id',
                'priorities.name',
        )->where('priorities.id', $id)
        ->first();

        return $resultado;
    }
}
