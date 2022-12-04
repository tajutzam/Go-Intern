<?php


namespace LearnPhpMvc\helper;

class MoveFile
{
    public static function moveFilePenyedia($tmp, $nama, $key): array
    {
        $response =  array();
        switch ($key) {
            case 'avatarpenyedia':
                # code...
                if (file_exists(__DIR__ . "/../../public/image/penyedia/" . $nama)) {
                    $response['status'] = "failed";
                    $response['message'] = "gagal menambahkan foto , foto sudah ada";
                } else {
                    move_uploaded_file(
                        $tmp,
                        __DIR__ . "/../../public/image/penyedia/" . $nama
                    );
                    $response['status'] = "oke";
                    $response['message'] = "Berhasil menambahkan foto , ";
                    $response['name'] = $nama;
                }
                break;
            case 'avatarpencari':
                echo "masuk ke pencari";
                if (file_exists(__DIR__ . "/../../public/image/pencari_magang/" . $nama)) {
                    $response['status'] = "failed";
                    $response['message'] = "gagal menambahkan foto , foto sudah ada";
                } else {
                    $responseTrue = move_uploaded_file(
                        $tmp,
                        __DIR__ . "/../../public/image/pencari_magang/" . $nama
                    );
                    $response['status'] = "oke";
                    $response['message'] = "Berhasil menambahkan foto , ";
                    $response['name'] = $nama;
                }
                break;
            case 'penghargaan':
                if (file_exists(__DIR__ . "/../../public/documents/penghargaan/" . $nama)) {
                    $response['status'] = "failed";
                    $response['message'] = "gagal menambahkan penghargaan , penghargaan sudah ada";
                } else {
                    $responseTrue = move_uploaded_file(
                        $tmp,
                        __DIR__ . "/../../public/dokuments/penghargaan/" . $nama
                    );
                    $response['status'] = "oke";
                    $response['message'] = "Berhasil menambahkan penghargaan , ";
                    $response['name'] = $nama;
                }
                break;
            case 'cv':
                if (file_exists(__DIR__ . "/../../public/documents/cv/" . $nama)) {
                    $response['status'] = "failed";
                    $response['message'] = "gagal menambahkan cv , cv sudah ada";
                } else {
                    $responseTrue = move_uploaded_file(
                        $tmp,
                        __DIR__ . "/../../public/dokuments/cv/" . $nama
                    );
                    $response['status'] = "oke";
                    $response['message'] = "Berhasil menambahkan cv , ";
                    $response['name'] = $nama;
                }
                break;
            default:
                # code...
                break;
        }
        return $response;
    }
}
