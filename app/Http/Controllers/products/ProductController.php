<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('tbl_products.*')
            ->with('category:tbl_categories.*')
            ->with('product_image:product_id,image')
            ->paginate(10);
        return view('admin.product.index', [
            'product' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'category' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'max:10'],
            'unit' => ['required', 'string', 'max:20'],
            'weight' => ['required', 'max:20'],
            'price' => ['required', 'max:20'],
            'category_id' => ['required'],
            'description' => ['required', 'string'],
        ]);
        // dd($validated);
        $product = Product::create($validated);
        if ($product) {
            return Redirect::route('product.index')->with('success', 'Product Successfully Added');
        } else {
            return Redirect::route('product.index')->with('failed', 'Product Failed Added');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        return view('admin.product.edit', [
            'category' => Category::all(),
            'product' => Product::find($id)
        ]);
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'max:10'],
            'unit' => ['required', 'string', 'max:20'],
            'weight' => ['required', 'max:20'],
            'price' => ['required', 'max:20'],
            'category_id' => ['required'],
            'is_active' => ['required'],
            'description' => ['required', 'string'],
        ]);
        // dd($validated);
        $product = Product::find($id)->update($validated);
        if ($product) {
            return Redirect::route('product.index')->with('success', 'Product Successfully Updated');
        } else {
            return Redirect::route('product.index')->with('failed', 'Product Failed Updated');
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
        // dd($id)
        if (ProductImage::where('product_id', $id) != null) {
            ProductImage::where('product_id', $id)->delete();
            $product = Product::find($id)->delete();
        } else {
            $product = Product::find($id)->delete();
        }
        // dd($cate->status());
        if ($product) {
            // return back()->with('status', 'password-updated');
            return redirect()->route('product.index')->with('success', 'Product has been deleted!');
        } else {
            return redirect()->route('product.index')->with('failed', 'Product has not been deleted!');
        }
    }
}
