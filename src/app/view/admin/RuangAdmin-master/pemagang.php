<?php

use LearnPhpMvc\Config\Url;
?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <h1 class="h5 mb-0 text-gray-800">Pemagang</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pemagang</li>
        </ol>
    </div>
</div>
<div class="">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Pemagang Yang Aktif</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                                                            if ($model['dataPemagang']['status'] == "oke") {
                                                                                echo count($model['dataPemagang']['body']);
                                                                            } else {
                                                                                echo 0;
                                                                            }
                                                                            ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-solid fa-angles-down fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12 col-lg-12  mb-4 mx-auto" style="margin-bottom: 1000px;">
    <div class="card">
        <div class="table-responsive mt-4">
            <table class="table align-items-center table-flush table-magang p-2" id="table-lamaran">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Posisi Magang</th>
                        <th>Nama Pelamar</th>
                        <th>Jenis Kelamin</th>
                        <th>Sekolah</th>
                        <th>Jurusan</th>
                        <th>Start Magang</th>
                        <th>finish Magang</th>
                        <th>Durasi Tersisa</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    if ($model['dataPemagang']['status'] == "oke") {
                    ?>
                        <?php
                        foreach ($model['dataPemagang']['body'] as $key => $value) {
                            # code...
                            $count++;
                        ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $value['posisi_magang'] ?></td>
                                <td><?= $value['nama_pemagang'] ?></td>
                                <td><?= $value['jenis_kelamin'] ?></td>
                                <td><?= $value['nama_sekolah'] ?></td>
                                <td><?= $value['jurusan'] ?></td>
                                <td><?= $value['start_on'] ?></td>
                                <td><?= $value['finish_on'] ?></td>
                                <td><?= $value['selesai dalam'] ?></td>
                                <td>
                                    <div class="row justify-content-between">
                                        <button id="detailPemagangbtn" data-toggle="modal" data-target="#modalDetailPemagang" class="btn btn-primary" data-posisi="<?= $value['posisi_magang'] ?>" data-nama="<?= $value['nama_pemagang'] ?>" data-jeniskelamin="<?= $value['jenis_kelamin'] ?>" data-sekolah="<?= $value['nama_sekolah'] ?>" data-jurusan="<?= $value['jurusan'] ?>" data-starton="<?= $value['start_on'] ?>" data-finishon="<?= $value['finish_on'] ?>" data-durasi="<?= $value['selesai dalam'] ?>" data-email="<?= $value['email'] ?>" data-cv="<?= $value['cv'] ?>" data-agama="<?= $value['agama'] ?>" data-notelp="<?= $value['no_telp'] ?>" data-tanggallahir="<?= $value['tanggal_lahir'] ?>" data-foto="<?= $value['foto'] ?>" data-tentangsaya="<?= $value['tentang_saya'] ?>" data-penghargaan="<?= $value['penghargaan'] ?>">
                                            <i class="fa-solid fa-info"></i>
                                        </button>
                                        <a href="" class="keluarkanPemagang" data-id="<?= $value['id'] ?>" data-pemagang="<?= $value['pemagang'] ?>">
                                            <button href="" class="btn btn-danger">
                                                <span style="color: white;">
                                                    <i class="fa-solid fa-xmark" style="color: white;"></i>
                                                </span>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    <?php };
                    ?>

                </tbody>
            </table>

        </div>
        <div class="card-footer"></div>
    </div>
</div>
<!--  modal pemagang detail -->
<div class="modal fade" id="modalDetailPemagang" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Data Pemagang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="img-profile rounded" style="max-height: 250px;" id="fotopemagang" src="" alt="foto pemagang">
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Posisi Yang di tempati</label>.
                                        <input id="posisipemagang" type="text" readonly class="form-control-plaintext" id="floatingPlaintextInput" value="Posisi yang ditempati">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Nama Pemagang</label>
                                        <input id="namapemagang" type="email" id="namaPemagang" readonly class="form-control-plaintext" id="floatingPlaintextInput" placeholder="name@example.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Jenis Kelamin</label>
                                        <input id="jenisKelaminpemagang" type="text" id="jeniskelaminPemagang" readonly class="form-control-plaintext" id="floatingPlaintextInput" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Asal Sekolah</label>
                                        <input id="sekolahpemagang" id="sekolahPemagang" type="text" readonly class="form-control-plaintext" id="floatingPlaintextInput" placeholder="name@example.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Mulai magang pada</label>
                                        <input id="mulaipemagang" id="mulaiPemagang" type="text" readonly class="form-control-plaintext" id="floatingPlaintextInput" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Selesai Magang pada</label>
                                        <input id="selesaipemagang" id="selesaiPemagang" type="email" readonly class="form-control-plaintext" id="floatingPlaintextInput" placeholder="name@example.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Durasi Magang Yang tersisa</label>
                                        <input id="durasipemagang" id="durasiPemagang" type="email" readonly class="form-control-plaintext" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Email</label>
                                        <input type="email" readonly id="emailPemagang" class="form-control-plaintext" placeholder="name@example.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="form-floating mb-1">
                                            <div class="col-6">
                                                <label for="floatingPlaintextInput">CV</label>
                                            </div>
                                            <div class="col-7">
                                                <div class="row justify-content-between">
                                                    <div class="col-6">
                                                        <a class="viewCvPemagang" href="">
                                                            <span class="btn btn-primary"> view</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="" class="downloadCvPemagang">
                                                            <span class="btn btn-success">Download</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="form-floating mb-1">
                                            <div class="col-6">
                                                <label for="floatingPlaintextInput">Penghargaan</label>
                                            </div>
                                            <div class="col-7">
                                                <div class="row justify-content-between">
                                                    <div class="col-6">
                                                        <a class="viewPenghargaanPemagang" href="">
                                                            <span class="btn btn-primary">view</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="" class="downloadPenghargaanPemagang">
                                                            <span class="btn btn-success">Download</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">No telp</label>
                                        <input type="email" readonly id="no_telpPemagang" class="form-control-plaintext" id="floatingPlaintextInput" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Tanggal Lahir</label>
                                        <input type="email" readonly id="tgllahirPemagang" class="form-control-plaintext">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Tentang Saya</label>
                                        <input type="email" readonly id="tentangPemagang" class="form-control-plaintext" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-1">
                                        <label for="floatingPlaintextInput">Agama</label>
                                        <input type="email" id="agamaPemagang" readonly class="form-control-plaintext" placeholder="name@example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>