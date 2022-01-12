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
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?module=home">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Order</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width: 20px">#</th>
            <th>Customer</th>
            <th>Tanggal | Jam</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $id_reseller = $_SESSION['id_reseller'];
            $query = mysqli_query($koneksi, "SELECT a.*, b.* FROM orders a JOIN kustomer b ON a.id_kustomer = b.id_kustomer JOIN reseller c ON b.id_reseller = c.id_reseller WHERE c.id_reseller =$id_reseller ORDER BY a.tgl_order");
            $i=1;
            while($item=mysqli_fetch_array($query)){                              
          ?>
          <tr>
            <td><?= $i ?>.</td>
            <td><?= $item['nama_lengkap'] ?></td>
            <td><?= tgl_indo($item['tgl_order']) ?> | <?= $item['jam_order'] ?></td>
            <td><?= $item['status_order'] ?></td>
            <td>
              <div class="input-group-btn">
                <a href="main.php?module=detail_order&id_orders=<?= $item['id_orders']; ?>" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
              </div>
            </td>
          </tr>
          <?php $i++;} ?> 
        </tbody>
      </table>
      <div class="input-group-btn float-sm-right mt-3">
    <a href="main.php?module=tambah_order">
      <button href="index.php" type="button" class="btn btn-primary">Order Manual</button>
    </a>
  </div>
  </div>
    <!-- /.card-body -->
  </div>

<!-- /.card -->
  </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
