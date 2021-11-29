<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $subcategory = SubCategory::all();
        return view('pages.car.subcategory',compact('category', 'subcategory'));
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
            'category' => 'required',
            'subcategory_name' => 'required|unique:sub_categories',
            'image' => 'required',
        ], [
            'category.required' => 'Select category',
            'subcategory_name.required' => 'Category Name is required',
            'image.required' => 'Image is required',
        ]);

        $subcat = new SubCategory();
        $subcat->category_id = $request->category;
        $subcat->subcategory_name = $request->subcategory_name;

        $file = $request->file('image') ;
        $fileName = $file->getClientOriginalName() ;
        $name = Auth::user()->name.date('d-M-Y').$fileName ;
        $file->move('images/subcategory/', $name);
        $subcat->subcategory_image = 'images/subcategory/'.$name;

        $subcat->save();

        return redirect()->back()->with('success', 'Successfully SubCategory Add');
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
        $subcat = SubCategory::find($id);
        $subcat->category_id = $request->category;
        $subcat->subcategory_name = $request->subcategory_name;
        if ($request->has('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y').$fileName ;
            $file->move('images/subcategory/', $name);
            $subcat->subcategory_image = 'images/subcategory/'.$name;
        }
        $subcat->update();
        return redirect()->back()->with('success', 'Successfully SubCategory Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
