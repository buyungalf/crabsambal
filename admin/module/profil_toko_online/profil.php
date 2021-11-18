  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profil Toko</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item active">Profil Toko</li>
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
          <h3 class="card-title">Profil Toko Online</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php 
        $query = mysqli_query($koneksi, "SELECT * FROM modul WHERE id_modul='43'");
        $item=mysqli_fetch_array($query);
        ?>
        <form method="post" action="module/profil_toko_online/aksi.php" class="form-horizontal" enctype="multipart/form-data">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Toko</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_toko" value="<?= $item['nama_toko'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Meta Deskripsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="meta_deskripsi" value="<?= $item['meta_deskripsi'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Meta Keyword</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="meta_keyword" value="<?= $item['meta_keyword'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Email Pengelola</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="email_pengelola" value="<?= $item['email_pengelola'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">No.HP Pengelola</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nomor_hp" value="<?= $item['nomor_hp'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nomor Rekening</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nomor_rekening" value="<?= $item['nomor_rekening'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Gambar</label>
              <div class="col-sm-10">
                <img src="../assets/img/foto_banner/<?= $item['gambar'] ?>" style="width: 200px">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <input type="file" name="gambar">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Deskripsi</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 200px" name="static_content"><?= $item['static_content'] ?></textarea>
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