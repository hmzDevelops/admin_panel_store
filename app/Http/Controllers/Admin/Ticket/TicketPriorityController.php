<?php

namespace App\Http\Controllers\Admin\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketPriority;
use App\Http\Requests\Admin\Ticket\TicketPriorityRequest;

class TicketPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketPrioritys = TicketPriority::orderBy('id', 'DESC')->get();
        return view('admin.ticket.priority.index', compact('ticketPrioritys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticket.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketPriorityRequest $request)
    {
        $inputs = $request->all();
        $ticketPriority = TicketPriority::create($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', ' اولویت بندی جدید شما با موفقیت ثبت گردید');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketPriority $ticketPriority)
    {
        return view('admin.ticket.priority.edit', compact('ticketPriority'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketPriorityRequest $request, TicketPriority $ticketPriority)
    {
        $inputs = $request->all();
        $ticketPriority->update($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'ویرایش اولویت شما با موفقیت ثبت گردید');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketPriority $ticketPriority)
    {
        $ticketPriority->delete();
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'حذف  اولویت شما با موفقیت ثبت گردید');
    }

    public function status(TicketPriority $ticketPriority)
    {
        $ticketPriority->status = $ticketPriority->status == 0 ? 1 : 0;
        $result = $ticketPriority->save();

        if ($result) {
            if ($ticketPriority->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
