<?php

use LearnPhpMvc\Config\Url;
?>

<script src="http://localhost:8081/includes/jquery/jquery.min.js"></script>
<script src=<?= Url::BaseUrl() . "/includes/js/popover.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/jquery/jquery.min.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/bootstrap/js/bootstrap.bundle.min.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/jquery-easing/jquery.easing.min.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/js/ruang-admin.min.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/chart.js/Chart.min.js" ?>></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script> -->
<script>
    var baseUrl = "http://localhost:8081";
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var item_id = $(this).data('id');
            console.log(item_id);
            var item_posisi = $(this).data('posisi');
            var item_kategori = $(this).data('kategori');
            var item_lama_magang = $(this).data('lama_magang');
            var item_status = $(this).data('status');
            var item_jumlah_maksimal = $(this).data('jumlah-maksimal');
            var item_jumlah_saatini = $(this).data('jumlah-saatini');
            var item_deskripsi = $(this).data('deskripsi');
            var item_skill = $(this).data('syarat');
            var item_salary = $(this).data('salary');
            console.log(item_skill);
            var data = [
                item_id, item_posisi, item_kategori, item_lama_magang, item_status, item_jumlah_maksimal, item_jumlah_saatini, item_deskripsi, item_skill
            ];
            document.cookie = "updateDataGoIntern = " + data + ";";
            $('#posisi_update').val(item_posisi);
            $('#id_update').val(item_id);
            $('#kategori_update').val(item_kategori).change();
            $('#lama_magang_update').val(item_lama_magang);
            $('#status').val(item_status);
            $('#jumlah_maksimal_update').val(item_jumlah_maksimal);
            $('#jumlah_saatini_update').val(item_jumlah_saatini);
            $('#deskripsi_update').val(item_deskripsi);
            $('#syarat_update').val(item_skill).change();
            $('#salary_update').val(item_salary);
        })
        $('#table-magang').DataTable();
        $('#table-lamaran').DataTable();
        $('#tableLamaranDashboard').DataTable();
        var data_penghargaan;
        var data_cv;
        var data_nama;
        $(document).on('click', '#dataPelamar', function() {
            var posisi = $(this).data('posisi');
            data_nama = $(this).data('nama');
            data_cv = $(this).data('cv');
            var data_suratLamaran = $(this).data('sl');
            data_penghargaan = $(this).data('penghargaan');
            var data_email = $(this).data('email');
            var data_agama = $(this).data('agama');
            var data_jenisKelamin = $(this).data('jk');
            var dataFoto = $(this).data('foto');
            $('#namaLenkap').val(data_nama);
            $('#posisi').val(posisi);
            $('#cv').val(data_cv);
            $('#sl').val(data_suratLamaran);
            $('#email').val(data_email);
            $('#agama').val(data_agama);
            $('#jk').val(data_jenisKelamin);
            $('#penghargaan').val(data_penghargaan);
            const urlImage = `${baseUrl+"/image/pencari_magang"+dataFoto}`;
            $('#image-pelamar').attr('src', urlImage.toString());
        })
        $(document).on('click', ".viewPenghargaan", function() {
            window.open(baseUrl + "/dokuments/penghargaan/" + data_penghargaan, '_blank').focus();
        })
        $(document).on('click', ".viewCv", function() {

            window.open(baseUrl + "/dokuments/cv/" + data_cv, '_blank').focus();
        })
        $(document).on('click', ".downloadCv", function() {
            $(".downloadCv").attr("href", baseUrl + "/download/cv/" + data_cv.replace(/\.[^/.]+$/, "" + "/" + data_nama.replace(/\s/g , '') + "cv"))
        })
        $(document).on('click', ".viewCv2", function() {
            data_cv = $(this).data('cv');
            console.log(data_cv)
            window.open(baseUrl + "/dokuments/cv/" + data_cv, '_blank').focus();
        })

        $(document).on('click', ".downloadCv2", function() {
            data_cv = $(this).data('cv');
            data_nama = $(this).data('nama');
            $(".downloadCv2").attr("href", baseUrl + "/download/cv/" + data_cv.replace(/\.[^/.]+$/, "" + "/" + data_nama.replace(/\s/g , "") + "cv"))
        })
        $(document).on('click', ".downloadPenghargaan2", function() {
            data_penghargaan = $(this).data('penghargaan');
            data_nama = $(this).data('nama');
            $(".downloadPenghargaan2").attr("href", baseUrl + "/download/penghargaan/" + data_penghargaan.replace(/\.[^/.]+$/, "" + "/" + data_nama.replace(/\s/g, '') + "penghargaan"))
        })
        $(document).on('click', ".downloadPenghargaan", function() {
            $(".downloadPenghargaan").attr("href", baseUrl + "/download/penghargaan/" + data_penghargaan.replace(/\.[^/.]+$/, "" + "/" + data_nama.replace(/\s/g, '') + "penghargaan"))
        })

        $(document).on('click', "#tolakLamaran", function() {
            var idMagang = $(this).data('idmagang');
            var idPencari =  $(this).data('pencari');
            console.log(idMagang);
            console.log(idPencari);
            $("#tolakLamaran").attr("href", baseUrl + "/company/home/dashboard/lamaran/tolak/"+idPencari+"/"+idMagang)
        })

        $(document).on('click', ".viewPenghargaan2", function() {
            data_penghargaan = $(this).data('penghargaan');
            window.open(baseUrl + "/dokuments/penghargaan/" + data_penghargaan, '_blank').focus();
        })
       



    })
</script>