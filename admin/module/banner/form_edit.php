  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Banner</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Edit Banner</li>
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
          <h3 class="card-title">Edit Banner</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="module/banner/aksi.php" class="form-horizontal" enctype="multipart/form-data">
          <?php
          $id_banner = $_GET['id_banner'];
          $query = mysqli_query($koneksi, "SELECT * FROM banner WHERE id_banner = $id_banner");
          $item = mysqli_fetch_array($query);
          ?>
          <input type="hidden" name="id_banner" value="<?= $id_banner ?>">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="judul" value="<?= $item['judul'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">URL</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="url" value="<?= $item['url'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Gambar</label>
              <div class="col-sm-10">
                <img src="../assets/img/foto_banner/<?= $item['gambar'] ?>" style="width: 200px">
                <input type="hidden" name="old_gambar" value="<?= $item['gambar'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <input type="file" name="gambar">
              </div>
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