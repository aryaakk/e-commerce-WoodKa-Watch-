<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = ShoppingCart::select('tbl_shopping_cart.*')
            ->with('product:tbl_products.id,tbl_products.name,tbl_products.stock,tbl_products.price,tbl_categories.name as name_category,tbl_products_image.image')
            ->get();
        foreach($cart as $cartItem){
            $cartProduct = $cartItem;
        }
        return view('users.cartdisplay', [
            'carts' => $cart
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        // dd($validated['product_id']);
        $cart = ShoppingCart::where('product_id', $validated['product_id'])->get();
        foreach($cart as $cartItem){
            $cartProduct = $cartItem;
        }
        // dd($cartProduct->quantity + $validated['quantity']);
        if (count(ShoppingCart::where('product_id', $validated['product_id'])->get()) == null) {
            $create_cartproduct = ShoppingCart::create($validated);
            if ($create_cartproduct) {
                return redirect()->back()->with('success', 'Product Succesfully Added to Cart Shopping');
            } else {
                return redirect()->back()->with('failed', 'Product Failed Added to Cart Shopping, Try Again!!');
            }
        } else {
            $cartProduct->quantity = $cartProduct->quantity + $validated['quantity'];
            $cartProduct->save();
            if ($cartProduct) {
                return redirect()->back()->with('success', 'Product Succesfully Added to Cart Shopping');
            } else {
                return redirect()->back()->with('failed', 'Product Failed Added to Cart Shopping, Try Again!!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showCheckoutDetail(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'cart_id' => 'required', 'array',
            'product_id' => 'required', 'array',
            'total_price' => 'required',
        ]);
        $cek_stock_product = Product::find($validated['product_id']);
        // dd($cek_stock_product);
        foreach ($cek_stock_product as $cek_stock) {
            if (!$cek_stock->stock > 0) {
                return redirect()->back()->with('failed', 'Product is out of stock');
            }
        }
        // dd($validated['cart_id']);
        $cart = [];
        foreach ($validated['cart_id'] as $cart_id) {
            // dd($cart_id);
            $cart[] = ShoppingCart::select('tbl_shopping_cart.*')
                ->with('product:tbl_products.id,tbl_products.name,tbl_products.stock,tbl_products.price,tbl_categories.name as name_category,tbl_products_image.image')
                ->where('tbl_shopping_cart.id', $cart_id)
                ->get();
            // dd($cart);
        }
        $user = User::find($request->user_id);
        return view('users.showCheckoutDetail', [
            'user' => $user,
            'cart' => $cart,
            'totalPrice' => $validated['total_price'],
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
        // dd($request->quantity);
        if ($request->quantity == 'plus') {
            $cek_stock = Product::find($request->product_id);
            $getCart = ShoppingCart::find($id);
            $getCart->quantity = $getCart->quantity + 1;
            if ($getCart->quantity > $cek_stock->stock) {
                return redirect()->route('cart.index')->with('failed', 'Product stock has exceeded the limit');
            } else {
                $getCart->save();
                return redirect()->route('cart.index')->with('success', 'Quantity Product Success to Add');
            }
        } else if ($request->quantity == 'reduce') {
            $getCart = ShoppingCart::find($id);
            if ($getCart->quantity > 1) {
                $getCart->quantity = $getCart->quantity - 1;
                $getCart->save();
                return redirect()->route('cart.index')->with('success', 'Quantity Product Success to Add');
            }
            return redirect()->route('cart.index')->with('success', 'Quantity Product Success to Add');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletecart = ShoppingCart::find($id)->delete();
        return redirect()->route('cart.index');
    }
}
