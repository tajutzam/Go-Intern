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
                <h5>Jumlah Penyedia</h5>

                <?php
                if($model['data']['status'] == 'oke'){
                    echo count($model['data']['body']);
                }else{
                    echo 0;
                }
                ?>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penyedia</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= Url::BaseUrl()."/admin/home" ?>">Home</a></li>
                        <li class="breadcrumb-item active">Penyedia</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Penyedia</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Alamat Perusahaan</th>
                                        <th>Email</th>
                                        <th>Status</th>
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
                                                <td><?= $value['nama_perusahaan'] ?></td>
                                                <td><?= $value['alamat_perusahaan'] ?></td>
                                                <td><?= $value['email'] ?></td>
                                                <td><?= $value['status'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($value['status'] == 'aktif') {
                                                    ?>
                                                        <div class="btn-disable-penyedia" data-id= "<?=  $value['id']?>">
                                                        <a class="btn btn-danger" id="penyedia-disable">Disable</a>
                                                        </div>
                                                    <?php } else {
                                                    ?>
                                                       <div class="btn-enable-penyedia" data-id="<?= $value['id'] ?>">
                                                       <a id="penyedia-enable" class="btn btn-success">Enable</a>
                                                       </div>
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php $count++; } ?>
                                    <?php ; }
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