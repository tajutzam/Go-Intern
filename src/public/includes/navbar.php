<?php

use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Session\MySession;

$session = MySession::getCurrentSession();


?>
<!-- Sidebar -->

<script src="https://kit.fontawesome.com/9f20f8d82b.js" crossorigin="anonymous"></script>

<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src=<?= Url::BaseUrl() . "/assets/logo.png" ?>>
        </div>
        <div class="sidebar-brand-text mx-3">GO INTERN</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
            <span>Selamat pagi , <?php echo $model['result'][0]['nama_perusahaan'] ?></span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href=<?= Url::BaseUrl() . "/company/home/dashboard" ?>   data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= Url::BaseUrl() . "/company/home/dashboard/tambah/magang" ?>" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Forms</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Forms</h6>
                <a class="collapse-item" href="<?= Url::BaseUrl() . "/company/home/dashboard/tambah/magang" ?>">Form Magang</a>
                <a class="collapse-item" href="form_advanceds.html">Form Pemagang</a>
                <a class="collapse-item" href="<?= Url::BaseUrl()."/company/home/dashboard/lamaran" ?>">Form Lamaran</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Examples
    </div>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
            <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <span class="badge badge-warning badge-counter">2</span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been
                                    having.</div>
                                <div class="small text-gray-500">Udin Cilok · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/girl.png" style="max-width: 60px" alt="">
                                <div class="status-indicator bg-default"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                                    say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Jaenab · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-tasks fa-fw"></i>
                        <span class="badge badge-success badge-counter">3</span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Task
                        </h6>
                        <a class="dropdown-item align-items-center" href="#">
                            <div class="mb-3">
                                <div class="small text-gray-500">Design Button
                                    <div class="small float-right"><b>50%</b></div>
                                </div>
                                <div class="progress" style="height: 12px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item align-items-center" href="#">
                            <div class="mb-3">
                                <div class="small text-gray-500">Make Beautiful Transitions
                                    <div class="small float-right"><b>30%</b></div>
                                </div>
                                <div class="progress" style="height: 12px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item align-items-center" href="#">
                            <div class="mb-3">
                                <div class="small text-gray-500">Create Pie Chart
                                    <div class="small float-right"><b>75%</b></div>
                                </div>
                                <div class="progress" style="height: 12px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
                    </div>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <!-- show modal proffile -->
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="<?= Url::BaseUrl() . "/image/penyedia/" . $session[0]['foto'] ?>" style="max-width: 60px">
                        <span class="ml-2 d-none d-lg-inline text-white small"><?= $model['result'][0]['nama_perusahaan'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalProfile" id="#modalScroll">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Authentication Setting
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Topbar -->

        <!-- Modal Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to logout?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <a href="login.html" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Data Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= Url::BaseUrl() . "/company/home/dashboard/update/data" ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username harus diawali dengan hurus besar" value="<?= $model['result'][0]['username'] ?>" name="usernameUpdate">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Nama Lengkap" value="<?= $model['result'][0]['nama_perusahaan'] ?>" name="namaPerusahaanUpdate">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">No telp</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukan No Telp" value="<?= $model['result'][0]['no_telp'] ?>" name="no_telpUpdate">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Alamat Perusahaan</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Alamat Perusahaan" value="<?= $model['result'][0]['alamat'] ?>" name="alamatUpdate">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Email" value="<?= $model['result'][0]['email'] ?>" name="emailUpdate">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Jenis Usaha</label>
                                <select class="custom-select" id="inputGroupSelect01" name="jenisUsahaUpdate" aria-label="Default select example">
                                    < <?php
                                        $url = Url::BaseApi() . "/api/jenisusaha/findall";
                                        $data = file_get_contents($url);
                                        $decoded = json_decode($data, true);
                                        for ($i = 0; $i < sizeof($decoded['body']); $i++) {
                                        ?> <option value=<?= $decoded['body'][$i]['id'] ?>><?= $decoded['body'][$i]['jenis'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3">
                                    Image
                                </div>
                                <div class="col-9">
                                    <input type="file" name="image" accept="image/jpg , image/png , image/jpeg">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="simpan-profile">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

       