<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;

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

        $transaction->status = $request->status;
        $transaction->save();

        return redirect('/transactions');
    }
}
