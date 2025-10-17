<?php

namespace App\Helpers;

class TicketStatusHelper
{
    
    public static function get_ticket_status(string $ticket_status)
    {
        $status = "";

        switch ($ticket_status) {
            case 'open':
                $status = 'Abierto';
                break;
            case 'closed':
                $status = 'Cerrado';
                break;

        }

        return $status;
    }


    /**
     * Retorna solo el color del estatus.
     */
    public static function get_ticket_status_color(string $ticket_status): string
    {
        $status = "";

        switch ($ticket_status) {
            case 'open':
                $status = 'bg-success';
                break;
            case 'closed':
                $status = 'bg-danger';
                break;
            }

        return $status;
    }
}