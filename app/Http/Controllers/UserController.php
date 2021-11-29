<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MobileCustomer;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = MobileCustomer::all();
        return view('pages.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
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
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ], [

            'name.required' => 'User Name is required',
            'email.required' => 'User Email is required',
            'password.required' => 'User Password is required',
        ]);

        $users = new MobileCustomer();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = md5($request->password);

        $users->save();
        return redirect()->back()->with('success',"User Add Successfully");
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
        $users = MobileCustomer::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->update();

        return redirect()->back()->with('success',"User Update Successfully");

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
        MobileCustomer::find($id)->delete();
        return redirect()->back()->with('success','User Delete Successfully');
        */

        $MobileCustomer = MobileCustomer::where('id',$id)->first();

        if ($MobileCustomer != null) {
            $MobileCustomer->delete();
            return redirect()->back()->with('success', "Promotion User Deleted Successfully");

        }
        return redirect()->back()->with('error', "Wrong ID!!");
    }
}