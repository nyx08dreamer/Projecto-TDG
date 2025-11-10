<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entities\Tickets\Ticket as CustomTicket;

class HomeController extends Controller
{
    public function __invoke()
    {
        $userTickets = CustomTicket::where('user_id', auth()->id())->get();
        $tickets = CustomTicket::get_tickets_pdf();

        if (auth()->user()->hasRole('root')) {
            return view('home', ['tickets' => $tickets]);
        } elseif (auth()->user()->hasRole('ITsupport')) {
            return view('home', ['tickets' => $tickets]);
        } else {
            return view('home', ['userTickets' => $userTickets,]);
        }

    }
}
