<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\ResponseJson\PencariMagangResponse;
use LearnPhpMvc\helper\ModelMapper;

require_once __DIR__."/../../../../vendor/autoload.php";

class LoginController
{

    function formLogin()
    {
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];
        $url = Url::BaseApi()."/api/pencarimagang/all";
        $contents = file_get_contents($url);
        $contents = utf8_encode($contents);
        $result = json_decode($contents , true);
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern" ,
            'result' => $result
        ];
        $newData = array();
        View::render("/auth/login/login_form", $model, "getFooter2");
        View::redirect("");
    }

    function postLogin(){
           if(isset($_POST['username']) && isset($_POST['password'])){
               $dataLogin = array(
                   "username" =>  $_POST['username'] ,
                     "password" => $_POST['password']
           );
               $urlLogin = Url::BaseApi()."/api/login";
               $content = json_encode($dataLogin);
               $curl = curl_init($urlLogin);
               curl_setopt($curl, CURLOPT_HEADER, false);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($curl, CURLOPT_HTTPHEADER,
                   array("Content-type: application/json"));
               curl_setopt($curl, CURLOPT_POST, true);
               curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
               $json_response = curl_exec($curl);
               $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
               if ( $status != 200 ) {
                   die("Error: call to URL $urlLogin failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
               }
               curl_close($curl);
               $response = json_decode($json_response, true);
//               View::redirect("/magang");

               View::render("/auth/login/login_form", $response, "getFooter2");
           }else{
               View::redirect("auth/login/login_form");
           }
    }

}
