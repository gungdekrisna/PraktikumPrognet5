<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
   public function baca($id){
       $admin = Admin::find($id);
       $admin->unReadNotifications->markAsRead();
       return redirect('/admin/notif');
   }
}
