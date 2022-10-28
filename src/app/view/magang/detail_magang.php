<?php
require_once __DIR__ . "/../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;
?>

<div class="jumbotron-magang">
    <div class="text-search-magang">
        <h1 class="text-center justify-content-center"><span style="color: #4356FF ;"> Detail </span> Magang</h1>
    </div>
    <div class="logo-magang text-center ">
        <img class="logo-magang-cls" src=<?= Url::BaseUrl() . "/assets/logo-magang.png"; ?> alt="" style="height: 380px; margin-top: -50px;">
    </div>
</div>

<div class="detail-box-magang p-4 justify-content-center">
    <img class="mb-3" src=<?= Url::BaseUrl() . "/assets/logo-poltek.png" ?> alt="logo-perushaan" style="height: 200px;">
    <h3 class="mb-4">Software Enginer</h3>
    <p class="p-butuh">Kami membutuhkan seseorang untuk mengisi posisi Sebagai software engginer intern pada perushaan kami</p>
    <h3 class="mb-4">Minimum Skill Dibutuhkan</h3>
    <ul class="list-skill">
        <li>
            <p>Menguasai fundamental bahasa pemogrman java</p>
        </li>
        <li>
            <p>Dapat mengoprasikan Komputer</p>
        </li>
        <li>
            <p>Dapat mengoprasikan Komputer</p>
        </li>
    </ul>
    <h3 class="mb-4">Durasi Magang</h3>
    <h4 class="durasi">6 Bulan</h4>
    <br>
    <br>
    <div class="d-flex justify-content-center">
        <button class="btn-apply-now" data-bs-toggle="modal" data-bs-target="#apply" type="submit">Apply Now</button>
    </div>
</div>

<div class="modal" id= "apply" tabindex="-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Berhasil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <p>Lamaran Mu Sudah Terkirim <img src=<?= Url::BaseUrl()."/assets/done.svg" ?> alt=""></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

