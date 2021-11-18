  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pesan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Balas Pesan</li>
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
          <h3 class="card-title">Form Balas Pesan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="module/hubungi_kami/aksi.php" class="form-horizontal">
          <?php
          $id_hubungi = $_GET['id_hubungi'];
          $query = mysqli_query($koneksi, "SELECT * FROM hubungi WHERE id_hubungi = $id_hubungi");
          $item = mysqli_fetch_array($query);
          ?>
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kepada</label>
              <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" name="kepada" value="<?= $item['email'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Subjek</label>
              <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" name="subjek" value="<?= $item['subjek'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Pesan</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 200px"></textarea>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          	<button class="btn btn-default float-right ml-2">Batal</button>
            <button type="submit" name="balas" class="btn btn-info float-right">Kirim</button>            
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