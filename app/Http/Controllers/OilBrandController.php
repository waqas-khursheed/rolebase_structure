<?php

namespace App\Http\Controllers;

use App\OilBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OilBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oilbrand = OilBrand::all();
        return view('pages.product.oilbrand',compact('oilbrand'));
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
            'oilbrand_name' => 'required|unique:oil_brands',
            'image' => 'required'
        ], [
            'oilbrand_name.required' => 'Oil Brand Name is required',
            'image.required' => 'Image is required'
        ]);

        $oilbrand = new OilBrand();
        $oilbrand->oilbrand_name = $request->oilbrand_name;

        $file = $request->file('image') ;
        $fileName = $file->getClientOriginalName() ;
        $name = Auth::user()->name.date('d-M-Y').$fileName ;
        $file->move('images/oilbrand/', $name);
        $oilbrand->oilbrand_image = 'images/oilbrand/'.$name;

        $oilbrand->save();
        return redirect()->back()->with('success', 'Successfully Oil Brand Add');
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
        $oilbrand = OilBrand::find($id);
        $oilbrand->oilbrand_name = $request->oilbrand_name;
        if ($request->has('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y').$fileName ;
            $file->move('images/oilbrand/', $name);
            $oilbrand->oilbrand_image = 'images/oilbrand/'.$name;
        }
        $oilbrand->update();
        return redirect()->back()->with('success', 'Successfully Oil Brand Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OilBrand::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
