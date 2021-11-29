<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use App\EmployeeRole;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employee = User::where('employeerole_id', '!=' ,1)->get();
        $employee = User::get();

        return view('pages.employee.index',compact('employee'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.employee.create');
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
            'role' => 'required',
            'name' => 'required',
            'image' => 'required',
            'phone' => 'required|numeric|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ], [
            'role.required' => 'Select Employee Role',
            'name.required' => 'Employee Name is required',
            'image.required' => 'Employee image is required',
            'phone.required' => 'Employee Phone is required',
            'email.required' => 'Employee Email is required',
            'password.required' => 'Employee Password is required',
        ]);
        
        $rights="";
        if ($request->right) {
            $rights = implode(',',$request->right);
        }

        $admin = new User();
        $admin->employeerole_id = $request->role;
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        if ($request->file('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y').$fileName ;
            $file->move('images/admin/', $name);
            $admin->image = 'images/admin/'.$name;
        }
        $admin->right = $rights;
        $admin->save();
        return redirect()->back()->with('success',"Employee Add Successfully"); 
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
        $rights="";
        if ($request->right) {
            $rights = implode(',',$request->right);
        }
        $admin = User::find($id);
        $admin->employeerole_id = $request->role;
        $admin->right = $rights;
        $admin->update();
        return redirect()->back()->with('success',"Employee Update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }

    public function addrole(Request $request)
    {
        $request->validate([
            'role' => 'required|unique:employee_roles',
           
        ], [
            'role.required' => 'Employee Role is required',
        ]);
        $roles = new EmployeeRole();
        $roles->role = $request->role;
        $roles->save();
        return redirect()->back()->with('success',"Role Add Successfully"); 
    }
    
    public function role()
    {
        $employeeroles = EmployeeRole::all();
        return view('pages.employee.role',compact('employeeroles'));
    }
}
