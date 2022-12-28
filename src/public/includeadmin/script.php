<?php

use LearnPhpMvc\Config\Url;
?>


<!-- ./wrapper -->
<!-- jQuery -->
<script src="<?= Url::BaseUrl() ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= Url::BaseUrl() ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<script src="https://kit.fontawesome.com/9f20f8d82b.js" crossorigin="anonymous"></script>
<script src="<?= Url::BaseUrl() ?>/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>


<script>
  var baseurl = "<?= Url::BaseUrl() ?>";
  var domain = "<?= Url::domain() ?>";

  var responseUser = fetch(baseurl + '/api/admin/getuser')
    .then((response) => response.json())
    .then((data) => {
      if (data.status == "oke") {
        var xValues = [];
        var yValues = [];
        var barColors = [];

        data.body.forEach(element => {
          xValues.push(element.bulan);
          yValues.push(element.jumlah);
          var r = Math.floor(Math.random() * 256);
          var g = Math.floor(Math.random() * 256);
          var b = Math.floor(Math.random() * 256);
          var color = "rgb(" + r + "," + g + "," + b + ")";
          barColors.push(color);

        });
        new Chart("userChart", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "PIE CHART FOR USER REGISTER"
            }
          }
        });
      } else {
        new Chart("userChart", {
          type: "pie",
          data: {
            labels: "No data",
            datasets: [{
              backgroundColor: "red",
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "PIE CHART FOR USER REGISTER"
            }
          }
        });
      }
    });

  var responseUser = fetch(baseurl + '/api/admin/getcompany')
    .then((response) => response.json())
    .then((data) => {
      if (data.status == "oke") {
        var xValues = [];
        var yValues = [];
        var barColors = [];

        data.body.forEach(element => {
          xValues.push(element.bulan);
          yValues.push(element.jumlah);
          var r = Math.floor(Math.random() * 256);
          var g = Math.floor(Math.random() * 256);
          var b = Math.floor(Math.random() * 256);
          var color = "rgb(" + r + "," + g + "," + b + ")";
          barColors.push(color);

        });
        new Chart("companyChart", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "PIE CHART FOR COMPANY REGISTER"
            }
          }
        });
      } else {
        new Chart("companyChart", {
          type: "pie",
          data: {
            labels: "No data",
            datasets: [{
              backgroundColor: "red",
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "PIE CHART FOR USER REGISTER"
            }
          }
        });
      }
    });

  $(document).on('click', '#btnUpdateJurusan', function() {
    console.log('update');
    var id = $(this).data('id');
    var jurusan = $(this).data('jrs');
    $('#jurusan').val(jurusan);
    $('#idjurusan').val(id);
  });

  $(document).on('click', '.deleteJurusan', function() {
    var confirmDelete = confirm("yakin ingin menghapus Jurusan ?");
    if (confirmDelete) {
      var id = $(this).data('id');
      $(".deleteJurusan .deleteLinkJurusan").attr('href', baseurl + "/admin/jurusan/delete/" + id);
    }

  });
  $(document).on('click', '#fieldUpdateSekolah', function() {
    var sekolah = $(this).data('sekolah');
    console.log(sekolah);
    var id = $(this).data('id');
    $('#id').val(id);
    $("#sekolahUp").val(sekolah);
  });
  $(document).on('click', '.deletebtn', function() {
    var id = $(this).data('id');
    var confirmDelete = confirm("yakin ingin menghapus Sekolah ?");
    if (confirmDelete) {
      $(".deletebtn .deleteSekolah").attr('href', baseurl + "/admin/sekolah/delete/" + id);
    } else {

    }
  });
  $(document).on('click', '.deleteJenisBtn', function() {
    var id = $(this).data('id');
    var confirmDelete = confirm("yakin ingin menghapus Jenis Usaha ?");
    if (confirmDelete) {
      $(".deleteJenisBtn .deleteJenis").attr('href', baseurl + "/admin/jenisusaha/delete/" + id);
    } else {

    }
  });

  function get_cookie(name) {
    return document.cookie.split(';').some(c => {
      return c.trim().startsWith(name + '=');
    });
  }

  function delete_cookie(name, path, domain) {
    if (get_cookie(name)) {
      document.cookie = name + "=" +
        ((path) ? ";path=" + path : "") +
        ((domain) ? ";domain=" + domain : "") +
        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
    }
  }

  $(document).on('click', '#fieldUpdateJenis', function() {
    var jenis = $(this).data('jenis');
    var id = $(this).data('id');
    $('#jenisUsahaUp').val(jenis);
    $('#id').val(id);
  });

  $(document).on('click', "#logout", function() {
    var confirmToLogout = confirm("Apakah kamu yakin ingin logout ?");
    if (confirmToLogout) {
      document.cookie = "GO-INTERN-ADMIN=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      alert("Berhasil logout");
      console.log(document.cookie)
      location.replace(baseurl + "/admin/login");
    }
  });
  $(document).on('click', '.btn-enable', function() {
    var id = $(this).data('id');
    $(".btn-enable #user-enable").attr('href', baseurl + "/admin/pencarimagang/enable/" + id);
  });
  $(document).on('click', '.btn-disable', function() {
    var id = $(this).data('id');
    $(".btn-disable #user-disable").attr('href', baseurl + "/admin/pencarimagang/disable/" + id);
  });

  $(document).on('click', '.btn-enable-penyedia', function() {
    var id = $(this).data('id');
    $(".btn-enable-penyedia #penyedia-enable").attr('href', "/admin/penyedia/enable/" + id);
  });

  $(document).on('click', '.btn-disable-penyedia', function() {
    var id = $(this).data('id');
    $(".btn-disable-penyedia #penyedia-disable").attr('href', "/admin/penyedia/disable/" + id);
  });

  $(document).on('click', '.deleteKategori', function() {
    var id = $(this).data('id');
    console.log(id);
    console.log(baseurl+"/admin/kategori/delete/"+id);
    var isdelete = confirm('yakin ingin menghapus kategori');
    if (isdelete) {
      $(".deleteKategori .deleteLinkKategori").attr('href', "/admin/kategori/delete/" + id);
    } else {
      location.reload();
    }
  });
  $(document).on('click', '#btnUpdateKategori', function() {
    var kategori = $(this).data('kategori');
    var foto = $(this).data('foto');
    var id = $(this).data('id');
    console.log(foto);
    console.log(kategori);
    console.log(id);
    $("#kategoriUp").val(kategori);
    $("#nama-foto").text(foto);
    $("#idKategori").val(id);
  });
</script>
<script>
  $(function() {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      
    });
  });

  $('#file-upload').change(function() {
    var i = $(this).prev('label').clone();
    var file = $('#file-upload')[0].files[0].name;
    $(this).prev('label').text(file);
  });

  $('#file-upload1').change(function() {
    console.log("asdasd");
    var i = $(this).prev('label').clone();
    var file = $('#file-upload1')[0].files[0].name;
    $("#nama-foto").text(file);
  });
</script>

</body>

</html>