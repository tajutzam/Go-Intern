<?php

use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Session\MySession;

$session = MySession::getCurrentSession();
$curl = curl_init();
$dataPost = array(
    "jenis" => $session[0]['jenis_usaha_value']
);
curl_setopt($curl, CURLOPT_URL, Url::BaseApi() . "/api/jenisusaha/findall");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataPost));
$responseDataJenis = curl_exec($curl);
curl_close($curl);
$decodedJenis = json_decode($responseDataJenis, true);
// Menggunakan fungsi date untuk mendapatkan waktu saat ini
$waktu = date("H");
$sayGreeting;
// Menggunakan kondisi if untuk memeriksa jam saat ini
if ($waktu < 12) {
    // Jika jam saat ini kurang dari 12, tampilkan ucapan selamat pagi
    $sayGreeting =  "Selamat pagi!";
} else if ($waktu >= 18 && $waktu < 24) {
    // Jika tidak, tampilkan ucapan selamat siang
    $sayGreeting =  "Selamat malam!";
} else {
    $sayGreeting = "Selamat siang";
}

?>
<!-- Sidebar -->
<script src="https://kit.fontawesome.com/9f20f8d82b.js" crossorigin="anonymous"></script>

<ul class="navbar-nav sidebar sidebar-light  accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src=<?= Url::BaseUrl() . "/assets/logo.png" ?>>
        </div>
        <div class="sidebar-brand-text mx-3">GO INTERN</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
            <span> <?php echo $sayGreeting . " " . $model['result'][0]['nama_perusahaan'] ?></span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Fitur
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href=<?= Url::BaseUrl() . "/company/home/dashboard" ?> data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= Url::BaseUrl() . "/company/home/dashboard/tambah/magang" ?>" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data</h6>
                <a class="collapse-item" href="<?= Url::BaseUrl() . "/company/home/dashboard/tambah/magang" ?>">Magang</a>
                <a class="collapse-item" href="<?= Url::BaseUrl() . "/company/home/dashboard/pemagang" ?>">Pemagang</a>
                <a class="collapse-item" href="<?= Url::BaseUrl() . "/company/home/dashboard/lamaran" ?>">Lamaran</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Logout
    </div>
    <li class="nav-item">
        <a id="logout" class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow">
                    <!-- show modal proffile -->
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="<?= Url::BaseUrl() . "/image/penyedia/" . $session[0]['foto'] ?>" style="max-width: 60px">
                        <span class="ml-2 d-none d-lg-inline text-white small"><?= $model['result'][0]['nama_perusahaan'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalProfile" id="#modalScroll">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#keamanan" id="#modalScroll">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Pengaturan Keamanan
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Topbar -->
        <!-- Modal Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah kamu yakin ingin logout?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <a href="<?= Url::BaseUrl() . "/company/home/dashboard/logout" ?>" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Data Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <form method="post" action="<?= Url::BaseUrl() . "/company/home/dashboard/changefoto" ?>" enctype="multipart/form-data">
                                        <div class="col-lg-4">
                                            <img src="<?= Url::BaseUrl() . "/image/penyedia/" . $model['result'][0]['foto'] ?>" class="img-profile rounded-circle" style="height: 200px ; max-width: 200px; max-height: 200px;">
                                        </div>
                                        <div class="col-8" style="margin-top: 0px ;">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input hidden id="file_input" type="file" name="fotofile" accept="image/*">
                                                    <span class="mt-5 ml-3 btn btn-primary" style="height: 40px ; width: 70px ;">
                                                        <label for="file_input" style="font-size: 10px;">Pilih Foto</label>
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    <button type="submit" class="mt-5 ml-3 btn btn-primary" style="height: 40px ; width: 70px;" name="submit" value="submit">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <form action="<?= Url::BaseUrl() . "/company/home/dashboard/update/data" ?>" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username harus diawali dengan hurus besar" value="<?= $model['result'][0]['username'] ?>" name="usernameUpdate" required oninvalid="this.setCustomValidity('Username tidak boleh kosong')" oninput="setCustomValidity('')" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Nama Lengkap" value="<?= $model['result'][0]['nama_perusahaan'] ?>" name="namaPerusahaanUpdate" required oninvalid="this.setCustomValidity('Nama perusahaan tidak boleh kosong')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">No telp</label>
                                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Masukan No Telp" value="<?= $model['result'][0]['no_telp'] ?>" name="no_telpUpdate" required oninvalid="this.setCustomValidity('No telp tidak boleh kosong')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Alamat Perusahaan</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Alamat Perusahaan" value="<?= $model['result'][0]['alamat'] ?>" name="alamatUpdate" required oninvalid="this.setCustomValidity('alamat perusahaan tidak boleh kosong')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Email" value="<?= $model['result'][0]['email'] ?>" name="emailUpdate" required oninvalid="this.setCustomValidity('Format email tidak sesuai')" oninput="setCustomValidity('')">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Jenis Usaha</label>
                                        <select class="custom-select" id="selectJenisUsaha" name="jenisUsahaUpdate" aria-label="Default select example">
                                            <option selected value=<?= $session[0]['jenis_usaha'] ?>> <?= $session[0]['jenis_usaha_value'] ?></option>
                                            <?php
                                            foreach ($decodedJenis['body'] as $key => $value) {
                                                # code...
                                            ?>
                                                <option value="<?= $value['id'] ?>"> <?= $value['jenis'] ?> </option>
                                            <?php }
                                            ?>
                                        </select required>
                                    </div>
                                    <div class="row mb-3">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="simpan-profile">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="keamanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Perbarui Kata Sandi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?= Url::BaseUrl() . "/company/home/dashboard/updatepassword" ?>">
                            <label>Password Lama</label>
                            <div class="input-group mb-5">
                                <input required oninvalid="this.setCustomValidity('Password Lama tidak boleh kosong')" oninput="setCustomValidity('')" type="password" name="passwordLama" class="input form-control" id="password3" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1">
                                <div class="input-group-addon">
                                    <span class="input-group-text" onclick="showHide3();">
                                        <i id="show_eye2"><img src=<?= Url::BaseUrl() . "/assets/eye.svg" ?> alt="" srcset=""></i>
                                        <i class="d-none" id="hide_eye2"> <img src=<?= Url::BaseUrl() . "/assets/eye-off.svg" ?>> </i>
                                    </span>
                                </div>
                            </div>
                            <label>Password Baru</label>
                            <div class="input-group mb-5">
                                <input required oninvalid="this.setCustomValidity('Password baru  tidak boleh kosong')" oninput="setCustomValidity('')" type="password" name="passwordBaru" class="input form-control" id="password4" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1">
                                <div class="input-group-addon">
                                    <span class="input-group-text" onclick="showHide4();">
                                        <i id="show_eye3"><img src=<?= Url::BaseUrl() . "/assets/eye.svg" ?> alt="" srcset=""></i>
                                        <i class="d-none" id="hide_eye3"> <img src=<?= Url::BaseUrl() . "/assets/eye-off.svg" ?>> </i>
                                    </span>
                                </div>
                            </div>
                            <label>Konfirmasi Password</label>
                            <div class="input-group mb-5">
                                <input required oninvalid="this.setCustomValidity('Konfirmasi Password tidak boleh kosong')" oninput="setCustomValidity('')" type="password" name="konfirmasiPassword" class="input form-control" id="password5" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1">
                                <div class="input-group-addon">
                                    <span class="input-group-text" onclick="showHide5();">
                                        <i id="show_eye4"><img src=<?= Url::BaseUrl() . "/assets/eye.svg" ?> alt="" srcset=""></i>
                                        <i class="d-none" id="hide_eye4"> <img src=<?= Url::BaseUrl() . "/assets/eye-off.svg" ?>> </i>
                                    </span>
                                </div>
                            </div>
                            <input type="text" hidden readonly value="<?= $model['result'][0]['id'] ?>" name="id">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="updatePassword">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->