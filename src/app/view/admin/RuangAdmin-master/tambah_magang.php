<?php

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

$count = 0;
?>
<?php
if (isset($_SESSION['succes'])) {
?>
    <div class="card-body">
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h6><i class="fas fa-check"></i><b> Success!</b></h6>
            A simple success alert—check it out!
        </div>

    </div> <?php
            unset($_SESSION['alert']);
        }
            ?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Magang</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">magang</li>
        </ol>
    </div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Magang</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($model['magang']['body']) ? count($model['magang']['body']) : 0 ?></div>
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
<div class="col-xl-12 col-lg-12  mb-4 mx-auto">
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll">Tambah Data</button>
        </div>

        <div class="table-responsive">
            <table class="table align-items-center table-flush table-magang" id="table-magang">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>JOB MAGANG</th>
                        <th>Kategori</th>
                        <th>Durasi Magang</th>
                        <th>Status</th>
                        <th>Jumlah Maksimal</th>
                        <th>Jumlah Saat ini</th>
                        <th>Desripsi Magang</th>
                        <th>Action</th>
                        <th hidden>Action</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (!isset($model['magang']['body'])) {
                    ?>
                        <!-- <tr>
                            <td>Tidak ada data magang Silahkan tambah data</td>
                        </tr> -->
                        <?php } else {

                        for ($i = 0; $i < sizeof($model['magang']['body']); $i++) {
                        ?>
                            <tr>
                                <td><?= $i + 1 ?></td>

                                <td><?= $model['magang']['body'][$i]['posisi_magang'] ?></td>
                                <td><?= $model['magang']['body'][$i]['kategori'] ?></td>
                                <td><?= $model['magang']['body'][$i]['lama_magang'] . " Bulan" ?></td>
                                <td><span class="badge badge-warning py-1 px-3"><?= $model['magang']['body'][$i]['status'] ?></span></td>
                                <td><?= $model['magang']['body'][$i]['jumlah_maksimal'] ?></td>
                                <td><?= $model['magang']['body'][$i]['jumlah_saatini'] ?></td>
                                <td><?= $model['magang']['body'][$i]['deskripsi'] ?></td>
                                <td hidden>
                                    <?php
                                    for ($j = $count; $j < sizeof($model['magang']['body']); $j++) {
                                        if ($model['magang']['body'][$i]['syarat'][0] != null) {
                                            for ($h = 0; $h < sizeof($model['magang']['body'][$i]['syarat'][0]); $h++) {
                                                # code...
                                                if ($j <= sizeof($model['magang']['body'][$i]['syarat'][0])) {
                                                    echo $model['magang']['body'][$i]['syarat'][$j][$h]['syarat'] . ",";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="" local data-toggle="modal" data-target="#exampleModalScrollableUpdate" id="select" data-id="<?= $model['magang']['body'][$i]['id'] ?>" data-posisi="<?= $model['magang']['body'][$i]['posisi_magang'] ?>" data-kategori="<?= $model['magang']['body'][$i]['id_kategori'] ?>" data-lama_magang="<?= $model['magang']['body'][$i]['lama_magang'] ?>" data-status="<?= $model['magang']['body'][$i]['status'] ?>" data-jumlah-maksimal="<?= $model['magang']['body'][$i]['jumlah_maksimal'] ?>" data-jumlah-saatini="<?= $model['magang']['body'][$i]['jumlah_saatini'] ?>" data-deskripsi="<?= $model['magang']['body'][$i]['deskripsi'] ?>" data-salary="<?= $model['magang']['body'][$i]['salary'] ?>" data-syarat="<?php for ($j = $count; $j < sizeof($model['magang']['body']); $j++) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                if ($model['magang']['body'][$i]['syarat'][0] != null) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    for ($h = 0; $h < sizeof($model['magang']['body'][$i]['syarat'][0]); $h++) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        # code...
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        if ($j <= sizeof($model['magang']['body'][$i]['syarat'][0])) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            echo $model['magang']['body'][$i]['syarat'][$j][$h]['syarat'] . ",";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ?>" ;>
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                        <div class="col-lg-6" id="deleteData" data-id="<?= $model['magang']['body'][$i]['id'] ?>">
                                            <?= $model[''] ?>
                                            <a href="<?= Url::BaseUrl() . "/company/home/dashboard/tambah/magang/delete/" . $model['magang']['body'][$i]['id'] ?>" id="linkDelete">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php }
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="card-footer"></div>
    </div>
</div>

<!-- Modal Scrollable -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Data Magang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-bold"></h5>
                <form action=<?= Url::BaseUrl() . "/company/home/dashboard/tambah/magang/save" ?> method="post">
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Posisi Magang</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="posisi_magang" required="true">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="kategori">
                            < <?php
                                $url = Url::BaseApi() . "/api/kategori/all";
                                $data = file_get_contents($url);
                                $decoded = json_decode($data, true);
                                // var_dump($decoded['body'][0]);
                                for ($i = 0; $i < sizeof($decoded['body']); $i++) {
                                ?> <option value=<?= $decoded['body'][$i]['id'] ?>><?= $decoded['body'][$i]['kategori'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Lama Magang</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Masukan dalam satuan bulan" aria-describedby="emailHelp" name="lama_magang" required="true">
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Jumlah Maksimal</label>
                        <input type="number" class="form-control" placeholder="Jumlah maksimal lowongan" id="exampleInputEmail1" aria-describedby="emailHelp" name="jumlah_maksimal" required="true">
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Salary</label>
                        <input type="number" class="form-control" placeholder="Masukan Salary Tanpa titik" id="exampleInputEmail1" aria-describedby="emailHelp" name="salary" required="true">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Syarat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Pisahkan dengan (Koma)" name="syarat" required="true"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Deskripsi Magang</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan Deskripsi Magang" name="deskripsi" required="true"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Scrollable  update -->
<div class="modal fade" id="exampleModalScrollableUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Update Data Magang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" hidden id="id_update" value="">
                <h5 class="font-weight-bold"></h5>
                <form action=<?= Url::BaseUrl() . "/company/home/dashboard/tambah/magang/update" ?> method="post">
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Posisi Magang</label>
                        <input type="text" class="form-control" id="posisi_update" aria-describedby="emailHelp" name="posisi_magangUpdate" required="true">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                        </div>
                        <select class="custom-select" name="kategoriUpdate" id="kategori_update">
                            < <?php
                                $url = Url::BaseApi() . "/api/kategori/all";
                                $data = file_get_contents($url);
                                $decoded = json_decode($data, true);
                                // var_dump($decoded['body'][0]);
                                for ($i = 0; $i < sizeof($decoded['body']); $i++) {
                                ?> <option value=<?= $decoded['body'][$i]['id'] ?>><?= $decoded['body'][$i]['kategori'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Lama Magang</label>
                        <input type="number" id="lama_magang_update" class="form-control" placeholder="Masukan dalam satuan bulan" aria-describedby="emailHelp" name="lama_magangUpdate" required="true">
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Jumlah Maksimal</label>
                        <input type="number" id="jumlah_maksimal_update" class="form-control" placeholder="Jumlah maksimal lowongan" aria-describedby="emailHelp" name="jumlah_maksimalUpdate" required="true">
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Salary</label>
                        <input type="number" id="salary_update" class="form-control" placeholder="Jumlah maksimal lowongan" aria-describedby="emailHelp" name="jumlah_maksimalUpdate" required="true">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Syarat</label>
                        <textarea class="form-control" id="syarat_update" rows="3" placeholder="Pisahkan dengan (Koma)" name="syaratUpdate" required="true"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Deskripsi Magang</label>
                        <textarea class="form-control" id="deskripsi_update" rows="3" placeholder="Masukan Deskripsi Magang" name="deskripsiUpdate" required="true"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php

?>