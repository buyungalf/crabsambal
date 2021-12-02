  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?module=home">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <div class="">
        <h3 class="card-title">Daftar Laporan</h3>
        <form action="module/laporan/content.php" method="GET">
          <div style="display: flex; justify-content: flex-end">
            <table>
              <tr>
                <td align="right">
                  <div class="input-group date col-sm-10" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="mulai" />
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
            <h3 class="card-title mt-2">sampai</h3>
            <table>
              <tr>
                <td align="left">
                  <div class="input-group date col-sm-10" id="reservationdate2" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate2" name="selesai" />
                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="input-group-btn mt-3 mr-5" style="display: flex; justify-content: flex-end">            
            <button class="btn btn-secondary" type="submit">Tampilkan </button>
          </div>
        </form>
      </div>
    </div>

<!-- /.card -->
  </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
