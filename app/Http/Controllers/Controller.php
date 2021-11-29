<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        return view('firebase');
    }

    public function sendNotification(){

        $token = "cWZlZVS7h9o:APA91bEL96Eqy-jXrdF0tahpCfrBvGT8JaBTYt7LA-AgR1P2zkq-_bz0ToF6lYHQCt3doN85erXfVb0cQfExZX9V254O_msaAK6Nu7Q6LnyEnqtabM3HWL-5NOK4V7g6ZJSWGM9X9Qvm";  
        $from = "AAAAeFypLi8:APA91bGhprL1V3GgjKtS64RJMsOw_zZPD5g5I5oMTv1HK366gD6INoZitii1n1KUwmxNC8bLnZ2tHQdenOB3b-QMeFaM83eJpAtgCw3eMILeGaadxUOfxtM4qY7XkM-X8t2DDGJlV1Nw";
        $msg = array
              (
                'body'  => "Testing Testing",
                'title' => "Hi, From Raj",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
    }
}
