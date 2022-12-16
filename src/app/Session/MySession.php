<?php

namespace LearnPhpMvc\Session;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\service\JenisUsahaService;

class MySession
{

    static public function getCurrentSession(): array
    {
        $response = array();
        try {
            $key = "asodkaosdkoaoasdisauduqeiqwmxzmxlasncjnfqwhodqwpdqowkdpqkdckmkjfabfhfwhfojpfqkqowkowqkeopqwke";
            if (isset($_COOKIE['GO-INTERN-COCKIE'])) {
                $jwt = $_COOKIE['GO-INTERN-COCKIE'];
                $payload = JWT::decode($jwt, new Key($key, 'HS256'));
                $username = $payload->username;
                $id = $payload->id;
                $nama_perusahaan = $payload->nama_perusahaan;
                $no_telp = $payload->no_telp;
                $foto = $payload->foto;
                $jenis_usaha = $payload->jenis_usaha;
                $email = $payload->email;
                $token = $payload->token;
                $alamat = $payload->alamat;
                $jenisUsahaValue = $payload->jenis_usaha;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => Url::BaseApi().'/api/jenisusaha/findbyid/'.$jenis_usaha,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $responseCurl = curl_exec($curl);
                $decodedJenisUSaha = json_decode($responseCurl , true);
                curl_close($curl);
                $item = array(
                    "username" => $username,
                    "id" => $id,
                    "nama_perusahaan" => $nama_perusahaan,
                    "no_telp" => $no_telp,
                    "foto" => $foto,
                    "jenis_usaha" => $jenisUsahaValue,
                    "email" => $email,
                    "token" => $token,
                    "alamat" => $alamat , 
                    "jenis_usaha_value" => $decodedJenisUSaha['body'][0]['jenis_usaha']
                );
                array_push($response, $item);
                $response['status']  = true;
            } else {
              
                $response['coockie'] = $_COOKIE;
                $response['status'] = false;
                $response['message'] = 'harap login terlebih dahulu';
            }
        } catch (Exception $th) {
            $response['status'] = false;
            $response['message'] = 'harap login terlebih dahulu';
        }
        return $response;
    }
}
