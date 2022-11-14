<?php

require_once __DIR__ . "/../../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;

?>
<?php
if ($model['status'] == "failed") {
?>

    <script>
        alert("<?= $model['message'] ?>");
    </script>
<?php }
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
    <h3 class="text-center text-judul-login">Login go-intern</h3>
    <div class="text-center mb-5">Hey , Masukan username dan password mu untuk masuk</div>
    <form action=<?= Url::BaseUrl() . "/login/post" ?> method="post" class="form-login w-75">
        <div class="mb-5">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username" name="username">
        </div>

        <div class="input-group mb-5">
            <input type="password" name="passwordIn"  class="input form-control" id="password" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <span class="input-group-text" onclick="password_show_hide();">
                    <i class="fas fa-eye" id="show_eye"><img src=<?= Url::BaseUrl() . "/assets/eye.svg" ?> alt="" srcset=""></i>
                    <i class="fas fa-eye d-none" id="hide_eye"> <img src=<?= Url::BaseUrl() . "/assets/eye-off.svg" ?>> </i>
                </span>
            </div>
        </div>

        <!-- <div class="mb-5">
            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="password" name="passwordIn"> <span><a href="">show</a></span>
        </div> -->

        <div class="lupa-password ">
            <p> <span>Lupa Password</span> <a class="" href=""><span style="color: #4356FF;"></span>Klik Saya</a>
            </p>
        </div>
        <?php
        ?>
        <button type="submit" class="btn-primary w-100" name="login">Login</button>
        <p class="mt-3 text-center">Tidak punya akun ? <a href=""> <span style="color: #4356FF;">Daftar sekarang</span></a> </p>
    </form>

</div>

<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>