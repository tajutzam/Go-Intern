<?php
require_once __DIR__ . "/../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;
?>
<div class="jumbotron-magang">
    <div class="text-search-magang">
        <h1 class="text-center justify-content-center"><span style="color: #4356FF ;"> Search </span> Companies</h1>
    </div>
    <div class="logo-magang text-center ">
        <img class="logo-magang-cls" src=<?= Url::BaseUrl() . "/assets/logo-magang.png"; ?> alt="" style="height: 380px; margin-top: -50px;">
    </div>
</div>

<div class="search-box-company mb-4">
    <form action="" class="p-4">
        <div class="input-group mb-3">
            <a href="" style="cursor: pointer;">
                <span class="input-group-text" id="basic-addon1"><img src=<?= Url::BaseUrl() . "/assets/search.svg"; ?> alt=""></span>
            </a>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </form>
</div>

<div class="d-flex justify-content-center" style="margin-top: 100px ;">
    <h3 class="font-weight-bold">Most Popular Company</h3>
</div>

<div class="card" style="width: 65%;">
    <div class="card-body">
        <div class="row mb-5">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img class="img-company-popular" src=<?= Url::BaseUrl() . "/assets/logo-poltek.png" ?> alt="" style="height: 400px;">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <p style="font-size: 20px ;">Politeknik Negeri Jember adalah Companie yang sudah merekrut para pemagang lewat Go Intern Lebih Dari 100 Pemagang
                    alamat Politeknik Negeri Jember
                    Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121</p>
                <ul>
                    <li style="font-size: 20px;">Software Engginer</li>
                    <li style="font-size: 20px;">Backend Developer</li>
                    <li style="font-size: 20px;">Ui/UX</li>
                    <li style="font-size: 20px;">Software Tester</li>
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href=<?= Url::BaseUrl() . "/company/detail" ?> style="color: white ; width: 8rem;" class="zam-btn btn btn-primary">Detail</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php for ($i = 0; $i < 2; $i++) {
    ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 form-control-sm">
                <div class="card mx-auto zam-card " style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <div class="row">
                                <div class="col-8">
                                    Polije
                                </div>
                                <div class="col-4">
                                    <img src=<?= Url::BaseUrl() . "/assets/logo-poltek.png" ?> alt="" style="height: 80px ;">
                                </div>
                            </div>
                        </h5>
                        <h6 class="card-subtitle mb-2">Jumlah Lowongan Tersedia</h6>
                        <h3>100</h3>
                        <div class="row justify-content-between mt-3">
                            <div class="col-6">
                                Indonesia , jember
                            </div>
                            <div class="col-6">
                                <a href=<?= Url::BaseUrl() . "/company/detail" ?>>
                                    <div class="btn btn-primary" style=" width: 6rem;">
                                        <span style="font-size: 15px ;"> Detail</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 form-control-sm">
                <div class="card mx-auto zam-card " style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <div class="row">
                                <div class="col-8">
                                    Polije
                                </div>
                                <div class="col-4">
                                    <img src=<?= Url::BaseUrl() . "/assets/logo-poltek.png" ?> alt="" style="height: 80px ;">
                                </div>
                            </div>
                        </h5>
                        <h6 class="card-subtitle mb-2">Jumlah Lowongan Tersedia</h6>
                        <h3>100</h3>
                        <div class="row justify-content-between mt-3">
                            <div class="col-6">
                                Indonesia , jember
                            </div>
                            <div class="col-6">
                                <a href=<?= Url::BaseUrl() . "/company/detail" ?>>
                                    <div class="btn btn-primary" style=" width: 6rem;">
                                        <span style="font-size: 15px ;"> Detail</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 form-control-sm">
                <div class="card mx-auto zam-card " style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <div class="row">
                                <div class="col-8">
                                    Polije
                                </div>
                                <div class="col-4">
                                    <img src=<?= Url::BaseUrl() . "/assets/logo-poltek.png" ?> alt="" style="height: 80px ;">
                                </div>
                            </div>
                        </h5>
                        <h6 class="card-subtitle mb-2">Jumlah Lowongan Tersedia</h6>
                        <h3>100</h3>
                        <div class="row justify-content-between mt-3">
                            <div class="col-6">
                                Indonesia , jember
                            </div>
                            <div class="col-6">
                                <a href=<?= Url::BaseUrl() . "/company/detail" ?>>
                                    <div class="btn btn-primary" style=" width: 6rem;">
                                        <span style="font-size: 15px ;"> Detail</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 form-control-sm">
                <div class="card mx-auto zam-card " style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <div class="row">
                                <div class="col-8">
                                    Polije
                                </div>
                                <div class="col-4">
                                    <img src=<?= Url::BaseUrl() . "/assets/logo-poltek.png" ?> alt="" style="height: 80px ;">
                                </div>
                            </div>
                        </h5>
                        <h6 class="card-subtitle mb-2">Jumlah Lowongan Tersedia</h6>
                        <h3>100</h3>
                        <div class="row justify-content-between mt-3">
                            <div class="col-6">
                                Indonesia , jember
                            </div>
                            <div class="col-6">
                                <a href=<?= Url::BaseUrl() . "/company/detail" ?>>
                                    <div class="btn btn-primary" style=" width: 6rem;">
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
</div>