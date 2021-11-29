<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE GuzzleHttp\Client;
class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postRequest()
    {
        $client = new Client();
        $response = $client->request('POST', 'http://localhost:8001/api/store', [
            'form_params' => [
                'name' => 'Parth',
            ]
        ]);
        $response = $response->getBody()->getContents();
        echo '<pre>';
        print_r($response);
    }

    public function getRequest()
    {
        $client = new Client();
        $request = $client->get('http://localhost:8001/api/index');
        $response = $request->getBody()->getContents();
        echo '<pre>';
        print_r($response);
        exit;
    }

   public function userRegister(Request $response){

        $client = new Client();
        $response = $client->request('POST', 'http://127.0.0.1:8001/api/register/user', [
            'form_params' => [
                $body['name'] = "Testing",
                $body['email'] => 'email@gmail.com',
                $body['password'] => 'password',
            ]
        ]);
        $response = $response->getBody()->getContents();
        echo '<pre>';
        print_r($response);
    }
   

        // $client = new \GuzzleHttp\Client();
          
        // $body['name'] = "Testing";
        // $body['email'] => 'email@gmail.com',
        // $body['password'] => 'password',


        // $url = "http://127.0.0.1:8001/api/register/user";
        // $response = $client->request("POST", $url, ['form_params'=>$body]);
        // $response = $client->send($response);
        // return $response;
        //get User 


   public function getUser(){

    $client = new Client();
    $response = $client->get('http://127.0.0.1:8001/api/user');
    $response = $response->getbody()->getContents();

    echo "<pre>";
    print_r($response);
   }
}
