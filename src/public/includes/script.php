<?php

use LearnPhpMvc\Config\Url;
?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="http://localhost:8081/includes/jquery/jquery.min.js"></script>
<script src=<?= Url::BaseUrl() . "/includes/js/popover.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/jquery/jquery.min.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/bootstrap/js/bootstrap.bundle.min.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/jquery-easing/jquery.easing.min.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/js/ruang-admin.min.js" ?>></script>
<script src=<?= Url::BaseUrl() . "/includes/chart.js/Chart.min.js" ?>></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<!-- <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script> -->
<script>
    var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    var yValues = [55, 49, 44, 24, 15];
    var barColors = ["red", "green", "blue", "orange", "brown"];
    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Daftar posisi magang yang paling banyak diminati"
            }
        }
    });

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
            const mySkill = item_skill.split(",");
            console.log(mySkill);
            var skilFinal = mySkill.filter(item => !(item == ""));
            var skillAsString = skilFinal.join();
            var data = [
                item_id, item_posisi, item_kategori, item_lama_magang, item_status, item_jumlah_maksimal, item_jumlah_saatini, item_deskripsi, item_salary, skillAsString
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
            $('#syarat_update').val(skillAsString).change();
            $('#salary_update').val(item_salary);

        })
        $('#table-magang').DataTable({});
        $('#table-lamaran').DataTable();
        $('#tableLamaranDashboard').DataTable();
        var data_penghargaan;
        var data_cv;
        var data_nama;
        var pencari;
        var idMagang;
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
            pencari = $(this).data('pencari');
            idMagang = $(this).data('idmagang');
            console.log(idMagang);
            console.log(pencari);
            $('#namaLenkap').val(data_nama);
            $('#posisi').val(posisi);
            $('#cv').val(data_cv);
            $('#sl').val(data_suratLamaran);
            $('#email').val(data_email);
            $('#agama').val(data_agama);
            $('#jk').val(data_jenisKelamin);
            $('#penghargaan').val(data_penghargaan);
            console.log(dataFoto == "/");
            if (dataFoto == "/") {
                if (data_jenisKelamin == "L") {
                    dataFoto = "man.png";
                } else if (data_jenisKelamin == "P") {
                    dataFoto = "woman.png";
                }
            }
            console.log(dataFoto);
            const urlImage = `${baseUrl+"/image/pencari_magang/"+dataFoto}`;
            $('#image-pelamar').attr('src', urlImage.toString());
            console.log($('#image-pelamar'));
        })
        // VIEW PENGHARGAAN
        $(document).on('click', ".viewPenghargaan", function() {
            window.open(baseUrl + "/dokuments/penghargaan/" + data_penghargaan, '_blank').focus();
        })
        // VIEW CV
        $(document).on('click', ".viewCv", function() {
            window.open(baseUrl + "/dokuments/cv/" + data_cv, '_blank').focus();
        })
        // DOWNLOAD CV
        $(document).on('click', ".downloadCv", function() {
            $(".downloadCv").attr("href", baseUrl + "/download/cv/" + data_cv.replace(/\.[^/.]+$/, "" + "/" + data_nama.replace(/\s/g, '') + "cv"))
        })
        // VIEW CV
        $(document).on('click', ".viewCv2", function() {
            data_cv = $(this).data('cv');
            console.log(data_cv)
            window.open(baseUrl + "/dokuments/cv/" + data_cv, '_blank').focus();
        })
        // DOWNLOAD CV
        $(document).on('click', ".downloadCv2", function() {
            data_cv = $(this).data('cv');
            data_nama = $(this).data('nama');
            $(".downloadCv2").attr("href", baseUrl + "/download/cv/" + data_cv.replace(/\.[^/.]+$/, "" + "/" + data_nama.replace(/\s/g, "") + "cv"))
        })
        // DOWNLOAD PENGHARGAAN
        $(document).on('click', ".downloadPenghargaan2", function() {
            data_penghargaan = $(this).data('penghargaan');
            data_nama = $(this).data('nama');
            $(".downloadPenghargaan2").attr("href", baseUrl + "/download/penghargaan/" + data_penghargaan.replace(/\.[^/.]+$/, "" + "/" + data_nama.replace(/\s/g, '') + "penghargaan"))
        })
        // DOWNLOAD PENGHARGAAN
        $(document).on('click', ".downloadPenghargaan", function() {
            $(".downloadPenghargaan").attr("href", baseUrl + "/download/penghargaan/" + data_penghargaan.replace(/\.[^/.]+$/, "" + "/" + data_nama.replace(/\s/g, '') + "penghargaan"))
        })

        // TOLAK LAMARAN 
        $(document).on('click', ".tolakLamaran", function() {
            var idMagang = $(this).data('idmagang');
            var idPencari = $(this).data('pencari');
            $(".tolakLamaran").attr("href", baseUrl + "/company/home/dashboard/lamaran/tolak/" + idPencari + "/" + idMagang)
            console.log($(".tolakLamaran"))
            console.log('after klick');
        })
        // VIEW PENGHARGAAN
        $(document).on('click', ".viewPenghargaan2", function() {
            data_penghargaan = $(this).data('penghargaan');
            window.open(baseUrl + "/dokuments/penghargaan/" + data_penghargaan, '_blank').focus();
        })
        // TOLAK LAMARAN LEWAT LINK 
        $(document).on('click', '.tolakLamaran2', function() {
            var idMagang = $(this).data('idmagang');
            var idPencari = $(this).data('pencari');
            $(".tolakLamaran2").attr("href", baseUrl + "/company/home/dashboard/lamaran/tolak/" + idPencari + "/" + idMagang)
            console.log($(".tolakLamaran"))
            console.log('after klick');
        });
        var cv;
        var nama;
        var penghargaan;
        // SET DATA MODAL PEMAGANG
        $(document).on('click', '#detailPemagangbtn', function() {
            var foto = $(this).data('foto');
            var posisi = $(this).data('posisi');
            nama = $(this).data('nama');
            var jenisKelamin = $(this).data('jeniskelamin');
            var sekolah = $(this).data('sekolah');
            var jurusan = $(this).data('jurusan');
            var starton = $(this).data('starton');
            var finishOn = $(this).data('finishon');
            var durasi = $(this).data('durasi');
            var email = $(this).data('email');
            penghargaan = $(this).data('penghargaan');
            console.log(penghargaan);
            cv = $(this).data('cv');
            var agama = $(this).data('agama');
            var notelp = $(this).data('notelp');
            var tanggallahir = $(this).data('tanggallahir');
            var tentangsaya = $(this).data('tentangsaya');
            $('#posisipemagang').val(posisi);
            $('#namapemagang').val(nama);
            $('#jenisKelaminpemagang').val(jenisKelamin);
            $('#sekolahpemagang').val(sekolah);
            $('#mulaipemagang').val(starton);
            $('#selesaipemagang').val(finishOn);
            $('#durasipemagang').val(durasi);
            $('#emailPemagang').val(email);
            $('#cvPemagang').val(cv);
            if (agama == "") {
                $('#agamaPemagang').val("Agama not set");
            } else {
                $('#agamaPemagang').val(agama);
            }
            $('#no_telpPemagang').val(notelp);
            $('#tgllahirPemagang').val(tanggallahir);
            $('#tentangPemagang').val(tentangsaya);
            if (foto == "") {
                if (jenisKelamin == "L") {
                    foto = "man.png"
                } else {
                    foto = "woman.png"
                }
            }
            const url = baseUrl + "/image/pencari_magang/" + foto;
            $("#fotopemagang").attr('src', url.toString());
            console.log(url);
            console.log(email);
            console.log(agama);
            console.log(tanggallahir)
        });
        $(document).on('click', ".viewCvPemagang", function() {
            console.log(cv)
            window.open(baseUrl + "/dokuments/cv/" + cv, '_blank').focus();
        })
        // download cv
        $(document).on('click', ".downloadCvPemagang", function() {
            $(".downloadCvPemagang").attr("href", baseUrl + "/download/cv/" + cv.replace(/\.[^/.]+$/, "" + "/" + nama.replace(/\s/g, "") + "cv"))
        })

        $(document).on('click', ".viewPenghargaanPemagang", function() {
            window.open(baseUrl + "/dokuments/penghargaan/" + penghargaan, '_blank').focus();
        })

        $(document).on('click', ".downloadPenghargaanPemagang", function() {
            $(".downloadPenghargaanPemagang").attr("href", baseUrl + "/download/penghargaan/" + penghargaan.replace(/\.[^/.]+$/, "" + "/" + nama.replace(/\s/g, '') + "penghargaan"))
        })

        // function to delete pemagang with api
        $(document).on('click', '.keluarkanPemagang', function() {
            var id = $(this).data('id');
            var pemagang = $(this).data('pemagang');
            console.log(id);
            console.log(pemagang)
            var confirmToDelete = confirm('yakin ingin mengeluarkan pemagang ?');
            if (confirmToDelete) {
                console.log('in');
                fetch(baseUrl + '/company/home/dashboard/kick', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            "idlowongan": id,
                            "pemagang": pemagang
                        })
                    })
                    .then(response => response.json())
                    .then(response => console.log(JSON.stringify(response)))
            } else {
                console.log('cancel');
                console.log(pemagang);
                console.log(id);
            }
        });

        $(document).on('click', '#deleteData', function() {
            var id = $(this).data('id');
            var confirmToDelete = confirm('yakin ingin menghapus data magang?');
            if (confirmToDelete) {
                console.log('in');
                var response = fetch(baseUrl + '/company/home/dashboard/tambah/magang/delete', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "id": id,
                    })
                });
                response.then((response) => {
                    const jsonPromise = response.json();
                    console.log(jsonPromise);
                    jsonPromise.then((data) => {
                        window.location.reload();
                        alert(data.message);
                    });
                });
            } else {
                console.log('cancel');
                console.log(pemagang);
                console.log(id);
            }
        })
        $(document).on('click', '.terimaLamaran', function() {
            var response = fetch(baseUrl + '/company/home/dashboard/terimawithjs', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "idPencari": pencari,
                    "idmagang": idMagang
                })
            });
            response.then((response) => {
                const jsonPromise = response.json();
                console.log(jsonPromise);
                jsonPromise.then((data) => {
                    window.location.reload();
                    alert(data.message);
                });
            });

        })
    })
</script>