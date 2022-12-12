<?php

use LearnPhpMvc\Config\Url;
?>
<!-- Button trigger modal -->

<!-- Modal -->
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h5 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>
  <div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Magang Yang sudah di iklankan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $model['jumlahMagang'] ?></div>
              <div class="mt-2 mb-0 text-muted text-xs">
              </div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-2x fa-briefcase text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Magang Yang Sedang di tempati</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $model['jumlahMagangYangDitempati'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-solid fa-handshake fa-2x text-secondary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Lamaran Masuk</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $model['jumlahLamaranMasuk'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-solid fa-angles-down fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pemagang</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $model['jumlahPemagang'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-regular fa-id-badge fa-2x text-secondary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <div class="dropdown no-arrow">
              <!-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a> -->
            <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header"> Tampilkan Menurut</div>
              <a class="dropdown-item" href="#">Naik</a>
              <a class="dropdown-item" href="#">Turun</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div> -->
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <div class="chart-bar">
              <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-sm-12 col-md-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Lamaran Masuk</h6>
          <div class="dropdown no-arrow">
            <!-- <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Month <i class="fas fa-chevron-down"></i>
            </a> -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Select Periode</div>
              <a class="dropdown-item" href="#">Today</a>
              <a class="dropdown-item" href="#">Week</a>
              <a class="dropdown-item active" href="#">Month</a>
              <a class="dropdown-item" href="#">This Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table">
            <table class="table align-items-center table-flush table-responsive" id="tableLamaranDashboard">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Nama Pelamar</th>
                  <th>Posisi Magang</th>
                  <th>Action </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $counter = 0;
                foreach ($model['lamaran']['body'] as $key => $value) {
                  # code...
                  $counter++;
                ?>
                  <tr>
                    <td>
                      <?php echo $counter ?>
                    </td>
                    <td>
                      <?= $value['nama_magang'] ?>
                    </td>
                    <td>
                      <?= $value['posisi_magang'] ?>
                    </td>
                    <td>
                      <div class="row">
                        <div class="col-6">
                          <button data-toggle="modal" data-target="#modalLamaran" id="dataPelamar" class="btn btn-warning" data-posisi="<?= $value['posisi_magang'] ?>" data-nama="<?= $value['nama_magang'] ?>" data-cv="<?= $value['cv'] ?>" data-sl="<?= $value['surat_lamaran'] ?>" data-penghargaan="<?= $value['file_penghargaan'] ?>" data-email=<?= $value['email'] ?> data-agama="<?= $value['agama'] ?>" data-jk="<?= $value['jenis_kelamin'] ?>" data-foto="/<?= $value['foto'] ?>" data-pencari="<?= $value['id_pencari'] ?>" data-idmagang="<?= $value['id_magang'] ?>"> <i class="fa-solid fa-info"></i></span></button>
                        </div>
                        <div class="col-6">
                          <a href="" class="tolakLamaran2 btn btn-danger" data-idmagang="<?= $value['id_magang'] ?>" data-pencari="<?= $value['id_pencari'] ?>">
                            <span style="color: white;">
                              <i class="fa-solid fa-xmark" style="color: white;"></i>
                            </span>
                          </a>
                        </div>
                      </div>

                    </td>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-center">
          <a class="m-0 small text-primary card-link" href="<?= Url::BaseUrl() . "/company/home/dashboard/lamaran" ?>">View More <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </div>
  </div>
  <!-- Scrollable modal -->
  <!-- Button trigger modal -->
</div>

<!-- modal detail pelamar -->
<div class="modal fade" id="modalLamaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Data Pelamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="row">
            <div class="col-lg-4">
              <img class="rounded-0 shadow" style="height: 200px; " alt="Foto profile pelamar" id="image-pelamar">
            </div>
            <div class="col-lg-8">
              <div class="row">
                <label for="staticEmail" class="col-lg-4 col-form-label">Nama Lengkap :</label>
                <div class="col-lg-8">
                  <input type="text" readonly class="form-control-plaintext" id="namaLenkap" value="email@example.com">
                </div>
              </div>
              <div class="row">
                <label for="staticEmail" class="col-lg-4 col-form-label">Posisi Magang :</label>
                <div class="col-lg-8">
                  <input type="text" readonly class="form-control-plaintext" id="posisi" value="email@example.com">
                </div>
              </div>

              <div class="row">
                <label for="staticEmail" class="col-lg-4 col-form-label">Surat Lamaran:</label>
                <div class="col-lg-8">
                  <input type="text" readonly class="form-control-plaintext" id="sl" value="email@example.com">
                </div>
              </div>
              <div class="row">
                <label for="staticEmail" class="col-lg-4 col-form-label">Email :</label>
                <div class="col-lg-8">
                  <input type="text" readonly class="form-control-plaintext" id="email" value="email@example.com">
                </div>
              </div>
              <div class="row">
                <label for="staticEmail" class="col-lg-4 col-form-label">Agama :</label>
                <div class="col-lg-8">
                  <input type="text" readonly class="form-control-plaintext" id="agama" value="email@example.com">
                </div>
              </div>
              <div class="row">
                <label for="staticEmail" class="col-lg-4 col-form-label">jenis Kelamin:</label>
                <div class="col-lg-8">
                  <input type="text" readonly class="form-control-plaintext" id="jk" value="email@example.com">
                </div>
              </div>
              <div class="row">
                <label for="staticEmail" class="col-lg-4 col-form-label">Cv / resume :</label>
                <div class="col-lg-4">
                  <input type="text" readonly class="form-control-plaintext" id="cv" value="email@example.com" style="width: 150px;">
                </div>
                <div class="col-2">
                  <a class="viewCv" href="">View</a>
                </div>
                <div class="col-2">
                  <a class="downloadCv" href="">Download</a>
                </div>
              </div>
              <div class="row justify-content-between">
                <label for="staticEmail" class="col-lg-4 col-form-label">penghargaan:</label>
                <div class="col-lg-4">
                  <input type="text" class="form-control-plaintext" readonly id="penghargaan" style="width: 150px;">
                </div>
                <div class="col-2">
                  <a class="viewPenghargaan" href="">View</a>
                </div>
                <div class="col-2">
                  <a class="downloadPenghargaan" href="">Download</a>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="" class="terimaLamaran">
              <button type="button" class="btn btn-primary">Terima Lamaran</button>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>