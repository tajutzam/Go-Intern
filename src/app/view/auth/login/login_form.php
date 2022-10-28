<?php

require_once __DIR__ . "/../../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;

?>
<div class="header-login position-relative">
    <div class="row">
        <div class="col-lg-7">
            <h1 class="h1-selamat-datang" style="font-size: 80px ;" class="m-lg-5 m-md-3 m-sm-5"><span style="color: #4356FF;">Selamat</span> Datang</h1>
        </div>
        <div class="col-lg-5">
            <img class="login-image" src=<?= Url::BaseUrl() . "/assets/login-girl-photo.png" ?> alt="login foto" style="height: 500px;">
        </div>
    </div>
</div>
<div class="box-login">
    <h3 style="" class="text-center text-judul-login">Login go-intern</h3>
    <div class="text-center mb-5">Hey , Masukan username dan password mu untuk masuk</div>
    <form action="" method="post" class="form-login w-75">
        <div class="mb-5">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username">
        </div>
        <div class="mb-5">
            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Password">
        </div>

        <div class="lupa-password ">
            <p> <span>Lupa Password</span> <a class="" href=""><span style="color: #4356FF;"></span>Klick Saya</a>
            </p>
        </div>
        <a href="">
            <div class="btn btn-primary w-100">Login</div>
        </a>
        <p class="mt-3 text-center">Tidak punya akun ? <a href=""> <span style="color: #4356FF;">Daftar sekarang</span></a> </p>
    </form>

</div>