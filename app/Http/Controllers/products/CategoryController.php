<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', [
            'category' => Category::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'max:255'],
        ]);
        $insert = Category::create($validated);
        if ($insert) {
            return Redirect::route('category.index')->with('success', 'Category Successfully Added');
        } else {
            return Redirect::route('category.index')->with('failed', 'Category Failed Added');
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
        return view('admin.category.edit', [
            'category' => Category::find($id)
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
            'description' => ['required', 'string'],
        ]);

        $update = Category::find($id)->update($validated);
        if ($update) {
            return Redirect::route('category.index')->with('success', 'Category Successfully Updated');
        } else {
            return Redirect::route('category.index')->with('failed', 'Category Failed Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $cate = Category::find($id)->delete();
        // dd($cate->status());
        if ($cate) {
            // return back()->with('status', 'password-updated');
            return redirect()->route('category.index')->with('success', 'Category has been deleted!');
        } else {
            return redirect()->route('category.index')->with('failed', 'Category has not been deleted!');
        }
    }
}
