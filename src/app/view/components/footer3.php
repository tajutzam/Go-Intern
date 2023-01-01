<?php
require_once __DIR__ . "/../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;
?>
<div class="footer-bekerjasama">
    <div class="judul text-center">
        <h2> Kami Bekerja Sama Dengan</h2>
    </div>
    <div class="container-fluid text-center">
        <div class="row mt-5">
            <a href="http://jti.polije.ac.id/" class="img1 col-lg-4 mt-5 col-md-12 col-sm-12">
                <img src=<?= Url::BaseUrl() . "/assets/logo-jti-hitam.png" ?> alt="" style="height: 100px;">
            </a>
            <a href="https://polije.ac.id/" target="_blank" class="img2 col-lg-4 col-md-12 col-sm-12">
                <img src=<?= Url::BaseUrl() . "/assets/logo-polije.png" ?> alt="" style="height: 200px;">
            </a>
            <a href="https://digitalent.kominfo.go.id/" class="img3 col-lg-4 col-md-12 col-sm-12" style="margin-top: -60px ;">
                <img src=<?= Url::BaseUrl() . "/assets/logo-kominfo.png" ?> alt="" style="height: 300px;">
            </a>
        </div>
    </div>
</div>