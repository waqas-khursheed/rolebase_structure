<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductCategory;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productcategory = ProductCategory::all();
        return view('pages.product.productcategory',compact('productcategory'));
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
        $request->validate([
            'productcategory_name' => 'required|unique:product_categories',
        ], [
            'productcategory_name.required' => 'Product Category is required',
        ]);

        $productcat = new ProductCategory();
        $productcat->productcategory_name = $request->productcategory_name;
        $productcat->save();
        return redirect()->back()->with('success', 'Successfully Product Category Add');
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
        $productcat = ProductCategory::find($id);
        $productcat->productcategory_name = $request->productcategory_name;
        $productcat->update();
        return redirect()->back()->with('success', 'Successfully Product Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
