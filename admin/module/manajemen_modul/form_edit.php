  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manajemen Modul</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Manajemen Modul</li>
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
          <h3 class="card-title">Form Edit Modul</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php 
        $id_modul = $_GET['id_modul'];
        $query = mysqli_query($koneksi, "SELECT * FROM modul WHERE id_modul='$id_modul'");
        $item=mysqli_fetch_array($query);
        ?>
        <form method="post" action="module/manajemen_modul/aksi.php" class="form-horizontal">
          <input type="hidden" name="id_modul" value="<?= $id_modul ?>">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Modul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_modul" value="<?= $item['nama_modul'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Link</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="link" value="<?= $item['link'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
              <select name="status" class="form-control select2" style="width: 100%;">
                <option <?php if ($item['status'] == 'admin') echo " selected='selected'"; ?> value="admin">Admin</option>
                <option <?php if ($item['status'] == 'user') echo " selected='selected'"; ?> value="user">User</option>
              </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Aktif</label>
              <div class="col-sm-10">
              <select name="aktif" class="form-control select2" style="width: 100%;">
                <option  <?php if ($item['aktif'] == 'Y') echo " selected='selected'"; ?> value="Y">Y</option>
                <option  <?php if ($item['aktif'] == 'N') echo " selected='selected'"; ?> value="N">N</option>
              </select>
              </div>
            </div>

          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-default float-right ml-2">Batal</button>
            <button type="submit" name="edit" class="btn btn-info float-right">Simpan</button>            
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