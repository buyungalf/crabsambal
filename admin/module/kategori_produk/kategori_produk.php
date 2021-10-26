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
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?module=home">Home</a></li>
              <li class="breadcrumb-item active">Kategori Produk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Kategori Produk</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width: 20px">#</th>
            <th>Nama Kategori</th>
            <th></th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($koneksi, "SELECT * FROM kategori");
            $i=1;
            while($kt=mysqli_fetch_array($query)){                              
          ?>
          <tr>
            <td><?= $i ?>.</td>
            <td><?= $kt['nama_kategori'] ?></td>
            <td><?= $kt['kategori_seo'] ?></td>
            <td>
              <div class="input-group-btn">
                <a href="<?= $admin_url; ?>main.php?module=edit_kategori&id_kategori=<?= $kt['id_kategori']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="<?= $admin_url; ?>module/kategori_produk/aksi.php?id_kategori=<?= $kt['id_kategori']; ?>&aksi=hapus" class="btn btn-danger"><i class="fas fa-power-off"></i></a>
              </div>
            </td>
          </tr>
          <?php $i++;} ?> 
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <ul class="nav navbar-right panel_toolbox">
    <div class="input-group-btn float-right">
    <a href="main.php?module=tambah_kategori">
      <button href="index.php" type="button" class="btn btn-primary">Tambah Daftar</button>
    </a>
  </div>                      
  </ul>
<!-- /.card -->
  </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
