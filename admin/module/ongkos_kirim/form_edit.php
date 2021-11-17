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
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?module=home">Home</a></li>
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
          <h3 class="card-title">Form Edit Ongkos Kirim</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="module/ongkos_kirim/aksi.php" class="form-horizontal">
          <?php
          $id_kota = $_GET['id_kota'];
          $query = mysqli_query($koneksi, "SELECT * FROM kota WHERE id_kota = '$id_kota'");
          $item=mysqli_fetch_array($query);
          ?>
          <input type="hidden" name="id_kota" value="<?= $id_kota ?>">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Kota</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_kota" value="<?= $item['nama_kota'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Ongkos Kirim</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="ongkos_kirim" value="<?= $item['ongkos_kirim'] ?>">
              </div>
            </div>
          <!-- /.card-body -->
          <div class="card-footer">
          	<button class="btn btn-default float-right ml-2">Batal</button>
            <button type="submit" name="edit" class="btn btn-info float-right">Tambah</button>            
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