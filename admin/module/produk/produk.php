  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Produk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?module=home">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Produk</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width: 20px">#</th>
            <th>Nama Produk</th>
            <th>Seo</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Berat</th>
            <th>Tgl Masuk</th>
            <th>Gambar</th>
            <th>Terjual</th>
            <th>Diskon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include "../lib/config.php";
            include "../lib/koneksi.php";
            $query = mysqli_query($koneksi, "SELECT * FROM produk");
            $i=1;
            while($item=mysqli_fetch_array($query)){                              
          ?>
          <tr>
            <td><?= $i ?>.</td>
            <td><?= $item['nama_produk'] ?></td>
            <td><?= $item['produk_seo'] ?></td>
            <td><?= substr($item['deskripsi'],0,150) ?></td>
            <td>Rp<?= format_rupiah($item['harga']) ?></td>
            <td><?= $item['stok'] ?></td>
            <td><?= $item['berat'] ?> kg</td>
            <td><?= tgl_indo($item['tgl_masuk']) ?></td>
            <td><img style="width: 50px" src="asset/images/foto_produk/<?= $item['gambar'] ?>"></td>
            <td><?= $item['dibeli'] ?></td>
            <td><?= $item['diskon'] ?>%</td>
            <td>
              <div class="input-group-btn">
                <a href="<?= $admin_url; ?>main.php?module=edit_produk&id_produk=<?= $item['id_produk']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="<?= $admin_url; ?>module/produk/aksi.php?aksi=hapus&id_produk=<?= $item['id_produk']; ?>&gambar=<?= $item['gambar'] ?>" class="btn btn-danger"><i class="fas fa-power-off"></i></a>
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
    <a href="main.php?module=tambah_produk">
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
