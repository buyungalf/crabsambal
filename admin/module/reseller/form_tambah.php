  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Reseller</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Reseller</li>
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
          <h3 class="card-title">Form Tambah Reseller</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="module/reseller/aksi.php" class="form-horizontal">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Lengkap</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="email" placeholder="Email">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="alamat" placeholder="Alamat">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Telpon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telpon" placeholder="Telpon">
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
                          <option value="<?php echo $item['id_kota']; ?>">
                            <?php echo $item['nama_kota']; ?>
                          </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select name="status" class="form-control" style="width: 100%;"> 
                    <option value="Aktif">Aktif</option>
                    <option value="Blokir">Blokir</option>
                </select>
              </div>
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