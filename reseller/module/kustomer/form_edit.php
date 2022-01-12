  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kustomer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $reseller_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Kustomer</li>
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
          <h3 class="card-title">Form Tambah Kustomer</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $id_kustomer = $_GET['id_kustomer'];

        $query = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE id_kustomer=$id_kustomer");
        $item = mysqli_fetch_array($query);
        $kt = $item['id_kota'];
        ?>
        <form method="post" action="module/kustomer/aksi.php" class="form-horizontal">
          <input type="hidden" name="id_kustomer" value="<?= $id_kustomer ?>">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Lengkap</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_lengkap" value="<?= $item['nama_lengkap'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="alamat" value="<?= $item['alamat'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="<?= $item['email'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Telpon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telpon" value="<?= $item['telpon'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kota</label>
              <div class="col-sm-10">
                <select name="id_kota" class="form-control select2" style="width: 100%;"> 
                    <option>-- Pilih Kota --</option>
                        <?php
                          $q = mysqli_query($koneksi, "SELECT * FROM kota");
                          while($item=mysqli_fetch_array($q)){
                        ?>                          
                          <option value="<?php echo $item['id_kota']; ?>" <?php if ($kt == $item['id_kota']) echo " selected='selected'"; ?>>
                        <?php echo $item['nama_kota']; ?>
                          </option>
                  <?php } ?>
                </select>
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