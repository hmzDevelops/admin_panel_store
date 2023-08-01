<?php

namespace App\Models\Ticket;

use App\Models\User;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

protected $fillable = ['subject','status','seen','reference_id','user_id','category_id','priority_id','ticket_id','description'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class, 'reference_id');
    }


    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id');
    }

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'ticket_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'ticket_id')->with('children');
    }
}
