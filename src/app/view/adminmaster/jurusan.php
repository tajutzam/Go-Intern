<?php

use LearnPhpMvc\Config\Url;



?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="col-lg-3 col-6 mt-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h5>Jumlah Jurusan</h5>

                <?php
                if ($model['data']['status'] == 'oke') {
                    echo count($model['data']['body']);
                } else {
                    echo 0;
                } ?>

            </div>
            <div class="icon">
                <i class="fa-solid fa-building"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jurusan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= Url::BaseUrl()."/admin/home" ?>">Home</a></li>
                        <li class="breadcrumb-item active">Jurusan</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusan">
                                Tambah jurusan
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jurusan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($model['data']['status'] == 'oke') {
                                        $count = 0;
                                        foreach ($model['data']['body'] as $key => $value) {
                                            # code...
                                    ?>
                                            <tr>
                                                <td><?= $count + 1 ?></td>
                                                <td><?= $value['jurusan'] ?></td>
                                                <td>
                                                    <div class="row justify-content-evenly">
                                                        <div class="col-lg-4" id="btnUpdateJurusan" data-jrs="<?= $value['jurusan'] ?>" data-id="<?= $value['id'] ?>">
                                                            <div class="btn btn-warning" data-toggle="modal" data-target="#updateJurusan">
                                                                <span style="color: white;"> <i class="fa-solid fa-pen-to-square"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 deleteJurusan" data-id="<?= $value['id'] ?>">
                                                            <a href="" class="deleteLinkJurusan">
                                                                <div class="btn btn-danger">
                                                                    <span style="color: white;"> <i class="fa-solid fa-trash"></i></span>
                                                                </div>
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


<!-- Modal tambah jurusan-->
<div class="modal fade" id="tambahJurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jurusan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= Url::BaseUrl() . "/admin/jurusan/add" ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Jurusan</label>
                        <input required name="jurusan" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Teknik Komputer Dan Jaringan" required oninvalid="this.setCustomValidity('Jurusan Tidak Boleh Kosong')" oninput="setCustomValidity('')">
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
<div class="modal fade" id="updateJurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= Url::BaseUrl() . "/admin/jurusan/update" ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Jurusan</label>
                        <input required type="text" class="form-control" id="jurusan" placeholder="TEKNIK KOMPUTER" name="updateJurusan" required oninvalid="this.setCustomValidity('Jurusan tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <input hidden id="idjurusan" name="id"></input>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>