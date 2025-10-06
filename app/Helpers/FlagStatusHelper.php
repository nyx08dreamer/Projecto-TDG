<?php

namespace App\Helpers;

class FlagStatusHelper
{
    
    public static function get_flag_status(int $flag_status_id)
    {
        $status = "";

        switch ($flag_status_id) {
            case 0:
                $status = 'Desactivada';
                break;
            case 1:
                $status = 'Activa';
                break;

        }

        return $status;
    }


    /**
     * Retorna solo el color del estatus.
     */
    public static function get_flag_status_color(int $flag_status_id): string
    {
        $status = "";

        switch ($flag_status_id) {
            case 0:
                $status = 'bg-secondary';
                break;
            case 1:
                $status = 'bg-primary';
                break;
        }

        return $status;
    }
}