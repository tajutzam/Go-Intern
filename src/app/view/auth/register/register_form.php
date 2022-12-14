<?php

require_once __DIR__ . "/../../../../../vendor/autoload.php";



use LearnPhpMvc\config\Url;

?>
<div class="header-login">
    <div class="row">
        <div class="col-lg-7">
            <h1 class="h1-selamat-datang" style="font-size: 50px ;" class="m-lg-5 m-md-3 m-sm-5"><span style="color: #4356FF;">Ayo Bergabung <br> </span>Bersama Kami</h1>
        </div>
        <div class="col-lg-5">
            <img class="login-image" src=<?= Url::BaseUrl() . "/assets/register-man-photo.png" ?> alt="login foto" style="height: 500px;">
        </div>
    </div>
</div>
<div class="box-register">
    <h3 class="text-center text-judul-login mb-5">Register go-intern</h3>
    <form action=<?= Url::BaseUrl() . "/register/post" ?> method="post" class="form-login w-75 needs-validation" novalidate>
        <div class=" mb-4">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username" name="usernameRegister" required>
        
        </div>
        <div class=" mb-4">
            <input type="email" class="form-control" id="validationCustom01" required name="emailRegister" placeholder="Masukan email"/>   
        </div>
        <div class="row">
            <div class="  col-6">
                <input type="text" class="form-control" id="validationCustom01" required placeholder="Nama Depan" name="namadepanRegister">
               
            </div>
            <div class="col-6 mb-4">
                <input type="text" class="form-control" id="validationCustom01" required placeholder="Nama Belakang" name="namabelakangRegister">
            </div>
        </div>
        <div class="input-group mb-4">
            <input type="password" name="passwordRegister" class="input form-control" id="password1" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <span class="input-group-text" onclick="password_show_hide();">
                    <i class="fas fa-eye" id="show_eye"><img src=<?= Url::BaseUrl() . "/assets/eye.svg" ?> alt="" srcset=""></i>
                    <i class="fas fa-eye d-none" id="hide_eye"> <img src=<?= Url::BaseUrl() . "/assets/eye-off.svg" ?>> </i>
                </span>
            </div>
        </div>
        <div class="input-group mb-4">
            <input type="password" name="=konfirmasiPasswordRegister" class="input form-control" id="password2" placeholder="Password" required aria-label="password" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <span class="input-group-text" onclick="showHide2();">
                    <i class="fas fa-eye" id="show_eye1"><img src=<?= Url::BaseUrl() . "/assets/eye.svg" ?> alt="" srcset=""></i>
                    <i class="fas fa-eye d-none" id="hide_eye1"> <img src=<?= Url::BaseUrl() . "/assets/eye-off.svg" ?>> </i>
                </span>
            </div>
        </div>

        <div class="mb-4">
            <input type="number" class="form-control" id="validationCustom01" required placeholder="No Hp" name="nohpRegister">
        </div>
        <div id="form-penyedia">
            <div class="row mb-3">
                <div class="col-8">
                    <?php
                    $url = Url::BaseApi() . "/api/jenisusaha/findallget";
                    $decode = file_get_contents($url, true);
                    $decodeData = json_decode($decode , true);
                    ?>
                    <select class="form-select" aria-label="Default select example" id="id_select" name="jenis_usaha" required>
                    <?php
                    foreach ($decodeData['body'] as $key => $value) {
                      ?>
                      <option value="<?=$value['id'] ?>"><?=$value['jenis'] ?></option>
                    <?php }
                    ?>
                    </select>
                </div>
            </div>
            <div class="mb-5">
                <textarea class="form-control" placeholder="Masukan Alamat Perusahaan , " id="validationCustom01" name="alamat" required></textarea>
              
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="submit" value="submit">Submit</button>
    </form>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict';
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    function password_show_hide() {
        var x = document.getElementById("password1");


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

    function showHide2() {
        var show_eye1 = document.getElementById("show_eye1");
        var hide_eye1 = document.getElementById("hide_eye1");
        var y = document.getElementById('password2');
        hide_eye1.classList.remove("d-none");
        if (y.type == "password") {
            y.type = "text";
            show_eye1.style.display = "none";
            hide_eye1.style.display = "block";
        } else {
            y.type = "password";
            show_eye1.style.display = "block";
            hide_eye1.style.display = "none";
        }
    }
</script>