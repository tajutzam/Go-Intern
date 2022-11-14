<?php

require_once __DIR__ . "/../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;
// $model , data user

?>
<div class="jumbotron-company-home">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <h2 class="text-penyedia-home p-5" style="color: white; font-size: 50px;">Selamat Datang <br> <?=$model['result'][0]['nama_perusahaan'] ?></h2>
        </div>
        <div class="image-home col-lg-6 d-flex justify-content-end col-md-12 col-sm-12">
            <img src=<?= Url::BaseUrl() . "/assets/image-penyedia-home3.png" ?> alt="" style="height: 80vh; background-size:cover;">
        </div>
    </div>
</div>
<div class="jumbotron-company-none">
    <div class="row">
        <div class="col-lg-6 col-md-4 col-sm-4">
            <img class="image-2" src=<?= Url::BaseUrl() . "/assets/image-penyedia-home2.png" ?> alt="" style="height: 73vh; background-size:cover;">
        </div>
        <div class="image-none col-lg-6 d-flex justify-content-end col-md-8 col-sm-8">
            <h2 class="text-penyedia-none" style="color: #353535; font-size: 50px;">Go intern for <br> company <br>
                <a href=<?= Url::BaseUrl()."/company/home/dashboard" ?>>
                    <button class="btn btn-primary">Manage sekarang</button>
                </a>
            </h2>
        </div>
    </div>
</div>


