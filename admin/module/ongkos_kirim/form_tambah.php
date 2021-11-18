  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ongkos Kirim</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Ongkos Kirim</li>
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
          <h3 class="card-title">Form Tambah Ongkos Kirim</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="module/ongkos_kirim/aksi.php" class="form-horizontal">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Kota</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_kota" placeholder="Nama Kota">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Ongkos Kirim</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="ongkos_kirim" placeholder="Ongkos Kirim">
              </div>
            </div>
          <!-- /.card-body -->
          <div class="card-footer">
          	<button class="btn btn-default float-right ml-2">Batal</button>
            <button type="submit" name="tambah" class="btn btn-info float-right">Tambah</button>            
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->
  </div>