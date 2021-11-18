  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ubah Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Ubah Password</li>
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
          <h3 class="card-title">Ubah Password</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="quickForm" method="post" action="module/ganti_password/aksi.php" class="form-horizontal">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Masukkan Password Lama</label>
              <div class="col-sm-9">
                <input type="password" name="old_password" class="form-control mb-2" placeholder="Password Lama">
                <?php 
                if(isset($_SESSION['errors'])){
                    ?>
                    <span class="text-danger">
                      <?php echo $_SESSION['errors']; ?>                        
                    </span>
                  <?php
                  unset($_SESSION["errors"]);
                  }
                  ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Masukkan Password Baru</label>
              <div class="col-sm-9">
                <input type="password" name="password" class="form-control mb-2" placeholder="Password Baru">
                <?php 
                if(isset($_SESSION['errors2'])){
                    ?>
                    <span class="text-danger">
                      <?php echo $_SESSION['errors2']; ?>                        
                    </span>
                  <?php
                  unset($_SESSION["errors2"]);
                  }
                  ?>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
              <div class="col-sm-9">
                <input type="password" name="cpassword" class="form-control mb-2" placeholder="Password Baru">
                <?php 
                if(isset($_SESSION['errors3'])){
                    ?>
                    <span class="text-danger">
                      <?php echo $_SESSION['errors3']; ?>                        
                    </span>
                  <?php
                  unset($_SESSION["errors3"]);
                  }
                  ?>
              </div>
            </div>
          </div>            
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-default float-right ml-2">Batal</button>
            <button type="submit" name="change" class="btn btn-info float-right">Simpan</button>            
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