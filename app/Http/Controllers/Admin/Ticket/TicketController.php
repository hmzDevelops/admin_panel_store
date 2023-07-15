<?php

namespace App\Http\Controllers\admin\ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function newTicket(){
        return view('admin.ticket.index');
    }

    public function openTicket(){
        return view('admin.ticket.index');
    }

    public function closeTicket(){
        return view('admin.ticket.index');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticket.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('admin.ticket.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('admin.ticket.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
