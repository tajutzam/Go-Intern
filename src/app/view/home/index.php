<!-- panggil view di controller -->
<?php
require_once __DIR__ . "/../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;
?>
<div class="jumbotron" style="overflow: hidden;">
    <div class="row">
        <div class="col-6 header-left" style="padding:  100px;">
            <h1 class="text-judul-v1" style="width: 100%; max-width: 400px;">
                Temukan Tempat <br>
                <span style="color:#4356FF;"> Magang</span> Terbaik <br>
                Hanya DI Go Intern
            </h1>
            <!-- cek apakah sudah login belum -->
            <!-- jika belum , login dulu -->
            <a href=<?= Url::BaseUrl() . "/magang" ?>>
                <button class="btn btn-primary mt-3">
                    <p style="font-family: poppins-semibold ; margin-top: 10px; margin-bottom: 10px;">Lamar Sekarang</p>
                </button>
            </a>
        </div>
        <div class="col-6  d-md-block  d-lg-block">
            <div class="kotak ms-auto" style="margin-top: -100 px;">
                <img src=<?php echo Url::BaseUrl() . "/assets/girl-landing-page.png" ?> alt="asdasd" style="height: 400px; margin-top: -100px;">
            </div>
        </div>
    </div>
</div>
<!-- start pelamar action -->
<div class="info-smile" style="height: 50% ; background-color:  white;" id="tentang-kami">
    <div class="row">
        <div class="cewek-senyumcol-lg-6 col-md-6 col-sm-6 col-xs-12 text-md-center d-sm-flex align-items-sm-center justify-content-sm-center">
            <div class="kotak-v2 h-auto d-sm-flex">
                <img class="cewek-senyum justify-content-md-center justify-content-sm-center" src=<?= Url::BaseUrl() . "/assets/cewek-senyum.png" ?> alt="" style="height: 550px ;">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="middle-rigth">
                <h2 class="kami-membantu-text">
                    Kami <span style="color: #4356FF ;">Adalah Sebuah Layanan </span> untuk membantu mu terhubung
                    dengan Para Penyedia magang maupun penyedia magang
                </h2>
                <h5 class="jasa-kami-text">
                    Dengan menggunakan Jasa Dari kami, kalian tidak perlu susah2 untuk datang ke tempat satu per satu untuk menanyakan terkait hal magang , cukup dengan duduk santai dirumah dan cari tempat magang favorite mu :)
                </h5>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="kiri">
                <img src=<?= Url::BaseUrl() . "/assets/kiri.png" ?> alt="kerja-sama" style="height: 100px;">
                <p class="">
                    Membantu mu mendapatkan pengalaman
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="kanan">
                <img src=<?php echo Url::BaseUrl() . "/assets/kanan.png" ?> alt="company" style="height: 100px;">
                <p class="">
                    Membantu Menaikan SoftSkill maupun HardSkill
                </p>
            </div>
        </div>
    </div>
</div>
<div class="content-head">
    <div class="container">
        <div class="left-head">
            <h1 class="judul-head">Tertarik Membuka
                <br> Lowongan magang ?
            </h1>
            <div class="row">
                <div class="col-6">
                    <a href=<?= Url::BaseUrl() . "/company/home" ?>>
                        <div class="btn btn-primary btn-left">
                            <h6 style="color: white">Pasang Iklan Lowongan Magang</h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-6 d-md-block  d-lg-block">
                <img class="laki" src=<?php echo Url::BaseUrl() . "/assets/laki.png" ?> alt="company" style="height: 400px;">
            </div>
        </div>
    </div>
</div>
<!-- end pelamar action -->