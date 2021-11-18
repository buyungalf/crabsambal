  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cara Beli</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Cara Beli</li>
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
          <h3 class="card-title">Cara Beli</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php 
        $query = mysqli_query($koneksi, "SELECT * FROM modul WHERE id_modul='45'");
        $item=mysqli_fetch_array($query);
        ?>
        <form method="post" action="module/cara_pembelian/aksi.php" class="form-horizontal" enctype="multipart/form-data">
          <div class="card-body">           
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Cara Beli</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 400px" name="static_content"><?= $item['static_content'] ?></textarea>
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