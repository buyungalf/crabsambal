  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?module=home">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Harga Produk (Reseller)</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include "../lib/config.php";
            include "../lib/koneksi.php";
            $query = mysqli_query($koneksi, "SELECT * FROM produk");
            $i=1;
            while($item=mysqli_fetch_array($query)){                              
          ?>
          <tr>
            <td><?= $item['nama_produk'] ?></td>
            <td>Rp<?= format_rupiah($item['harga_reseller']) ?></td>
          </tr>
          <?php $i++;} ?> 
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
<!-- /.card -->
  </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
