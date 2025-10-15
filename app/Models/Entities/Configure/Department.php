<?php

namespace App\Models\Entities\Configure;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";

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

    public function get_departments() {
        $resultado = self::select(
                'departments.id',
                'departments.name',
                'departments.flag_status',
                'departments.created_at',
                'departments.updated_at',
                'departments.created_by',
                'departments.updated_by',
                'creator.first_name as creator_name',
                'updater.first_name as updater_name'  

        ) ->join('users as creator', 'departments.created_by', '=', 'creator.id')  
        ->join('users as updater', 'departments.updated_by', '=', 'updater.id')
        ->orderBy('departments.id', 'asc')
        ->get();

        return $resultado;
    }
}
