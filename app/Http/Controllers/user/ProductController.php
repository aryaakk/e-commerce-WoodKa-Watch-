<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::select('tbl_products.*', 'tbl_categories.name as category_name', 'tbl_categories.description as description_category')
            ->join('tbl_categories', 'tbl_categories.id', 'tbl_products.category_id')
            ->with('product_image:product_id,image,is_primary')
            ->with('category:tbl_categories.id,tbl_categories.name as name_category')
            ->when($request->has('categories') && $request->categories != 'all', function ($query) use ($request) {
                $query->where('tbl_products.category_id', $request->categories);
            })
            ->where('tbl_products.is_active', 1)
            ->when($request->search, function ($query) use ($request) {
                return $query->where('tbl_products.name' , 'LIKE', '%'.$request->search.'%')
                    ->orWhere('tbl_products.description','LIKE', '%'.$request->search.'%')
                    ->orWhere('tbl_categories.name','LIKE', '%'.$request->search.'%')  
                    ->orWhere('tbl_categories.description','LIKE', '%'.$request->search.'%');  
            })
            ->paginate(20);
        $category = Category::all();
        return view('users.explore', [
            'product' => $product,
            'category' => $category
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timepiece(Request $request)
    {
        $timepiece_product = Product::select('tbl_products.*')
            ->with('product_image:product_id,image,is_primary')
            ->with('category:tbl_categories.id,tbl_categories.name as name_category')
            ->when($request->has('categories') && $request->categories != 'all', function ($query) use ($request) {
                $query->where('tbl_products.category_id', $request->categories);
            })
            ->where('tbl_products.sku', 'LIKE', 'tp%')
            ->where('tbl_products.is_active', 1)
            ->paginate(20);
        // dd($timepiece_product);
        return view('users.timepiece', [
            'timepiece' => $timepiece_product
        ]);
    }
    public function straps(Request $request)
    {
        $straps_product = Product::select('tbl_products.*')
            ->with('product_image:product_id,image,is_primary')
            ->with('category:tbl_categories.id,tbl_categories.name as name_category')
            ->when($request->has('categories') && $request->categories != 'all', function ($query) use ($request) {
                $query->where('tbl_products.category_id', $request->categories);
            })
            ->where('tbl_products.sku', 'LIKE', 'stp%')
            ->where('tbl_products.is_active', 1)
            ->paginate(20);
        // dd($timepiece_product);
        return view('users.straps', [
            'straps' => $straps_product
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name, $id)
    {
        $timepiece_product = Product::select('tbl_products.*')
            ->with('product_image_detail:product_id,image,is_primary')
            ->with('category:tbl_categories.id,tbl_categories.name as name_category')
            ->where('tbl_products.id', $id)
            ->get();
        foreach ($timepiece_product as $tp) {
            $timepiece = $tp;
            $category = $tp->category;
            $product_images = $tp->product_image_detail;
        }
        return view('users.detailproduct', [
            'title' => $name,
            'timepiece' => $timepiece,
            'category' => $category,
            'product_images' => $product_images
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
