<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

date_default_timezone_set('asia/jakarta');

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.productImage.index', [
            'image' => ProductImage::select('tbl_products_image.*', 'tbl_products.id as id_product', 'tbl_products.name', 'tbl_products.description')
                ->join('tbl_products', 'tbl_products.id', 'tbl_products_image.product_id')
                ->where('tbl_products_image.is_primary', 1)
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productImage.create', [
            'product' => Product::all(),
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
            'product_id' => ['required'],
            'image' => ['required', 'array'],
            'is_primary' => ['required', 'array']
        ]);
        // dd($validated['product_id']);
        try {
            DB::transaction(function () use ($validated, $request) {
                $insert = [];
                $a = 0; 
                foreach ($request->file('image') as $image) {
                    $name = md5($image->getClientOriginalName()) . "_" . $image->getClientOriginalName();
                    $image->move(public_path() . '/imageProduct/', $name);
                    $insert[] = [
                        'product_id' => $validated['product_id'],
                        'image' => $name,
                        'is_primary' => $request->is_primary[$a],
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $a++;
                }
                ProductImage::insert($insert);
            });
            return Redirect::route('image.index')->with('success', 'Product Image Successfully Uploaded');
        } catch (\Throwable $th) {
            throw $th;
            return Redirect::route('image.index')->with('failed', 'Product Image Failed Uploaded');
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
        return view('admin.productImage.show', [
            'image' => ProductImage::select('tbl_products_image.*', 'tbl_products.id as id_product', 'tbl_products.name', 'tbl_products.description')
                ->join('tbl_products', 'tbl_products.id', 'tbl_products_image.product_id')
                ->where('tbl_products_image.product_id', $id)
                ->paginate(10),
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
        return view('admin.productImage.edit', [
            'image' => ProductImage::find($id),
            'product' => Product::all()
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
        // dd($request->IdImage);
        if ($request->primary == 'setPrimary') {
            ProductImage::where('is_primary', 1)
                ->where('product_id', $id)
                ->update([
                    'is_primary' => 0
                ]);
            $idImage = $request->IdImage;
            // $getIdImage = ProductImage::where('product_id', $id)->where('id', $idImage)->get();
            // dd($getIdImage);
            $updatePrimary = ProductImage::find($idImage)->update([
                'is_primary' => 1
            ]);
            if ($updatePrimary) {
                return Redirect::route('image.show', $id)->with('success', 'Product Image Successfully Set To Primary');
            } else {
                return Redirect::route('image.show', $id)->with('failed', 'Product Image Failed Set To Primary');
            }
        }
        $validated = $request->validate([
            'product_id' => ['required'],
            'is_primary' => ['required', 'boolean'],
        ]);
        if ($request->hasFile('image')) {
            $imageBefore = ProductImage::find($id);
            $file = $request->file('image');
            $name = md5($file->getClientOriginalName()) . "_" . $file->getClientOriginalName();
            $file->move(public_path() . '/imageProduct/', $name);
            $unlnkImage = unlink(public_path() . '/imageProduct/' . $imageBefore->image);
            $update = $imageBefore->update([
                'product_id' => $validated['product_id'],
                'image' => $name,
                'is_primary' => $validated['is_primary']
            ]);
            if ($update) {
                return Redirect::route('image.show', $validated['product_id'])->with('success', 'Product Image Successfully Updated');
            } else {
                return Redirect::route('image.show', $validated['product_id'])->with('failed', 'Product Image Failed Updated');
            }
        } else {
            $imageUpdate = ProductImage::find($id);
            $update = $imageUpdate->update([
                'product_id' => $validated['product_id'],
                'is_primary' => $validated['is_primary']
            ]);
            if ($update) {
                return Redirect::route('image.show', $validated['product_id'])->with('success', 'Product Image Successfully Updated');
            } else {
                return Redirect::route('image.show', $validated['product_id'])->with('failed', 'Product Image Failed Updated');
            }
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
        $imageDelete = ProductImage::find($id);
        $deleteStorage = unlink(public_path() . '/imageProduct/' . $imageDelete->image);
        if ($deleteStorage) {
            $imageDelete->delete();
            return Redirect::route('image.index')->with('success', 'Product Image Successfully Delete');
        }else{
            return Redirect::route('image.show', $imageDelete->product_id)->with('success', 'Product Image Failed Delete');
        }
    }
}
