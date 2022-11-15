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



<script>
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
        })


    })

    // $(document).ready(function() {
    //     $(document).on('click', '#deleteData', function() {
    //         var link = document.getElementById('linkDelete');
    //         console.log(link);
    //         var item_id = $(this).data('id');
    //         console.log(item_id);
    //         link.href = "<?= Url::BaseUrl() . "/company/home/dashboard/tambah/magang/delete/" ?>" + item_id;
    //     })
    // })
</script>