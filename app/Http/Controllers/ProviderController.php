<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Provider;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = Provider::all();
        return view('pages.provider.index',compact('provider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('pages.provider.create');
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
            'provider_name' => 'required',
            'provider_image' => 'required',
            'provider_address' => 'required',
            'provider_email' => 'required|email|unique:providers',
            'provider_password' => 'required',
            'provider_phone' => 'required|numeric|unique:providers',
        ], [
            'provider_name.required' => 'Provider Name is required',
            'provider_image.required' => 'Provider image is required',
            'provider_address.required' => 'Provider Address is required',
            'provider_email.required' => 'Provider Email is required',
            'provider_password.required' => 'Provider Password is required',
            'provider_phone.required' => 'Provider Phone is required',
        ]);
        $provider = new Provider();
        $provider->provider_name = $request->provider_name;
        $provider->provider_email = $request->provider_email;
        $provider->provider_address = $request->provider_address;
        $provider->provider_status = 1;
        $provider->provider_password = Hash::make($request->provider_password);
        $provider->provider_phone = $request->provider_phone;
        
        $file = $request->file('provider_image') ;
        $fileName = $file->getClientOriginalName() ;
        $name = Auth::user()->name.date('d-m-Y s').$fileName;
        $file->move('images/provider/',$name);
        $provider->provider_image = 'images/provider/'.$name;
        
        $provider->save();
        return redirect()->back()->with('success', 'Successfully Provider Add');
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
        $provider = Provider::find($id);
        $provider->provider_name = $request->provider_name;
        $provider->provider_email = $request->provider_email;
        $provider->provider_address = $request->provider_address;
        $provider->provider_status = 1;

        $provider->provider_password = Hash::make($request->provider_password);

        $provider->provider_phone = $request->provider_phone;

        if ($request->has('provider_image')) {
            $file = $request->file('provider_image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y s').$fileName;
            $file->move('images/provider/', $name);
            $provider->provider_image = 'images/provider/'.$name;
        }
        $provider->update();
        return redirect()->back()->with('success','Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Provider::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }


    //provder Satatus
    public function providerstatus($id){
        $pro = Provider::find($id);
        $pro->provider_status = ($pro->provider_status == 1)? 0 : 1;
        $pro->update();
        return redirect()->back()->with('success','Status Updated');
    }
}
