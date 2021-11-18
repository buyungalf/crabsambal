<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="col-12">
<!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Form Laporan Order</h3>
              </div>
              <div class="card-body">
<?php
echo "<input type=button value='Laporan Hari Ini' 
          onclick=\"window.location.href='pages/laporan/pdf_toko_sekarang.php';\"><br>

          <form method=POST action='pages/laporan/pdf_toko.php'>
          <table  border='1' cellpadding='10' cellspacing='0'>
          <tr><td colspan=2><b>Laporan Per Periode</b></td></tr>
          <tr><td>Dari Tanggal</td><td>
          <div class='input-group date' id='reservationdate' data-target-input='nearest'>
              <input type='text' class='form-control datetimepicker-input' data-target='#reservationdate' name='tanggal' placeholder='DD-MM-YYYY'/>
              <div class='input-group-append' data-target='#reservationdate' data-toggle='datetimepicker'>
                  <div class='input-group-text'><i class='fa fa-calendar'></i></div>
              </div>
          </div></td>

          </td></tr>
          <tr><td>s/d Tanggal</td><td>
          <div class='input-group date' id='reservationdate1' data-target-input='nearest'>
              <input type='text' class='form-control datetimepicker-input' data-target='#reservationdate1' name='tanggal1' placeholder='DD-MM-YYYY'/>
              <div class='input-group-append' data-target='#reservationdate1' data-toggle='datetimepicker'>
                  <div class='input-group-text'><i class='fa fa-calendar'></i></div>
              </div>
          </div></td>";

    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Proses></td></tr>
          </table>
          </form>";
?>
          </div>
        </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
