<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('users.index');
    }

    public function timepiece()
    {
        return view('users.timepiece');
    }

    public function addres()
    {
        return view('profile.address', [
            'user' => User::find(Auth::user()->id),
        ]);
    }

    public function updateAddress(Request $request)
    {
        // dd($request);/
        $validated = $request->validate([
            'alamat' => 'required'
        ]);

        $update_address = User::where([
            'id' => Auth::user()->id,
        ])->update([
            'alamat' => $validated['alamat']
        ]);

        if ($update_address) {

            return redirect()->back()->with('success', 'Address updated successfully');
        } else {
            return redirect()->back()->with('failed', 'Address updated failed');
        }
    }

    public function order(Request $request)
    {
        if ($request->type == "all") {
            $all_order = Order::select('tbl_order.*')
                ->with('detail_order:order_id,tbl_order_detail.quantity,tbl_products.name as name_product,tbl_products.price,tbl_products_image.image')
                ->where('tbl_order.user_id', Auth::user()->id)
                ->get();
            // dd($all_order->detail);
            // foreach($order_->detail_order as $o){
            //     $detail_order = $o;
            // }
            // dd($all_order);
            return view('profile.order', [
                'order' => $all_order,
                // 'detail_order' => $detail_order
            ]);
        } else if ($request->type == "to-pay") {
            $all_order = Order::select('tbl_order.*')
                ->with('detail_order:order_id,tbl_order_detail.quantity,tbl_products.name as name_product,tbl_products.price,tbl_products_image.image')
                ->where('tbl_order.user_id', Auth::user()->id)
                ->where('tbl_order.processed', 0)
                ->get();
            // dd($all_order->detail);
            // foreach($order_->detail_order as $o){
            //     $detail_order = $o;
            // }
            // dd($all_order);
            return view('profile.order', [
                'order' => $all_order,
                // 'detail_order' => $detail_order
            ]);
        }
        $all_order = Order::select('tbl_order.*')
            ->with('detail_order:order_id,tbl_order_detail.quantity,tbl_products.name as name_product,tbl_products.price,tbl_products_image.image')
            ->where('tbl_order.user_id', Auth::user()->id)
            ->get();
        // dd($all_order->detail);
        // foreach($order_->detail_order as $o){
        //     $detail_order = $o;
        // }
        // dd($all_order);
        return view('profile.order', [
            'order' => $all_order,
            // 'detail_order' => $detail_order
        ]);
    }
}
