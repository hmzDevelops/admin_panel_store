<?php

namespace App\Http\Controllers\Admin\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;

class TicketController extends Controller
{

    //تیکت جدید
    public function newTicket(){
        $tickets = Ticket::where('seen', 0)->get();
        foreach($tickets as $ticket){
            $ticket->seen = 1;
            $ticket->save();
        }
        $ticketPageTitle = "تیکت جدید";
        return view('admin.ticket.index', compact('tickets', 'ticketPageTitle'));
    }

    //تیکت های باز بر اساس فیلد استاتوس
    public function openTicket(){
        $tickets = Ticket::where('status', 0)->get();
        $ticketPageTitle = "تیکت های باز";
        return view('admin.ticket.index', compact('tickets','ticketPageTitle'));
    }

    //تیکت های بسته بر اساس فیلد استاتوس
    public function closeTicket(){
        $tickets = Ticket::where('status', 1)->get();
        $ticketPageTitle = "تیکت های بسته";
        return view('admin.ticket.index',compact('tickets','ticketPageTitle'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        $ticketPageTitle = "کلیه تیکت ها";
        return view('admin.ticket.index', compact('tickets','ticketPageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function show(Ticket $ticket){

        return view('admin.ticket.show', compact('ticket'));
     }



     public function answer(TicketRequest $request,Ticket $ticket){
        $inputs = $request->all();

        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['seen'] = 1;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = 3;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;


        Ticket::create($inputs);
        return redirect()->route('admin.ticket.index')->with('swal-success', 'پاسخ شما با موفقیت ثبت گردید');
     }


    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 0 ? 1 : 0;
        $result = $ticket->save();

        if ($result) {
            if ($ticket->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
