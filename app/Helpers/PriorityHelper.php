<?php

namespace App\Helpers;

class PriorityHelper
{

    /**
     * Retorna solo el color del estatus.
     */
    public static function get_priority_color(int $priority_id): string
    {
        $status = "";

        switch ($priority_id) {
            case 1:
                $status = 'bg-secondary';
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
            case 5:
                $status = 'bg-danger';
                break;
        }

        return $status;
    }
}