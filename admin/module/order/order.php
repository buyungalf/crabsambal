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
            $query = mysqli_query($koneksi, "SELECT * FROM orders a JOIN kustomer b ON a.id_kustomer = b.id_kustomer");
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
                <a href="<?= $admin_url; ?>module/order/aksi.php?id_orders=<?= $item['id_orders']; ?>&aksi=lunas" class="btn btn-success"><i class="fas fa-check-circle"></i></a>
                <a href="<?= $admin_url; ?>module/order/aksi.php?id_orders=<?= $item['id_orders']; ?>&aksi=batal" class="btn btn-danger"><i class="fas fa-times-circle"></i></a>
                <a href="<?= $admin_url; ?>main.php?module=detail_order&id_orders=<?= $item['id_orders']; ?>" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
              </div>
            </td>
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
