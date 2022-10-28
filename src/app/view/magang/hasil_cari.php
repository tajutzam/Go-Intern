<?php

require_once __DIR__ . "/../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;
?>

<div class="jumbotron-magang">
    <div class="text-search-magang">
        <h1 class="text-center justify-content-center"><span style="color: #4356FF ;"> Search </span> Magang</h1>
    </div>
    <div class="logo-magang text-center ">
        <img class="logo-magang-cls" src=<?= Url::BaseUrl() . "/assets/logo-magang.png"; ?> alt="" style="height: 380px; margin-top: -50px;">
    </div>
</div>
<div class="search-box-magang">
    <form action=<?= Url::BaseUrl() . "/magang/cari/nama?" ?> class="p-4" method="GET">
        <div class="input-group mb-3">
            <a href=<?= Url::BaseUrl() . "/magang/cari/nama" ?> style="cursor: pointer;">
                <span class="input-group-text" id="basic-addon1"><img src=<?= Url::BaseUrl() . "/assets/search.svg"; ?> alt=""></span>
            </a>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </form>
</div>
<div class="judu-hasil-cari text-center">
    <h2 style="margin-top: 140px;">Hasil Pencarian</h2>
</div>
<?php
$length = 3; // ambil data length di db 
for ($i = 0; $i < 3; $i++) {
?>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card mx-auto zam-card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Frontend</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Teknik Informatika</h6>
                    <div class="row justify-content-evenly">
                        <div class="col-6">
                            Rp. 500.000 - 1.000.000
                        </div>
                        <div class="col-6">
                            <img class="rounded-circle" src="https://picsum.photos/200/200" alt="" style="height: 60px; margin-left: 30px;">
                        </div>
                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-6">
                            Indonesia , jember
                        </div>
                        <div class="col-6">
                            <a href=<?= Url::BaseUrl() . "/magang/detail" ?>>
                                <div class="btn btn-primary" style=" width: 7rem; padding-left: 5px; padding-right: 5px;">
                                    <span style="font-size: 15px ;"> Detail</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card mx-auto zam-card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Frontend</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Teknik Informatika</h6>
                    <div class="row justify-content-evenly">
                        <div class="col-6">
                            Rp. 500.000 - 1.000.000
                        </div>
                        <div class="col-6">
                            <img class="rounded-circle" src="https://picsum.photos/200/200" alt="" style="height: 60px; margin-left: 30px;">
                        </div>
                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-6">
                            Indonesia , jember
                        </div>
                        <div class="col-6">
                            <a href=<?= Url::BaseUrl() . "/magang/detail" ?>>
                                <div class="btn btn-primary" style=" width: 7rem; padding-left: 5px; padding-right: 5px;">
                                    <span style="font-size: 15px ;"> Detail</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card mx-auto zam-card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Frontend</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Teknik Informatika</h6>
                    <div class="row justify-content-evenly">
                        <div class="col-6">
                            Rp. 500.000 - 1.000.000
                        </div>
                        <div class="col-6">
                            <img class="rounded-circle" src="https://picsum.photos/200/200" alt="" style="height: 60px; margin-left: 30px;">
                        </div>
                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-6">
                            Indonesia , jember
                        </div>
                        <div class="col-6">
                            <a href=<?= Url::BaseUrl() . "/magang/detail" ?>>
                                <div class="btn btn-primary" style=" width: 7rem; padding-left: 5px; padding-right: 5px;">
                                    <span style="font-size: 15px ;"> Detail</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card mx-auto zam-card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Frontend</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Teknik Informatika</h6>
                    <div class="row justify-content-evenly">
                        <div class="col-6">
                            Rp. 500.000 - 1.000.000
                        </div>
                        <div class="col-6">
                            <img class="rounded-circle" src="https://picsum.photos/200/200" alt="" style="height: 60px; margin-left: 30px;">
                        </div>
                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-6">
                            Indonesia , jember
                        </div>
                        <div class="col-6">
                            <a href=<?= Url::BaseUrl() . "/magang/detail" ?>>
                                <div class="btn btn-primary" style=" width: 7rem; padding-left: 5px; padding-right: 5px;">
                                    <span style="font-size: 15px ;"> Detail</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>