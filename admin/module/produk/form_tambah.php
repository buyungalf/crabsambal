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
        <form method="post" action="module/produk/aksi_tambah.php" class="form-horizontal" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Produk SEO</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="produk_seo" placeholder="Nama Produk SEO">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kategori Produk</label>
              <div class="col-sm-10">
              <select name="id_kategori" class="form-control select2" style="width: 100%;">
                <option selected="selected">-- Pilih kategori produk --</option>
                <?php
                  include "../lib/config.php";
                  include "../lib/koneksi.php";
                  $q = mysqli_query($koneksi, "SELECT * FROM kategori");
                  while($item=mysqli_fetch_array($q)){
                ?>                          
                <option value="<?php echo $item['id_kategori']; ?>">
                  <?php echo $item['nama_kategori']; ?>
                </option>
                <?php } ?>
              </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 200px" name="deskripsi"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Harga</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="harga" placeholder="Harga">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Stok</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="stok" placeholder="Stok">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Berat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="berat" placeholder="Berat">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal Masuk</label>
              <div class="input-group date col-sm-10" id="reservationdate" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tgl_masuk" />
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
                <input type="text" class="form-control" name="dibeli" placeholder="Terjual">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Diskon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="diskon" placeholder="Diskon">
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          	<button class="btn btn-default float-right ml-2">Batal</button>
            <button type="submit" class="btn btn-info float-right">Tambah</button>
            
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