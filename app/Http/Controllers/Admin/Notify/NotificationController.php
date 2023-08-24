<?php

namespace App\Http\Controllers\Admin\notify;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    //بروزرسانی جدول ناتیفیکیشن پس از مشاده هر ناتیفای
    public function readAll(){
        $notifications = Notification::all();

        foreach($notifications as $notification){
            if($notification->read_at == null){
                $notification->update(['read_at' => now()]);
            }
        }

    }
}
