  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://gamamulti.com">Gama Multi</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

 
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../admin/asset/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../admin/asset/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Select2 -->
<script src="../admin/asset/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../admin/asset/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../admin/asset/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../admin/asset/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../admin/asset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../admin/asset/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../admin/asset/plugins/moment/moment.min.js"></script>
<script src="../admin/asset/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../admin/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../admin/asset/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../admin/asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/asset/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../admin/asset/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../admin/asset/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="../admin/asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../admin/asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../admin/asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../admin/asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../admin/asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../admin/asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../admin/asset/plugins/jszip/jszip.min.js"></script>
<script src="../admin/asset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../admin/asset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../admin/asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../admin/asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../admin/asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    //Date picker2
    $('#reservationdate2').datetimepicker({
        format: 'DD-MM-YYYY'
    });
  });
</script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
</body>
</html>
