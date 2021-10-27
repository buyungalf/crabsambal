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
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
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
          <h3 class="card-title">Form Tambah Produk</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="module/produk/aksi.php" class="form-horizontal" enctype="multipart/form-data">
          <?php
            $id_produk = $_GET['id_produk'];
            $q = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = $id_produk");
            $item=mysqli_fetch_array($q);

            $id_produk = $item['id_produk'];
            $nama_produk = $item['nama_produk'];
            $kt = $item['id_kategori'];
            $produk_seo = $item['produk_seo'];
            $deskripsi = $item['deskripsi'];
            $harga = $item['harga'];
            $stok = $item['stok'];
            $berat = $item['berat'];
            $gambar = $item['gambar'];
            $tgl_masuk = $item['tgl_masuk'];
            $dibeli = $item['dibeli']; 
            $diskon = $item['diskon'];
          ?>
          <input type="hidden" value="<?= $id_produk ?>" name="id_produk">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_produk" value="<?= $nama_produk ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kategori Produk</label>
              <div class="col-sm-10">
              <select name="id_kategori" class="form-control select2" style="width: 100%;">
                <option>-- Pilih kategori produk --</option>
                <?php
                  $q = mysqli_query($koneksi, "SELECT * FROM kategori");
                  while($item=mysqli_fetch_array($q)){
                ?>                          
                <option value="<?php echo $item['id_kategori']; ?>" <?php if ($kt == $item['id_kategori']) echo " selected='selected'"; ?>>
                  <?php echo $item['nama_kategori']; ?>
                </option>
                <?php } ?>
              </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 200px" name="deskripsi"><?= $deskripsi ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Harga</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="harga" value="<?= $harga ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Stok</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="stok" value="<?= $stok ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Berat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="berat" value="<?= $berat ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal Masuk</label>
              <div class="input-group date col-sm-10" id="reservationdate" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tgl_masuk" value="<?= $tgl_masuk ?>" />
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Gambar</label>
              <div class="col-sm-10">
                <input type="file" name="Gambar" placeholder="Gambar">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Terjual</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="dibeli" value="<?= $dibeli ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Diskon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="diskon" value="<?= $diskon ?>">
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