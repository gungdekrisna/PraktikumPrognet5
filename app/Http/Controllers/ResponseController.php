<?php

namespace App\Http\Controllers;

use App\Product_Review;
use App\Response;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
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
        $product_review['product_review'] = Product_Review::orderby('id','desc')->paginate(5);
        return view('response.home', $product_review);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $product_review = Product_Review::where('id', $id)->get();
        $response = Response::where('review_id', $id)->get();
        return view('response.show', compact('product_review', 'response'));
    }

    public function giveResponse(Request $request){
        $response = new Response();

        $response->review_id = $request->review_id;
        $response->admin_id = $request->admin_id;
        $response->content = $request->content;
        $response->save();

        return redirect('/response');
    }
}
