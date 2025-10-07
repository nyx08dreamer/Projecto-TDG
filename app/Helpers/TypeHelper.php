<?php

namespace App\Helpers;

class TypeHelper
{

    /**
     * Retorna solo el color del estatus.
     */
    public static function get_type_color(int $type_id): string
    {
        $status = "";

        switch ($type_id) {
            case 1:
                $status = 'bg-gray';
                break;
            case 2:
                $status = 'bg-primary';
                break;
            case 3:
                $status = 'bg-info';
                break;
            case 4:
                $status = 'bg-warning';
                break;
        }

        return $status;
    }
}