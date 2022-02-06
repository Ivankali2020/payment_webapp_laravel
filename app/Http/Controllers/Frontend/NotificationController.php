<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Notifications\GeneralNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index(){
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(5);
        return view('Frontend.notifications.index',compact('notifications'));
    }

    public function detail($id){
        $user = Auth::user();
//        $notification_read_at = $user->notifications->where('id',$id)->first();
//        $notification_read_at->read_at = '1';
//        $notification_read_at->update();
        $notification = $user->notifications->where('id',$id)->first();
        $notification->markAsRead();
        return view('Frontend.notifications.detail',compact('notification'));
    }
}
