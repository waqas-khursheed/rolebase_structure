<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PromotionBanner;
use Illuminate\Support\Facades\Auth;
class PromotionBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotionBanner = PromotionBanner::all();
        return view('pages.promotionbanner.index', compact('promotionBanner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.promotionbanner.create');
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
            'name' => 'required',
            'image' => 'required|image',
        ],[
            'name|required' => 'name is required',
            'image|required' => 'image is required',
        ]);
        $promotionBanner = new PromotionBanner();
        $promotionBanner->name = $request->name;

        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $name = Auth::user()->name.date('d-M-Y').$fileName;
        $file->move('images/promotionbanner/',$name);
        $promotionBanner->image = 'images/promotionbanner/'.$name;
        $promotionBanner->save();
        return redirect()->back()->with('success',"Promotion Banner Add Successfully");


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
        $promotionBanner = PromotionBanner::find($id);
        $promotionBanner->name = $request->name;

        if ($request->has('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName();
            $name = Auth::user()->name.date('d-M-Y').$fileName;
            $file->move('images/promotionbanner/',$name);
            $promotionBanner->image = 'images/promotionbanner/'.$name;
        }
        $promotionBanner->update();
        return redirect()->back()->with('success',"Promotion Banner Update Successfully");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        PromotionBanner::find ($id)->delete();
        return redirect()->back()->with('success', "Promotion Banner Delete Successfully");
        */

        $PromotionBanner = PromotionBanner::where('id',$id)->first();

        if ($PromotionBanner != null) {
            $PromotionBanner->delete();
            return redirect()->back()->with('success', "Promotion Banner Deleted Successfully");

        }
        return redirect()->back()->with('error', "Wrong ID!!");
    }
}
