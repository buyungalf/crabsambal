  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
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
          <h3 class="card-title">Form Order</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="main.php?module=order_manual" method="post">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Pelanggan</label>
              <div class="col-sm-10">
                <select class="form-control select2" name="id_kustomer" style="width: 100%;">
                  <option value="">-- Pilih Pelanggan --</option>
                  <?php
                    $id_reseller = $_SESSION['id_reseller'];
                    $q = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE id_reseller = $id_reseller");
                    while($item=mysqli_fetch_array($q)){
                  ?>                          
                    <option value="<?php echo $item['id_kustomer']; ?>">
                      <?php echo $item['nama_lengkap']; ?>
                    </option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <a class="float-right " href="main.php?module=tambah_kustomer">Belum terdaftar?</a><br>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">            
            <button class="btn btn-default float-right ml-2">Batal</button>
            <button name="pelanggan" type="submit" class="btn btn-info float-right">Lanjutkan</button>
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