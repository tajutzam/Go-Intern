<?php

use LearnPhpMvc\Config\Url;

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php

    ?>
    <div class="col-lg-3 col-6 mt-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h5>Jumlah Sekolah</h5>
                <?PHP
                if ($model['data']['status'] == 'ok') {
                    echo count($model['data']['data']);
                } else {
                    echo 0;
                }
                ?>
            </div>
            <div class="icon">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sekolah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= Url::BaseUrl()."/admin/home" ?>">Home</a></li>
                        <li class="breadcrumb-item active">Sekolah</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSekolah">
                                Tambah Sekolah
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sekolah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($model['data']['status'] == 'ok') {
                                        $count = 0;
                                        foreach ($model['data']['data'] as $key => $value) {
                                            # code...
                                    ?>
                                            <tr>
                                                <td><?= $count + 1 ?></td>
                                                <td><?= $value['nama_sekolah'] ?></td>
                                                <td>
                                                    <div class="row justify-content-evenly">
                                                        <div class="col-lg-4" id="fieldUpdateSekolah" data-sekolah="<?= $value['nama_sekolah'] ?>" data-id="<?= $value['id'] ?>">
                                                            <div class="btn btn-warning" data-toggle="modal" data-target="#updateSekolah">
                                                                <span style="color: white;"> <i class="fa-solid fa-pen-to-square"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 deletebtn" data-id="<?= $value['id'] ?>">
                                                            <a class="btn btn-danger deleteSekolah">
                                                                <span style="color: white;"> <i class="fa-solid fa-trash"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $count++;
                                        } ?>
                                    <?php }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="tambahSekolah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= Url::BaseUrl() . "/admin/sekolah/add" ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Sekolah</label>
                        <input required type="text" class="form-control" id="exampleFormControlInput1" placeholder="SMKN 1 TEGALSARI" name="sekolah">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- modal update sekolah -->
<div class="modal fade" id="updateSekolah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalLabel">Edit Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= Url::BaseUrl() . "/admin/sekolah/update" ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Sekolah</label>
                        <input type="text" class="form-control" id="sekolahUp" placeholder="SMKN 1 TEGALSARI" name="sekolah">
                    </div>
            </div>
            <input type="text" hidden id="id" name="id">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>