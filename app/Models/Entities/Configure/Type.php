<?php

namespace App\Models\Entities\Configure;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = "types";

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

    public function get_types() {
        $resultado = self::select(
                'types.id',
                'types.name',
                'types.flag_status',
                'types.created_at',
                'types.updated_at',
                'types.created_by',
                'types.updated_by',
                'creator.first_name as creator_name',
                'updater.first_name as updater_name'  

        ) ->join('users as creator', 'types.created_by', '=', 'creator.id')  
        ->join('users as updater', 'types.updated_by', '=', 'updater.id')
        ->orderBy('types.id', 'asc')
        ->get();

        return $resultado;
    }
}
