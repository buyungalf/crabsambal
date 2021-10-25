
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kategori</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
          <h3 class="card-title">Form Tambah Kategori</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="module/kategori_produk/aksi_edit.php" class="form-horizontal">
          <?php
                  include "../lib/config.php";
                  include "../lib/koneksi.php";
                  $id_kategori = $_GET['id_kategori'];
                  $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori='$id_kategori'");
                  $kt=mysqli_fetch_array($query);
                ?>
                <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Kategori</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_kategori" value="<?= $kt['nama_kategori'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Slug</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kategori_seo" value="<?= $kt['kategori_seo'] ?>">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-default float-right ml-2">Batal</button>
            <button type="submit" class="btn btn-info float-right">Edit</button>
            
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