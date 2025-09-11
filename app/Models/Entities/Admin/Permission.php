<?php

namespace App\Models\Entities\Admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";

    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'guard_name',
        'created_at',
        'updated_at',


    ];

    public function get_permissions() {
        $resultado = self::select(
                'id',
                'name',
                'description',
                'guard_name',
                'created_at',
                'updated_at',
            );

        $resultado
            ->orderBy('name')
            ->get();

        return $resultado;
    }
}
