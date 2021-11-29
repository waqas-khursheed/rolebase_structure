<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MobileCustomer;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    
    private $status_code    =        200;

    public function userSignUp(Request $request) {
        $validator              =        Validator::make($request->all(), [
            "name"              =>          "required",
            "email"             =>          "required|email",
            "password"          =>          "required",
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }

        

        $userDataArray          =       array(
            "name"          =>          $request->name,
            "email"              =>          $request->email,
            "password"           =>        md5($request->password),
            
        );

        $user_status            =           MobileCustomer::where("email", $request->email)->first();

        if(!is_null($user_status)) {
        return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! email already registered"]);
        }

        $user                   =           MobileCustomer::create($userDataArray);

        if(!is_null($user)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Registration completed successfully", "data" => $user]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "failed to register"]);
        }
    }


    // ------------ [ User Login ] -------------------
    public function userLogin(Request $request) {

        $validator          =       Validator::make($request->all(),
            [
                "email"             =>          "required|email",
                "password"          =>          "required"
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }


        // check if entered email exists in db
        $email_status       =       MobileCustomer::where("email", $request->email)->first();


        // if email exists then we will check password for the same email

        if(!is_null($email_status)) {
            $password_status    =   MobileCustomer::where("email", $request->email)->where("password", md5($request->password))->first();

            // if password is correct
            if(!is_null($password_status)) {
                $user           =       $this->userDetail($request->email);

                return response()->json(["status" => $this->status_code, "success" => true, "message" => "You have logged in successfully", "data" => $user]);
            }

            else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Incorrect password."]);
            }
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Email doesn't exist."]);
        }
    }

    // ------------------ [ User Detail ] ---------------------
    public function userDetail($email) {
        $user               =       array();
        if($email != "") {
            $user           =       MobileCustomer::where("email", $email)->first();
            return $user;
        }
    }

    //-------------------[ Get All Users ]-------------------------
    public function getUsers(){
        
        $MobileCustomer = MobileCustomer::all();
        return json_encode($MobileCustomer);
    }
}
