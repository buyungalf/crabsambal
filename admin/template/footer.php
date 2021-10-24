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
<script src="asset/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="asset/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="asset/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="asset/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="asset/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="asset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="asset/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="asset/plugins/moment/moment.min.js"></script>
<script src="asset/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="asset/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="asset/dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="asset/dist/js/demo.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="asset/dist/js/pages/dashboard.js"></script>
<!-- jQuery -->
<script src="asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="asset/plugins/jszip/jszip.min.js"></script>
<script src="asset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="asset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="asset/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="asset/plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="asset/plugins/flot/plugins/jquery.flot.pie.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="asset/dist/js/demo.js"></script>
<!-- AdminLTE App -->
<script src="asset/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="asset/dist/js/demo.js"></script>
<!-- Page specific script -->
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
  });
</script> 
<script src="asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Page specific script -->
<!-- InputMask -->
<script src="asset/plugins/moment/moment.min.js"></script>
<script src="asset/plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  $(function () {
    //Datetime picker
    $('#reservationdatetime').datetimepicker({ 
      format: 'DD-MM-YYYY HH:mm:ss'
    });
    $('#reservationdatetime1').datetimepicker({ 
      format: 'DD-MM-YYYY HH:mm:ss'
    });
    $('#reservationdate').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('#reservationdate1').datetimepicker({
        format: 'DD-MM-YYYY'
    });
  })
</script>


<script>
  $(function () {
    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data        = [],
        totalPoints = 100

    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [
      <?php
        include "../lib/config.php";
        include "../lib/koneksi.php";
        $query = mysqli_query($koneksi, "SELECT sum(total) as tt, thn_trans FROM tb_trans_tot GROUP BY thn_trans ORDER BY thn_trans");
        $i=1;
        while($o=mysqli_fetch_array($query)){
          $y = $o['tt'];
          
          echo "[$i,$y],";
          $i++;
        }
      ?>
      
        // [1,0],
        // [2,0],
        // [3,0], 
        ],
      bars: { show: true }
    }
    $.plot('#bar-chart-2', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [
          <?php
            include "../lib/config.php";
            include "../lib/koneksi.php";
            $query = mysqli_query($koneksi, "SELECT DISTINCT thn_trans FROM tb_trans_tot ORDER BY thn_trans");
            $i=1;
            $y=0;
            while($o=mysqli_fetch_array($query)){
              $y = $o['thn_trans'];
              echo "[$i,'$y'],";
              $i++;
            }
          ?> 
        ]
      }
    })
    /* END BAR CHART */

  })

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>
<script>
  $(function () {

    /*
     * DONUT CHART
     * -----------
     */
     <?php
        include "../lib/config.php";
        include "../lib/koneksi.php";
        $query = mysqli_query($koneksi, "SELECT sum(total) as total FROM tb_trans_tot");
        $i=0;
        $pie=mysqli_fetch_array($query);
        $total = $pie['total']/100;
        $colors = array("#3c8dbc", "#98ACF8", "#293B5F");
     ?>

    var donutData = [
      <?php
        include "../lib/config.php";
        include "../lib/koneksi.php";
        $query = mysqli_query($koneksi, "SELECT sum(total) as tt, thn_trans FROM tb_trans_tot GROUP BY thn_trans ORDER BY thn_trans");
        $i=0;
        while($o=mysqli_fetch_array($query)){
          $label = $o['thn_trans'];
          $data = $o['tt']/$total;
          
          echo "{
          label: 'Thn $label',
          data : $data,
          color: '$colors[$i]'
        },";
        $i++;
        }
      ?>
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */

  })

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>
<script>
  $(function () {
    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data        = [],
        totalPoints = 100

    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [
      <?php
      if (!empty($_GET['tahun'])) {
        $tahun = $_GET['tahun'];
      }
        include "../lib/config.php";
        include "../lib/koneksi.php";
        $query = mysqli_query($koneksi, "SELECT bln_trans, sum(total) as tt FROM tb_trans_tot WHERE thn_trans = $tahun GROUP BY bln_trans");
        $i=0;
        while($o=mysqli_fetch_array($query)){
          $i = $o['bln_trans'];
          $y = $o['tt'];
          
          echo "[$i,$y],";
          
        }
      ?>
         
        [1,0],
        [2,0],
        [3,0], 
        [4,0], 
        [5,0], 
        [6,0], 
        [7,0],
        [8,0],
        [9,0],
        [10,0],
        [11,0],
        [12,0]
        ],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [
          [1,'Januari'], 
          [2,'Februari'], 
          [3,'Maret'], 
          [4,'April'], 
          [5,'Mei'], 
          [6,'Juni'], 
          [7,'Juli'], 
          [8,'Agustus'], 
          [9,'September'], 
          [10,'Oktober'], 
          [11,'November'], 
          [12,'Desember']
        ]
      }
    })
    /* END BAR CHART */

  })

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="asset/plugins/flot/plugins/jquery.flot.pie.js"></script>

</body>
</html>