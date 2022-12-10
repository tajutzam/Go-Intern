<?php

use LearnPhpMvc\Config\Url;
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4 container">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lamaran Magang</li>
    </ol>
</div>
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <div class="col-4">
                    <div class="fotoprofile">
                        <img class="img-profile rounded-circle" style="height: 200px ; max-width: 200px; max-height: 200px;" src="<?= Url::BaseUrl() . "/image/penyedia/" . $model['result'][0]['foto'] ?>" alt="Foto profile">
                    </div>
                </div>
                <div class="col-5" style="margin-top: 100px ;">
                    <input hidden id="file_input" type="file">
                    <button class="mt-5 ml-3 btn btn-primary" style="height: 40px ;">
                        <label for="file_input">Ganti foto</label>
                    </button>
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <form action="<?= Url::BaseUrl() . "/company/home/dashboard/profile/update" ?>" method="post" enctype="multipart/form-data">
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="simpan-profile">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function fixAspect(img) {
        var $img = $(img),
            width = $img.width(),
            height = $img.height(),
            tallAndNarrow = width / height < 1;
        if (tallAndNarrow) {
            $img.addClass('tallAndNarrow');
        }
        $img.addClass('loaded');
    }

    function loadURLToInputFiled(url) {
        getImgURL(url, (imgBlob) => {
            // Load img blob to input
            // WIP: UTF8 character error
            let fileName = 'hasFilename.jpg'
            let file = new File([imgBlob], fileName, {
                type: "image/jpeg",
                lastModified: new Date().getTime()
            }, 'utf-8');
            let container = new DataTransfer();
            container.items.add(file);
            document.querySelector('#file_input').files = container.files;

        })
    }
</script>