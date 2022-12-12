<?php

namespace LearnPhpMvc\controller;

require_once __DIR__ . "/../../../../vendor/autoload.php";

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\ResponseJson\PencariMagangResponse;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\helper\ModelMapper;
use LearnPhpMvc\service\PenyediaMagangService;
use LearnPhpMvc\Session\MySession;

class LoginController
{



    static public PenyediaMagangService $service;


    public function __construct()
    {
        self::$service = new PenyediaMagangService();
    }

    static function formLogin()
    {
        $isLogin = MySession::getCurrentSession();

        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern",
            'result' => $isLogin
        ];
        if ($isLogin['status'] == true) {
            PenyediaMagangController::home();
        }
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];
        $url = Url::BaseApi() . "/api/pencarimagang/all";
        $contents = file_get_contents($url);
        $contents = utf8_encode($contents);
        $result = json_decode($contents, true);
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern",
            // 'result' => $this->postLogin() != null ? $this->postLogin() : ""
        ];
        $newData = array();
        View::render("/auth/login/login_form", $model, "getFooter3");
    }
    static function postLogin()
    {
        $isLogin = MySession::getCurrentSession();
        if ($isLogin['status'] == true) {
            PenyediaMagangController::home();
        } else {
            if (isset($_POST['login'])) {
                if ("" == trim($_POST['username'])) {
                    echo "<script>alert('harap isi username')</script>";
                    View::redirect("/login");
                } else if ("" == trim($_POST['passwordIn'])) {
                    echo "<script>alert('harap isi password')</script>";
                    View::redirect("/login");
                } else {
                    $dataLogin = array(
                        "username" =>  $_POST['username'],
                        "password" => $_POST['passwordIn']
                    );
                    $urlLogin = Url::BaseApi() . "/api/penyedia/login";
                    $content = json_encode($dataLogin);
                    $curl = curl_init($urlLogin);
                    curl_setopt($curl, CURLOPT_HEADER, false);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt(
                        $curl,
                        CURLOPT_HTTPHEADER,
                        array("Content-type: application/json")
                    );
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
                    $json_response = curl_exec($curl);
                    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    curl_close($curl);
                    $response = json_decode($json_response, true);
                    if ($response['status'] == "oke") {
                        $model = [
                            'title' => "Isi Data Lamaran",
                            'content' => "Go Intern",
                            'result' => $response
                        ];
                        $newData = array();
                        // save jwt session
                        $key = "asodkaosdkoaoasdisauduqeiqwmxzmxlasncjnfqwhodqwpdqowkdpqkdckmkjfabfhfwhfojpfqkqowkowqkeopqwke";

                        // var_dump($response[0]['username']);
                        $payload = array(
                            "id" => $response[0]['id'],
                            "username" => $response[0]['username'],
                            "nama_perusahaan" => $response[0]['nama_perushaan'],
                            "no_telp" => $response[0]['no_telp'],
                            "foto" => $response[0]['foto'],
                            "jenis_usaha" => $response[0]['jenis_usaha'],
                            "email" => $response[0]['email'],
                            "token" => $response[0]['token'],
                            "alamat" => $response[0]['alamat'],

                        );
                        $jwt =  JWT::encode($payload, $key, 'HS256');
                        // set cockie
                        setcookie("GO-INTERN-COCKIE", $jwt, 0, "/");
                        // // View::render("/penyedia/index", $model, "getFooter3");
                        // View::render("/penyedia/index", $model, "getFooter3");
                        View::redirect("company/home");
                    } else {
                        echo "<script>alert('" . $response['message'] . "')</script>";
                        self::formLogin();
                    }
                    // View::redirect("company/home");
                }
            }
        }
    }
}
