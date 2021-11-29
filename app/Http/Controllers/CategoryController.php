<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Category = Category::all();
        return view('pages.car.category',compact('Category'));
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
            'category_name' => 'required|unique:categories',
            'image' => 'required'

        ], [

            'category_name.required' => 'Category Name is required',
            'image.required' => 'Image is required'
        ]);

        $cat = new Category();
            $cat->category_name = $request->category_name;

            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y').$fileName ;
            $file->move('images/category/', $name);
            
            $cat->category_image = 'images/category/'.$name;
       
             $cat->save();
     
        return redirect()->back()->with('success', 'Successfully Category Add');

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
            $cat = Category::find($id);
            $cat->category_name = $request->category_name;

            if ($request->has('image')) {
                $file = $request->file('image') ;
                $fileName = $file->getClientOriginalName();
                $name = Auth::user()->name.date('d-M-Y').$fileName;
                $file->move('images/category/', $name);
                $cat->category_image = 'images/category/'.$name;
            }
            $cat->update();
        
            return redirect()->back()->with('success', 'Successfully Category Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
