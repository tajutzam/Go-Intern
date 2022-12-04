<?php

use LearnPhpMvc\Config\Url;

?>
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
</div>
<div class="row container">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Lamaran Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($model['lamaran']['body']) ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12 col-lg-12  mb-4 mx-auto container" style="margin-bottom: 1000px;">
    <div class="card">
        <div class="table-responsive mt-4">
            <table class="table align-items-center table-flush table-magang" id="table-lamaran">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Posisi Magang</th>
                        <th>Foto pelamar</th>
                        <th>Nama Pelamar</th>
                        <th>Surat Lamaran</th>
                        <th>Email pelamar</th>
                        <th>Agama</th>
                        <th>Jenis Kelamin</th>
                        <th>Sekolah</th>
                        <th>Jurusan</th>
                        <th>Skill</th>
                        <th>Tentang Pelamar</th>
                        <th>CV / Resume</th>
                        <th>Penghargaan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    if (count($model['lamaran']['body']) > 0) {
                        foreach ($model['lamaran']['body'] as $key => $value) {
                            # code...
                            $count++;
                    ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $value['posisi_magang'] ?></td>
                                <td>
                                    <img src="<?= Url::BaseUrl() . "/image/pencari_magang/" . $value['foto'] ?>" alt="" srcset="" style="height: 100px ;">
                                </td>
                                <td><?= $value['nama_magang'] ?></td>
                                <td style="max-lines: 2;"><?= $value['surat_lamaran'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['agama'] ?></td>
                                <td><?= $value['jenis_kelamin'] ?></td>
                                <td><?= $value['nama_sekolah'] ?></td>
                                <td><?= $value['jurusan'] ?></td>
                                <td><?php
                                    if (count($value['skilss']) == 0) {
                                        echo "tidak ada skils";
                                    } else {
                                        for ($i = 0; $i < count($value['skilss'][0]); $i++) {
                                            echo $value['skilss'][0][$i]['skill'] . ", ";
                                        }
                                    }
                                    ?></td>
                                <td><?= $value['tentang_saya'] ?></td>
                                <td><?php
                                    if ($value['cv'] != null) {
                                    ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href=""><i class="fa-regular fa-eye viewCv2" data-cv="<?= $value['cv'] ?>"></i></a>
                                            </div>
                                            <div class="col-6">
                                                <a href="" class="downloadCv2" data-cv="<?= $value['cv'] ?>" data-nama="<?= $value['nama_magang'] ?>"> <i class="fa-solid fa-download"></i></i></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td><?php if ($value['file_penghargaan'] != null) {
                                    ?>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="" class="viewPenghargaan2" data-penghargaan="<?= $value['file_penghargaan'] ?>"><i class="fa-regular fa-eye"></i></a>
                                            </div>
                                            <div class="col-6">
                                                <a href="" class="downloadPenghargaan2" data-penghargaan="<?= $value['file_penghargaan'] ?>" data-nama="<?= $value['nama_magang'] ?>"> <i class="fa-solid fa-download"></i></i></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="row justify-content-between">
                                        <a class="" href=""><i class="fa-solid fa-check"></i></a>
                                        <a href="" id="tolakLamaran" data-idmagang="<?= $value['id_magang'] ?>" data-pencari="<?= $value['id_pencari'] ?>">
                                            <i class="fa-solid fa-xmark" style="color: red;"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer"></div>
    </div>
</div>