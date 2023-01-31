<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('asia/jakarta');

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'cart_id' => 'required', 'array',
            'product_id' => 'required', 'array',
            'total_price' => 'required',
            'delivery_addres' => 'required',
        ]);

        try {
            $create_order = Order::create([
                'user_id' => Auth::user()->id,
                'total_price' => $validated['total_price'],
                'delivery_addres' => $validated['delivery_addres']
            ]);

            $detail_order = [];
            foreach ($validated['cart_id'] as $cart_id) {
                $data_cart = ShoppingCart::select('tbl_shopping_cart.*')
                    ->with('product:tbl_products.id,tbl_products.name,tbl_products.stock,tbl_products.price,tbl_categories.name as name_category,tbl_products_image.image')
                    ->where('tbl_shopping_cart.id', $cart_id)
                    ->first();
                // dd($data_cart);
                $detail_order[] = [
                    'order_id' => $create_order->id,
                    'product_id' => $data_cart->product->id,
                    'quantity' => $data_cart->quantity,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                OrderDetail::insert($detail_order);
                ShoppingCart::find($cart_id)->delete();
                // Set your Merchant Server Key
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = false;
                // Set sanitization on (default)
                \Midtrans\Config::$isSanitized = true;
                // Set 3DS transaction for credit card to true
                \Midtrans\Config::$is3ds = true;

                $params = array(
                    'transaction_details' => array(
                        'order_id' => $create_order->id,
                        'gross_amount' => $validated['total_price'],
                    ),
                    'customer_details' => array(
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'phone' => Auth::user()->phone,
                    ),
                );

                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $create_order->update([
                    'token' => $snapToken,
                    'processed' => 0
                ]);
                Product::find($data_cart->product->id)->update([
                    'stock' => $data_cart->product->stock - $data_cart->quantity
                ]);
                // die(var_dump($snapToken));
            }
            // dd($create_order);

            return redirect()->route('order.show', $create_order->id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function payment(Request $request)
    {
        // dd($request->all());
        $order = Order::find($request->order_id);

        $hash  = hash("sha512", @$order->id . $request->status_code . number_format($request->gross_amount, 2, '.', '') .   ''.config('midtrans.server_key').'');
        // dd($hash);

        abort_if($hash != $request->signature_key, 422, 'Invalid!'); //validating request
        // $order->update($request->only('transaction_time', 'transaction_status', 'settlement_time', 'payment_type'));
        $order->update([
            'transaction_time' => $request->transaction_time,
            'transaction_status' => $request->transaction_status,
            'settlement_time' => $request->settlement_time,
            'payment_type' => $request->payment_type
        ]);
        $order->update(['processed' => true, 'delivery_status' => 'dikemas']); //set processed true
        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $order = Order::select('tbl_order.*', 'users.name as name_user', 'users.email')
            ->join('users', 'users.id', 'tbl_order.user_id')
            ->with('detail:order_id,product_id')
            ->where('tbl_order.id', $id)
            ->get();
        foreach($order as $o){
            $order__ = $o;
        }
        // $date_order = date('Y-m-d H:i:s', strtotime($order__->created_at));
        $date_payment = $order__->created_at;
        $limit_date = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($date_payment)));
        // dd($limit_date, $date_order);
        // dd($order__->created_at);
        return view('users.payment', [
            'order' => $order__,
            'limit_date' => $limit_date,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
