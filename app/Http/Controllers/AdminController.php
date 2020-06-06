<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transaction_per_month['transactions_per_month'] = DB::select("SELECT COUNT(id) as jumlah, SUM(total) as pendapatan, MONTH(updated_at) as bulan FROM transactions 
            WHERE status != 'canceled' 
            OR status != 'expired'
            OR status != 'unverified'
            GROUP BY MONTH(updated_at)
        ");

        $transaction_per_year['transactions_per_year'] = DB::select("SELECT COUNT(id) as jumlah, SUM(total) as pendapatan, YEAR(updated_at) as tahun FROM transactions 
            WHERE status != 'canceled' 
            OR status != 'expired'
            OR status != 'unverified'
            GROUP BY YEAR(updated_at)
        ");

        return view('admin.home', $transaction_per_month, $transaction_per_year);
    }

    public function ShowAdminNotification(){
        return view('admin.notification');
    }

    public function MarkAdminNotification($id){
        Auth::guard('admin')->user()->unReadNotifications->where('id', $id)->markAsRead();
        return redirect('/admin/notif');
    }

    public function MarkAdminAll(){
        $admin = Admin::find(1);
        dd($admin);
        foreach($admin->unReadNotifications as $notification){
            $notification->markAsRead();
        }
        redirect()->back();
    }

    public function adminNotifyIndex($id, $id2){
        $transaksi = transaction::with(['transaction_detail' => function($q){
            $q->with(['product' => function($qq){
                $qq->with('product_image');
            }]);
        }, 'courier'])->find($id);

        if(is_null(Auth::guard('admin')->user())){
            return abort(404);
        }else{
            Auth::guard('admin')->user()->unReadNotifications->where('id', $id2)->markAsRead();
            return view('auth.admin.detail_transaksi',['transaksi' => $transaksi]);
        }   
    }

    public function chart(){
        $result = \DB::select("SELECT COUNT(id) as jumlah, SUM(total) as pendapatan, MONTH(updated_at) as bulan FROM transactions 
            WHERE status != 'canceled' 
            OR status != 'expired'
            OR status != 'unverified'
            GROUP BY MONTH(updated_at)
        ");
        return response()->json($result);
    }

    public function chartperYear(){
        $result = \DB::select("SELECT COUNT(id) as jumlahYear, SUM(total) as pendapatanYear, YEAR(updated_at) as tahun FROM transactions 
            WHERE status != 'canceled' 
            OR status != 'expired'
            OR status != 'unverified'
            GROUP BY YEAR(updated_at)
        ");
        return response()->json($result);
    }
}
