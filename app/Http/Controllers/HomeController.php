<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Courier;
use App\Transaction;
use App\Transaction_detail;
use App\Cart;
use App\Response;
use App\Product_review;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product['products'] = Product::get();
        $product['image'] = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('product_images.*')->first();
        return view('user_page.home', $product);
    }

    public function product_detail($id){
        $where = array('products.id' => $id);
        $products['products'] = DB::table('products')
            ->join('product_category_details', 'products.id','=','product_category_details.product_id')
            ->join('product_categories', 'product_categories.id','=','product_category_details.category_id')
            ->select('products.*','product_categories.category_name')
            ->where($where)->first();
        $image = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('product_images.*')
            ->where($where)->first();
        $images = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('product_images.*')
            ->where($where)->get();
        $product_review = Product_review::where('product_id', $id)->get();
        $response = Response::get();

        return view('user_page.detail_product', compact('products', 'image', 'id', 'images', 'product_review', 'response'));
    }

    public function product_payment($id, $qty){        
        $provinces = $this->provinceAPI();
        $regencies = $this->regencyAPI();
        $product_qty = $qty;
        $couriers = Courier::get();

        $where = array('products.id' => $id);
        $products['products'] = DB::table('products')
            ->join('product_category_details', 'products.id','=','product_category_details.product_id')
            ->join('product_categories', 'product_categories.id','=','product_category_details.category_id')
            ->select('products.*','product_categories.category_name')
            ->where($where)->first();
        $image = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('product_images.*')
            ->where($where)->first();
        return view('user_page.product_payment', compact('products', 'image', 'id', 'provinces', 'product_qty', 'regencies', 'couriers'));
    }

    public function product_buy(Request $request){

        return redirect('/product/payment/courier-service/'.$request->regency.'/'.$request->courier_id.'/'.$request->product_id.'/'.$request->product_qty);
    }

    public function getShippingCost($destination, $courier, $product, $product_qty){
        /*Get Product*/
        $where = array('products.id' => $product);
        $products['products'] = DB::table('products')
            ->join('product_category_details', 'products.id','=','product_category_details.product_id')
            ->join('product_categories', 'product_categories.id','=','product_category_details.category_id')
            ->select('products.*','product_categories.category_name')
            ->where($where)->first();
        $image = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('product_images.*')
            ->where($where)->first();
        $couriers = Courier::where('courier_code', $courier)->get();
        $city = $this->getRegencybyCity($destination);
        $regency = $city->city_name;
        $province = $city->province;

        /*Get Shipping Cost*/
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=128&destination=".$destination."&weight=1700&courier=".$courier,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 6239c3687e279e23177952546ecf2507"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $outputObject = json_decode($response);
        $shippingCost = $outputObject->rajaongkir->results;

        return view('user_page.product_courier_service', compact('products', 'image', 'id', 'regency', 'province', 'product_qty','shippingCost', 'couriers', 'courier'));
    }

    public function TransactionStore(Request $request){

        $transaction = new Transaction();

        $transaction->id = $request->id;
        $transaction->timeout = $request->timeout;
        $transaction->address = $request->address;
        $transaction->regency = $request->regency;
        $transaction->province = $request->province;
        $total = $request->sub_total + $request->shipping_cost;
        $transaction->total = $total;
        $transaction->sub_total = $request->sub_total;
        $transaction->shipping_cost = $request->shipping_cost;
        $transaction->user_id = $request->user_id;
        $transaction->courier_id = $request->courier_id;
        $transaction->status = $request->status;
        $transaction->save();

        $t_detail = new Transaction_detail();

        $t_detail->id = $request->id;
        $t_detail->transaction_id = $transaction->id;
        $t_detail->product_id = $request->product_id;
        $t_detail->qty = $request->product_qty;
        $thisProducts = Product::where('id', $request->product_id)->get();
        foreach ($thisProducts as $thisProduct) {
            $selling_price = $thisProduct->price;
        }
        $t_detail->selling_price = $selling_price * $t_detail->qty;
        $t_detail->save();

        return redirect('/product/payment-confirmation/'.$transaction->id);
    }

    public function PaymentConfirmation($id){
        $transactions = Transaction::where('id', $id)->get();
        $transaction_details = Transaction_detail::where('transaction_id', $id)->get();

        foreach ($transactions as $transaction) {
            $thisCourier = $transaction->courier_id;
        }
        $couriers = Courier::where('id', $thisCourier)->get('courier');

        return view('user_page.payment_confirmation', compact('transactions', 'transaction_details', 'image', 'products', 'couriers'));
    }

    public function ProofOfPayment(Request $request){
       
        $transaction = Transaction::find($request->id);

        $resorce = $request->file('proof_of_payment');
        $name   = $resorce->getClientOriginalName();
        $resorce->move(\base_path() ."/public/images", $name);

        $transaction->proof_of_payment = $name;
        $transaction->save();
        return redirect('/product/payment-confirmation/'.$transaction->id);
    }

    public function getProvincebyCity($city_id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=".$city_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 6239c3687e279e23177952546ecf2507"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $outputObject = json_decode($response);
        $province_id = $outputObject->rajaongkir->results->province_id;
        return $province_id;
    }

    public function getRegencybyCity($city_id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=".$city_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 6239c3687e279e23177952546ecf2507"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $outputObject = json_decode($response);
        $regency = $outputObject->rajaongkir->results;
        return $regency;
    }

    public function provinceAPI(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 6239c3687e279e23177952546ecf2507"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        /*if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }*/

        $outputObject = json_decode($response);
        $provinces = $outputObject->rajaongkir->results;
        return $provinces;
    }

    public function regencyAPI(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 6239c3687e279e23177952546ecf2507"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $outputObject = json_decode($response);
        $regency = $outputObject->rajaongkir->results;
        return $regency;
    }

    public function myOrder($user_id){
        $transactions = Transaction::where('user_id', $user_id)->get();
        return view('user_page.myorder_list', compact('transactions'));
    }

    public function myOrderDetail($user_id, $id){
        $transaction_details = Transaction_detail::where('transaction_id', $id)->get();
        $transaction_id = $id;
        return view('user_page.myorder_detail', compact('transaction_details', 'transaction_id'));
    }

    public function cancelOrder($id){
        $transaction = Transaction::find($id);

        $transaction->status = "canceled";
        $transaction->save();
        return redirect('/myorder/'.$transaction->user_id);
    }

    public function insertCart($id, $qty, $user_id){
        $cart = new Cart();

        $cart->user_id = $user_id;
        $cart->product_id = $id;
        $cart->qty = $qty;
        $cart->status = "notyet";
        $cart->save();

        return redirect('/myCart/'.$user_id);
    }

    public function myCart($user_id){
        $carts = Cart::where('user_id', $user_id)->where('status', "notyet")->get();
        return view('user_page.mycart', compact('carts'));
    }

    public function cancelCart($id){
        $cart = Cart::find($id);

        $cart->status = "cancelled";
        $cart->save();
        return redirect('/myCart/'.$cart->user_id);
    }

    public function cartCheckOut($user_id){
      $provinces = $this->provinceAPI();
      $regencies = $this->regencyAPI();
      $couriers = Courier::get();
      $carts = Cart::where('user_id', $user_id)->where('status', "notyet")->get();

      return view('user_page.cart_payment', compact('carts', 'provinces', 'regencies', 'couriers'));
    }

    public function cart_buy(Request $request){

        return redirect('/cart/payment/courier-service/'.$request->regency.'/'.$request->courier_id.'/'.$request->user_id);
    }

     public function getShippingCostCart($destination, $courier, $user_id){
        /*Get Cart*/
        $carts = Cart::where('user_id', $user_id)->where('status', "notyet")->get();
        $weight = 0;
        foreach ($carts as $cart_row) {
          $weight = $weight + $cart_row->product->weight;
        }

        $couriers = Courier::where('courier_code', $courier)->get();
        $city = $this->getRegencybyCity($destination);
        $regency = $city->city_name;
        $province = $city->province;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=128&destination=".$destination."&weight=".$weight."&courier=".$courier,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 6239c3687e279e23177952546ecf2507"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $outputObject = json_decode($response);
        $shippingCost = $outputObject->rajaongkir->results;

        return view('user_page.cart_courier_service', compact('carts', 'regency', 'province','shippingCost', 'couriers', 'courier'));
    }

    public function CartTransactionStore(Request $request){

        $transaction = new Transaction();

        $transaction->id = $request->id;
        $transaction->timeout = $request->timeout;
        $transaction->address = $request->address;
        $transaction->regency = $request->regency;
        $transaction->province = $request->province;
        $total = $request->sub_total + $request->shipping_cost;
        $transaction->sub_total = $request->sub_total;
        $transaction->total = $total;
        $transaction->shipping_cost = $request->shipping_cost;
        $transaction->user_id = $request->user_id;
        $transaction->courier_id = $request->courier_id;
        $transaction->status = $request->status;
        $transaction->save();

        $carts = Cart::where('user_id', $request->user_id)->where('status', "notyet")->get();

        foreach ($carts as $cart_row) {
          echo "string gungkrisna";
          $thisProducts = Product::where('id', $cart_row->product_id)->get();
          foreach ($thisProducts as $thisProduct) {
              $price = $thisProduct->price;
          }
          $selling_price = $price * $cart_row->qty;

          $data = array('transaction_id' => $transaction->id, 'product_id' => $cart_row->product_id, 'qty' => $cart_row->qty, 'selling_price' => $selling_price);
          Transaction_detail::insert($data);

          $this->cartStatus($cart_row->id);
        }

        return redirect('/product/payment-confirmation/'.$transaction->id);
    }

    public function cartStatus($id){
        $cart = Cart::find($id);

        $cart->status = "checkedout";
        $cart->save();
    }

    // Review
    public function insertReview(Request $request){
        $product_review = new Product_review();

        $product_review->product_id = $request->product_id;
        $product_review->user_id = $request->user_id;
        $product_review->rate = $request->rate;
        $product_review->content = $request->content;
        $product_review->save();

        return redirect('/product/'.$request->product_id);
    }
}
