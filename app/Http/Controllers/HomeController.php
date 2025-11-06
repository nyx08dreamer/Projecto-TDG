<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entities\Tickets\Ticket as CustomTicket;

class HomeController extends Controller
{
    public function __invoke()
    {
        $tickets = CustomTicket::get_tickets_pdf();
        return view('home', ['tickets' => $tickets]);
    }
}
