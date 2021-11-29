<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = DB::table('brands')
        ->select(
            'brands.id',
            'brands.brand_name',
            'brands.brand_image'
            )
        ->get();
        return view('pages.car.brand',compact('brand'));
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
            'brand_name' => 'required|unique:brands',
            'image' => 'required',
        ], [
            'brand_name.required' => 'brand Name is required',
            'image.required' => 'image is required',
        ]);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;

        $file = $request->file('image') ;
        $fileName = $file->getClientOriginalName() ;
        $name = Auth::user()->name.date('d-M-Y').$fileName ;
        $file->move('images/brand/', $name);
        $brand->brand_image = 'images/brand/'.$name;
        
        $brand->save();
        return redirect()->back()->with('success', 'Successfully Brand Add');
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
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        if ($request->has('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y').$fileName ;
            $file->move('images/brand/', $name);
            $brand->brand_image = 'images/brand/'.$name;
        }
        $brand->update();
        return redirect()->back()->with('success', 'Successfully Brand Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
