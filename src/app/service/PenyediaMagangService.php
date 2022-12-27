<?php

namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Domain\PencariMagang;
use LearnPhpMvc\Domain\PenyediaMagang;
use LearnPhpMvc\dto\AktivasiAkunRequest;
use LearnPhpMvc\dto\AktivasiAkunResponse;
use LearnPhpMvc\dto\LoginRequest;
use LearnPhpMvc\dto\PenyediaMagangRequest;
use LearnPhpMvc\dto\RegisterPenyediaRequest;
use LearnPhpMvc\repository\PenyediaMagangRepository;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;

class PenyediaMagangService
{

    private PenyediaMagangRepository $repository;

    public function __construct()
    {
        $this->repository = new PenyediaMagangRepository(Database::getConnection());
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }


    public function register(RegisterPenyediaRequest $registerPenyediaRequest): array
    {
        $reponse = array();
        try {
            //code...
            $domain = new PenyediaMagang();
            $domain->setUsername($registerPenyediaRequest->getUsername()); // 
            $domain->setPassword($registerPenyediaRequest->getPassword()); // 
            $domain->setEmail($registerPenyediaRequest->getEmail()); // 
            $domain->setNamaPerushaan($registerPenyediaRequest->getNama_perusahaan()); //
            $domain->setNoTelp($registerPenyediaRequest->getNo_telp()); // 
            $domain->setRole($registerPenyediaRequest->getRole());
            $domain->setToken($registerPenyediaRequest->getToken());
            $domain->setAlamaPerushaan($registerPenyediaRequest->getAlamat());
            $domain->setJenisUsaha($registerPenyediaRequest->getJenis_usaha());
            if ($domain->getUsername() != null && $domain->getPassword() != null && $domain->getEmail() != null && $domain->getNamaPerushaan() != null && $domain->getNoTelp() != null && $domain->getRole() != null && $domain->getToken() != null) {
                if (
                    $domain->getUsername() != "" && $domain->getPassword() != "" && $domain->getEmail() != "" && $domain->getNamaPerushaan() != "" && $domain->getNoTelp() != "" && $domain->getRole() != "" && $domain->getToken()
                ) {
                    if (preg_match('/\s/', $registerPenyediaRequest->getUsername())) {
                        $response['status'] = 'failed';
                        $response['message'] = 'username tidak boleh mengandung spasi';
                        return $response;
                    } else {
                        $domainResponse =  $this->repository->save($domain);
                        if ($domainResponse == null) {
                            http_response_code(400);
                            $response['status'] = "failed";
                            $response['message'] = "Username sudah digunakan";
                            return $response;
                        } else {
                            // http_response_code(200);
                            $item = array(
                                "id" => $domainResponse->getId(),
                                "nama_perusahaan" => $domain->getNamaPerushaan(),
                                "username" => $domain->getUsername(),
                                "password" => $domain->getPassword(),
                                "email" => $domain->getEmail(),
                                "no_telp" => $domain->getNoTelp(),
                                "role" => $domain->getRole(),
                                "token" => $domain->getToken(),
                                "status" => $domain->getStatus(),
                                "alamat" => $domainResponse->getAlamaPerushaan(),
                                "jenis_usaha" => $domainResponse->getJenisUsaha()
                            );
                            $reponse['status'] = 'ok';
                            $reponse['message'] = 'berhasil regristasi';
                            array_push($reponse, $item);
                        }
                    }
                } else {
                    http_response_code(400);
                    $reponse['status'] = 'failed';
                    $reponse['message'] = 'harap isi semua field';
                }
            } else {
                http_response_code(401);
                $reponse['status'] = 'failed';
                $reponse['message'] = 'Semua field tidak boleh null';
            }
            return $reponse;
        } catch (PDOException $th) {
            //throw $th; 
            http_response_code(500);
            return $reponse;
        }
    }
    // find penyedia magang by username
    public function findByUsername($username): array
    {
        $request = new PenyediaMagang();
        $request->setUsername($username);
        $response = $this->repository->findByUsername($request);
        return $response;
    }

    // send email after regristation
    public function sendMailVerivikasi(AktivasiAkunRequest $request): array
    {
        $aktivasiResponse = new AktivasiAkunResponse();
        $path_info = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/", $path_info);
        $usernameAkunVerivication = $listOfUrl[4];
        $response = array();
        $penyediaMagang = new PenyediaMagang();
        $penyediaMagang->setUsername($usernameAkunVerivication);
        $byUsername = $this->repository->findByUsername($penyediaMagang);
        if ($byUsername == null) {
            $response['status'] = "link tidak valid";
            http_response_code(404);
        } else {
            try {
                // konfigurasi mail stmpt
                $mail = new PHPMailer(); // create a new object
                $email_pengirim = "gointern.pt.6@gmail.com";
                $mail->Username = $email_pengirim;
                $mail->Password = "vxuswlzezomsuzwz";
                $mail->IsSMTP(); // enable SMTP
                $nama_pengirim = "Go intern";
                $email_penerima = $request->getEmail();
                $subjek = "Verifikasi Akun";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                // $mail->SMTPDebug = 2;
                $mail->setFrom($email_pengirim, $nama_pengirim);
                $mail->addAddress($email_penerima);
                $mail->Subject = $subjek;
                $expire_stamp = date('Y-m-d H:i:s', strtotime("+5 min"));
                $now_stamp = date("Y-m-d H:i:s");
                // link aktivate berdasarkan token
                $token = $byUsername[0]['token'];
                $linkActivation = Url::BaseApi() . "/api/aktifasi/penyedia/$usernameAkunVerivication/$token";
                $pesan = <<<HTML
                <h3>Hai , $usernameAkunVerivication Harap Aktivasi Akun anda dengan klik tombol dibawah ini</h3>
                <p>Harap Aktivasi Akun anda dengan klik tombol dibawah ini</p>
                <p>Link Akan expired pada jam $expire_stamp </p>
                <button> 
                <a href="$linkActivation"> Klick link dibawah ini</a>
                </button>
                <br>
                <br>
                <p>Salam Manis , Go intern :) </p>
HTML;
                $aktivasiResponse->setExpired($expire_stamp);
                $pencariMagang = new PenyediaMagang();
                $pencariMagang->setUsername($usernameAkunVerivication);
                $updateE = $this->repository->updateExpaired($aktivasiResponse, $penyediaMagang);
                $response['data'] = $updateE;
                $response['body'] = $aktivasiResponse->getExpired();
                $mail->Body = html_entity_decode($pesan);
                $mail->isHTML(true);
                $mail->send();
                http_response_code(200);
                return $response;
            } catch (\Exception $exception) {
                return $response;
            }
        }
        return $response;
    }
    // update status user , after click link in email
    public function updateStatusUser(): array
    {
        $path_info = $_SERVER['PATH_INFO'];
        $listOfUrl = explode("/", $path_info);
        $usernameAkunVerivication = $listOfUrl[4];
        $tokenVerivication = $listOfUrl[5];

        $response = array();
        $now_stamp = date("Y-m-d H:i:s");
        $penyediaMagang = new PenyediaMagang();
        $penyediaMagang->setUsername($usernameAkunVerivication);
        $byUsername = $this->repository->findByUsername($penyediaMagang);
        $tokenDb = $byUsername[0]['token'];
        if ($byUsername['status'] == "data tidak ditemukan") {
            http_response_code(404);
            $response['status'] = "data tidak ditemukan";
        } else {
            if ($byUsername[0]['status'] == "aktif") {
                http_response_code(201);
                $response['status'] = 'terjadi kesalahan';
                $response['message'] = 'Akun sudah di aktivasi , silahkan login';
            } else {
                if ($tokenVerivication === $tokenDb) {
                    http_response_code(401);
                    if ($now_stamp >= $byUsername[0]['expired_token']) {
                        $response['status'] = "link expired";
                    } else {
                        http_response_code(200);
                        $this->repository->updateStatus($penyediaMagang);
                        $response['status'] = "berhasil aktivasi , harap login menggunakan akun anda";
                    }
                } else {
                    http_response_code(400);
                    $response['status'] = "failed";
                    $response['message'] = "link tidak valid";
                }
            }
        }
        return $response;
    }
    public function login(LoginRequest $loginRequest): array
    {
        $penyediaMagang = new PenyediaMagang();
        $penyediaMagang->setUsername($loginRequest->username);
        $response = array();
        $responseByUsername = $this->repository->findByUsername($penyediaMagang);
        if ($responseByUsername['status'] == "oke") {
            if ($responseByUsername[0]['status'] == "tidak-aktif") {
                http_response_code(401);
                $response['status'] = 'Failed';
                $response['message'] = "Harap Aktivasi akun anda terlebih dahulu";
            } else if (password_verify($loginRequest->password, $responseByUsername[0]['password'])) {
                http_response_code(200);
                $response['status'] = 'oke';
                $response['message'] = 'berhasil login';
                array_push($response, $responseByUsername[0]);
            } else {
                http_response_code(401);
                $response['status'] = 'failed';
                $response['message'] = 'username atau password salah';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'harap cek username atau password anda';
        }
        return $response;
    }
    public function updateDataProfile(PenyediaMagangRequest $penyediaMagangRequest): array
    {
        $response = array();
        $penyedia = new PenyediaMagang();
        $penyedia->setNamaPerushaan($penyediaMagangRequest->getNamaPerushaan());
        $penyedia->setAlamaPerushaan($penyediaMagangRequest->getAlamatPerushaan());
        $penyedia->setEmail($penyediaMagangRequest->getEmail());
        $penyedia->setNoTelp($penyediaMagangRequest->getNoTelp());
        $penyedia->setUsername($penyediaMagangRequest->getUsername());
        $penyedia->setJenisUsaha($penyediaMagangRequest->getJenisUsaha());
        $penyedia->setId($penyediaMagangRequest->getId());
        $updatedData = $this->repository->updateData($penyedia);
        if ($updatedData == null) {
            $response['status'] = "failed";
            $response['message'] = "gagal memperbarui data profile";
            echo "<script>alert('gagal memperbarui data profile , username sudah digunakan');window.location.href='/company/home/dashboard'</script>";
        } else {
            $response['status'] = "oke";
            $response['message'] = "berhasil memperbarui data profile";
            unset($_COOKIE['GO-INTERN-COCKIE']);
            setcookie('GO-INTERN-COCKIE', null, -1, '/', Url::domain());
            setcookie('id', null, -1, '/', Url::domain());
            setcookie('id', null, -1, '/');
            echo "<script>alert('Berhasil Memperbarui data profile');window.location.href='/login'</script>";
        }
        return $response;
    }
    public function updatePathPhoto(PenyediaMagangRequest $penyediaMagangRequest)
    {
        $penyedia = new PenyediaMagang();
        $penyedia->setFoto($penyediaMagangRequest->getFoto());
        $penyedia->setId($penyediaMagangRequest->getId());
        $response = $this->repository->updatePathFoto($penyedia);
        return $response;
    }
    public function downloadCv()
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        var_dump($exploded);
        $tempName = $exploded[3];
        $filename = $exploded[4];
        $fullName = $tempName . ".pdf";
        $is =  file_exists(__DIR__ . "/../../public/dokuments/cv/" .    $fullName);
        if ($is) {
            header("Content-Disposition: attacchment; filename = " . $filename . ".pdf");
            header('Content-type: application/pdf');
            readfile(__DIR__ . "/../../public/dokuments/cv/" .    $fullName);
        } else {
            echo "script";
        }
    }
    public function downloadPenghargaan()
    {
        $path = $_SERVER['PATH_INFO'];
        $exploded = explode("/", $path);
        var_dump($exploded);
        $tempName = $exploded[3];
        $filename = $exploded[4];
        $fullName = $tempName . ".pdf";
        $is =  file_exists(__DIR__ . "/../../public/dokuments/penghargaan/" .    $fullName);
        if ($is) {
            header("Content-Disposition: attacchment; filename = " . $filename . ".pdf");
            header('Content-type: application/pdf');
            readfile(__DIR__ . "/../../public/dokuments/penghargaan/" .    $fullName);
        } else {
            echo "script";
        }
    }
    public function countMagang($id)
    {
        $penyedia = new PenyediaMagang();
        $penyedia->setId($id);
        $count = $this->repository->countMagangIklan($penyedia);
        return $count;
    }
    public function countMagangYangSedangDitempati($id)
    {
        $penyedia = new PenyediaMagang();
        $penyedia->setId($id);
        $count = $this->repository->countMagangYangsedangDitempati($penyedia);
        return $count;
    }

    public function countLamaranMasuk($id)
    {
        $penyedia = new PenyediaMagang();
        $penyedia->setId($id);
        $count = $this->repository->countLamaranMasuk($penyedia);
        return $count;
    }
    public function countPemagang($id)
    {
        $penyedia = new PenyediaMagang();
        $penyedia->setId($id);
        $count = $this->repository->countPemagang($penyedia);
        return $count;
    }

    public function showPopularPenyedia()
    {
        $response = $this->repository->showPopularCompanies();
        if ($response['status'] == 'oke') {
            foreach ($response['body'] as $key => $value) {
                # code...
                $value['jumlah_magang'] = 0;
                $id = $value['id'];
                $penydia = new PenyediaMagang();
                $penydia->setId($id);
                $jumlah = $this->repository->countMagangIklan($penydia);
                $response['body'][$key]['jumlah_magang'] = $jumlah;
            }
        }
        $responseNotPopular = $this->repository->showPopularClose();
        if ($responseNotPopular['status'] == 'oke') {
            foreach ($responseNotPopular['body'] as $key => $value) {
                # code...
                $value['jumlah_magang'] = 0;
                $id = $value['id'];
                $penydia = new PenyediaMagang();
                $penydia->setId($id);
                $jumlah = $this->repository->countMagangIklan($penydia);
                $value['jumlah_magang'] = $jumlah == null ? 0 : $jumlah;
                array_push($response['body'], $value);
            }
        }
        return $response;
    }

    public function updatePassword($passwordLama, $passwordBaru,  $konfirmasiPassword, $id): array
    {
        $response = array();
        $responseFindPenyediaMagang =  $this->repository->findById($id);
        if (isset($id)) {
            if ($responseFindPenyediaMagang != null) {
                $passwordHash = $responseFindPenyediaMagang->getPassword();
                $isCheckPassword =  password_verify($passwordLama, $passwordHash);
                $isCheckChanged = password_verify($passwordBaru, $passwordHash);
                if ($isCheckPassword) {
                    if ($isCheckChanged) {
                        $response['status'] = 'failed';
                        $response['message'] = 'Gagal memperbarui password , tidak ada perubahan';
                    } else {
                        if ($konfirmasiPassword == $passwordBaru) {
                            // todo update
                            $passwordBcrpt = password_hash($passwordBaru, PASSWORD_BCRYPT);
                            $responseFindPenyediaMagang->setPassword($passwordBcrpt);
                            $responseUpdate = $this->repository->updatePassword($responseFindPenyediaMagang);
                            if ($responseUpdate) {
                                $response['status'] = 'oke';
                                $response['message'] = 'berhasil memperbarui password';
                            } else {
                                $response['status'] = 'failed';
                                $response['message'] = 'terjadi kesalahan server';
                            }
                        } else {
                            // todo not equals
                            $response['status'] = 'failed';
                            $response['message'] = 'Password dan konfirmasi password tidak sesuai';
                        }
                    }
                    // todo compare password and confirmation password

                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'Password lama tidak sesuai';
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal memperbarui password , terjadi kesalahan';
            }
        } else {
            // todo data id not set
            $response['status'] = 'failed';
            $response['message'] = 'id not set , relog terlebih dahulu';
        }
        return $response;
    }

    function enable($id): array
    {
        $response = [];
        $result = $this->repository->findById($id);
        if ($result != null) {
            $responseEnabled = $this->repository->enable($id);
            if ($responseEnabled) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil mengaktifkan user / penyedia magang';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal mengaktifkan user terjadi kesalahan';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal mengaktifkan  user data user tidak ditemukan';
        }
        return $response;
    }

    function disable($id): array
    {
        $response = [];
        $result = $this->repository->findById($id);
        if ($result != null) {
            $responseEnabled = $this->repository->disable($id);
            if ($responseEnabled) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil menonaktifkan user / penyedia magang';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal menonaktifkan user terjadi kesalahan';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal menonaktifkan  user data user tidak ditemukan';
        }
        return $response;
    }

    public function count()
    {
        return $this->repository->countPenyedia();
    }
}
