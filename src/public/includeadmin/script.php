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


<script>
  $(document).on('click', '#btnUpdateJurusan', function() {
    console.log('update');
    var id = $(this).data('id');
    var jurusan = $(this).data('jrs');
    $('#jurusan').val(jurusan);
    $('#idjurusan').val(id);
  });
  var baseurl = "<?= Url::BaseUrl() ?>";
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

  $(document).on('click', '#fieldUpdateJenis', function() {
    var jenis = $(this).data('jenis');
    var id = $(this).data('id');
    $('#jenisUsahaUp').val(jenis);
    $('#id').val(id);
  });
</script>


<script>
  $(function() {
    $("#example2").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,

    });
  });
</script>

</body>

</html>