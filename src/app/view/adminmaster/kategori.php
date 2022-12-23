<?php

use LearnPhpMvc\Config\Url;

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="col-lg-3 col-6 mt-3">
        <?php
        ?>
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h5>Jumlah Kategori</h5>
                <?php
                if ($model['data']['status'] == 'ok') {
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
                    <h1>Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= Url::BaseUrl() . "/admin/home" ?>">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKategori">
                                Tambah Kategori
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Foto Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($model['data']['status'] == 'ok') {
                                        $count = 0;
                                        foreach ($model['data']['body'] as $key => $value) {
                                            # code...
                                    ?>
                                            <tr>
                                                <td><?= $count + 1 ?></td>
                                                <td><?= $value['kategori'] ?></td>
                                                <td><img src="<?= Url::BaseUrl() . "/image/kategori/" . $value['foto'] ?>" alt="kategori img" style="height: 100px;"></td>
                                                <td>
                                                    <div class="row justify-content-evenly">
                                                        <div class="col-lg-4" id="btnUpdateKategori" data-kategori="<?= $value['kategori'] ?>" data-id="<?= $value['id'] ?>" data-foto="<?= $value['foto'] ?>">
                                                            <div class="btn btn-warning" data-toggle="modal" data-target="#updateKategori">
                                                                <span style="color: white;"> <i class="fa-solid fa-pen-to-square"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 deleteKategori" data-id="<?= $value['id'] ?>">
                                                            <a href="" class="deleteLinkKategori">
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
<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= Url::BaseUrl() . "/admin/kategori/add" ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Kategori</label>
                        <input name="kategori" type="text" class="form-control" id="exampleFormControlInput1" placeholder="ESPORT" required oninvalid="this.setCustomValidity('kategori tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <label class="btn btn-secondary" for="file-upload" class="custom-file-upload">
                        Pilih foto
                    </label>
                    <!-- <input type="file" name="foto"> -->
                    <input id="file-upload" type="file" style="display:none;" name="foto" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal update sekolah -->
<div class="modal fade" id="updateKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= Url::BaseUrl() . "/admin/kategori/update" ?>" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Kategori</label>
                        <input required type="text" id="kategoriUp" class="form-control" id="jurusan" placeholder="TEKNIK KOMPUTER" name="updateKategori" required oninvalid="this.setCustomValidity('kategori tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <label class="btn btn-secondary" for="file-upload1" class="custom-file-upload">
                        <span id="nama-foto"></span>
                    </label>
                    <!-- <input type="file" name="foto"> -->
                    <input id="file-upload1" type="file" style="display:none;" name="fotoUpdate" accept="image/png, image/gif, image/jpeg">
                    <input hidden id="idKategori" name="id"></input>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>

</script>