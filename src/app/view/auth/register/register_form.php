<?php

require_once __DIR__ . "/../../../../../vendor/autoload.php";
$role = $_POST['role'];


use LearnPhpMvc\config\Url;

?>
<div class="header-login position-relative">
    <div class="row">
        <div class="col-lg-7">
            <h1 class="h1-selamat-datang" style="font-size: 50px ;" class="m-lg-5 m-md-3 m-sm-5"><span style="color: #4356FF;">Ayo Bergabung <br> </span>Bersama Kami</h1>
        </div>
        <div class="col-lg-5">
            <img class="login-image" src=<?= Url::BaseUrl(). "/assets/register-man-photo.png" ?> alt="login foto" style="height: 500px;">
        </div>
    </div>
</div>
<div class="box-login">
    <h3 style="" class="text-center text-judul-login mb-5">Register go-intern</h3>
    <form action="register_form.php" method="post" class="form-login w-75">
        <div class="mb-4">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Email">
        </div>
        <div class="row">
            <div class="col-6">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Depan">
            </div>
            <div class="col-6 mb-4">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nama Belakang">
            </div>
        </div>
        <div class="mb-4">
            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Password">
        </div>
        <div class="mb-4">
            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Konfirmasi Password">
        </div>
        <div class="row mb-3">
            <div class="col-8">
                <select class="form-select" aria-label="Default select example" id="id_select">
                    <option value="0" selected>Pilih Role</option>
                    <option value="1">Pencari Magang</option>
                    <option value="2">Penyedia Magang</option>
                </select>
            </div>
        </div>
        <div id="form-pencari">
            <div class="mb-4">
                <input type="file" class="form-control" id="cv" placeholder="Masukan CV">
            </div>
            <div class="mb-4">
                <input type="file" class="form-control" id="resume" placeholder="Masukan Resume">
            </div>
            <div class="form-floating mb-5">
                <textarea class="form-control" placeholder="Pisahkan Skill Dengan , " id="floatingTextarea"></textarea>
                <label for="" class="form-label">Skill</label>
            </div>
            <div class="form-floating mb-5">
                <textarea class="form-control" placeholder="Pisahkan Skill Dengan , " id="floatingTextarea"></textarea>
                <label for="" class="form-label">Alamat</label>
            </div>
        </div>
        <div id="form-penyedia">
            <div class="row mb-3">
                <div class="col-8">
                    <select class="form-select" aria-label="Default select example" id="id_select">
                        <option value="0" selected>Jenis Usaha</option>
                        <option value="1">Pendidikan</option>
                        <option value="2">It</option>
                        <option value="2">Multimedia</option>
                    </select>
                </div>
            </div>
            <div class="form-floating mb-5">
                <textarea class="form-control" placeholder="Pisahkan Skill Dengan , " id="floatingTextarea"></textarea>
                <label for="" class="form-label">Alamat</label>
            </div>
        </div>

        <a href="">
            <div class="btn btn-primary w-100">Submit</div>
        </a>
    </form>
</div>