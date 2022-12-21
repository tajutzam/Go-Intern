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
                <h5>Jumlah Pencari</h5>

                <?php
                if($model['data']['status'] == 'oke'){
                    echo count($model['data']['datum']);
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
                    <h1>Pencari</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= Url::BaseUrl()."/admin/home" ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pencari</li>
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
                            <h3 class="card-title">Data Pencari</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pencari</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($model['data']['status'] == 'oke') {
                                        $count = 0;
                                        foreach ($model['data']['datum'] as $key => $value) {
                                            # code...
                                    ?>
                                            <tr>
                                                <td><?= $count + 1 ?></td>
                                                <td><?= $value['nama'] ?></td>
                                                <td><?= $value['email'] ?></td>
                                                <td><?= $value['status'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($value['status'] == 'aktif') {
                                                    ?>
                                                       <div class="btn-disable" data-id="<?= $value['id'] ?>"> <a class="btn btn-danger" id="user-disable" data-id="<?= $value['id'] ?>">Disable</a></div>
                                                    <?php } else {
                                                    ?>
                                                       <div class="btn-enable" data-id="<?= $value['id'] ?>">
                                                       <a  class="btn btn-success" id="user-enable" data-id="<?= $value['id'] ?>">Enable</a>
                                                       </div>
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php $count++; } ?>
                                    <?php ; }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                             <th>No</th>
                                        <th>Nama Pencari</th>
                                        <th>Email</th>
                                        <th>Status</th>
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