<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function createTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Ticket created successfully.');
    }

    public function respondTicket(Request $request, $ticketId)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($ticketId);

        // Authorization logic for ticket response can be added here

        TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'response' => $request->response,
        ]);

        return back()->with('success', 'Response submitted successfully.');
    }

    public function closeTicket($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        // Authorization logic for closing the ticket can be added here

        $ticket->update(['status' => 'closed']);

        return back()->with('success', 'Ticket closed successfully.');
    }
}
