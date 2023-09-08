<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Ticket\TicketAdmin;
use App\Http\Controllers\Controller;

class TicketAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::orderBy('id', 'DESC')->get();
        return view('admin.ticket.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function set(User $admin)
    {
        $admins = TicketAdmin::where('user_id', $admin->id)->first() ? TicketAdmin::where('user_id', $admin->id)->forceDelete() : TicketAdmin::create(['user_id' => $admin->id]);

        return redirect()->route('admin.ticket.admin.index')->with('swal-success', '  تغییر شما با موفقیت ثبت گردید');
    }
}
