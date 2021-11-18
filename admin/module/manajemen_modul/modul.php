  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Modul</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?module=home">Home</a></li>
              <li class="breadcrumb-item active">Modul</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Modul</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width: 20px">#</th>
            <th>Nama Modul</th>
            <th></th>
            <th>Link</th>
            <th>Status</th>
            <th>Aktif</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($koneksi, "SELECT * FROM modul");
            $i=1;
            while($item=mysqli_fetch_array($query)){                              
          ?>
          <tr>
            <td><?= $i ?>.</td>
            <td><?= $item['nama_modul'] ?></td>
            <td><?= $item['slug'] ?></td>
            <td><?= $item['link'] ?></td>
            <td><?= $item['status'] ?></td>
            <td><?= $item['aktif'] ?></td>
            <td>
              <div class="input-group-btn">
                <a href="<?= $admin_url; ?>main.php?module=edit_modul&id_modul=<?= $item['id_modul']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="<?= $admin_url; ?>module/manajemen_modul/aksi.php?id_modul=<?= $item['id_modul']; ?>&aksi=hapus" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
    <a href="main.php?module=tambah_modul">
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
