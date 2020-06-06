<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\transaction_detail;
use App\Product;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Notifications\NotifyAdminProof;
use App\Notifications\NotifyUserStatus;
use App\Notifications\NotifyUserDelivered;

class TransactionController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions['transactions'] = Transaction::orderby('id','desc')->paginate(5);
        return view('transaction.home', $transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function show($id)
    {
        $transactions = Transaction::where('id', $id)->get();
        return view('transaction.show', compact('transactions'));
    }

    public function changeStatus(Request $request){
        $transaction = Transaction::find($request->transaction_id);
        $user = User::where('id', $transaction->user_id)->first();

        $transaction->status = $request->status;
        $transaction->save();

        if($request->status == "canceled"){
            $user->notify(new NotifyUserStatus($transaction->id));
            /*return redirect('/transaksi/detail/'.$request->id);*/
            return redirect('/transactions');

        }elseif($request->status == "verified"){
            $transaction_detail = transaction_detail::where('transaction_id', $transaction->id)->get();
            foreach($transaction_detail as $item){
                $produk = Product::find($item->product_id);
                $produk->stock = $produk->stock - $item->qty;
                $produk->save();
            }
            $user->notify(new NotifyUserStatus($transaction->id));
            return redirect('/transactions');

        }elseif($request->status == "success"){
            $user->notify(new NotifyUserStatus($transaction->id));
            return redirect('/transactions');

        }elseif($request->status == "delivered"){
            $user->notify(new NotifyUserDelivered($transaction->id));
            return redirect('/transactions');
        }elseif($request->status == "expired"){
            $user->notify(new NotifyUserDelivered($transaction->id));
            return redirect('/transactions');
        }elseif($request->status == "unverified"){
            $user->notify(new NotifyUserDelivered($transaction->id));
            return redirect('/transactions');
        }else{
            return redirect('/transactions');
        }
    }
}
