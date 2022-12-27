<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\helper\Helper;
use PHPUnit\TextUI\Help;

class RegisterController
{
    function formRegister()
    {
        $model = [
            'title' => "Isi Data Lamaran",
            'content' => "Go Intern"
        ];
        View::render("/auth/register/register_form", $model, "getFooter3");
    }
    function postRegister()
    {
        $urlRegister = Url::BaseApi() . "/api/penyedia/register/akun";
       
        if (isset($_POST)) {
            echo "isPost";
            $username = $_POST['usernameRegister'];
            $email = $_POST['emailRegister'];
            $password = $_POST['passwordRegister'];
            $konfimasi = $_POST['konfirmasiPasswordRegister'];
            $namdepan = $_POST['namadepanRegister'];
            $namabelakang = $_POST['namabelakangRegister'];
            $jenisUsaha = $_POST['jenis_usaha'];
            $alamt =  $_POST['alamat'];
            var_dump($password, $konfimasi);
            $nohpRegister = $_POST['nohpRegister'];
            if ($password == $konfimasi) {
                if ("" == trim($_POST['submit'])) {
                    View::redirect("register");
                } else {
                    // todo register prosess
                    $token = $token = bin2hex(random_bytes(16));
                    $dataRegister = array(
                        "username" => $username,
                        "password" => password_hash($password , PASSWORD_BCRYPT),
                        "email" => $email,
                        "nama_perusahaan" => $namdepan . " " . $namabelakang,
                        "no_telp" => $nohpRegister,
                        "role" => 5,
                        "token" => $token,
                        "alamat" => $alamt,
                        "jenisUsaha" => $jenisUsaha,
                        "konfirmasi" => $konfimasi
                    );
                    $content = json_encode($dataRegister); // buat menjadi json
                    $curl = curl_init($urlRegister);
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
                    // http://192.168.0.9:8080/api/penyedia/verivication/Zamz
                    if ($response['status'] == "ok") {
                        $urlSendMail =  Url::BaseApi() . "/api/penyedia/verivication/$username";
                        $responseMil = file_get_contents($urlSendMail);
                        echo "<script>
    alert('Berhasil Regristasi , Harap aktvasi akun anda terlebih dahulu untuk login');
    window.location.href='/login';
    </script>";
                    } else {
                  
                        echo "<script>
                        alert('" . $response['message'] . "');
                        window.location.href='/register';
                        </script>";
                    }
                }
            } else {
           Helper::showMessage("password dan konfirmasi password harus sama" , "/register");
            }
        } else {
            View::redirect("register");
        } 
        // View::redirect("register");
    }
}
