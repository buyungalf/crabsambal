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
      <h3 class="card-title">Detail Order</h3>
    </div>
    <!-- /.card-header -->
    <form action="module/order/aksi.php" method="post">
    <?php
    if (isset($_POST['pelanggan'])) {
      $_SESSION['id_kustomer'] = $_POST['id_kustomer'];
    }    
    $query = mysqli_query($koneksi, "SELECT max(id_orders) as id_orders FROM orders");
    $item = mysqli_fetch_array($query);
    $id_order = $item['id_orders']+1;
    ?>
    <div class="card-body">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">No. Order</label>
          <div class="col-sm-10">
            <label class="col-form-label"><?= $id_order ?></label>
            <input type="hidden" name="id_orders" value="<?= $id_order ?>">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tanggal & Jam Order</label>
          <div class="col-sm-10">
            <label class="col-form-label"><?= tgl_indo(date('Y/m/d')) ?> & <?= date("H:i:s") ?></label>
            <input type="hidden" name="tgl_order" value="<?= date('Y/m/d') ?>">
            <input type="hidden" name="jam_order" value="<?= date("H:i:s") ?>">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Status Order</label>
          <div class="col-sm-10">
            <label class="col-form-label">Baru</label>
          </div>
        </div>
    </div>
    <div class="card-body">
      <a class="btn btn-secondary float-right my-2" href="main.php?module=tambah_item">Tambah Item</a>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width: 20px">#</th>
            <th>Nama Produk</th>
            <th>Berat</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Sub Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($koneksi, "SELECT * FROM orders_detail a JOIN produk b ON a.id_produk = b.id_produk WHERE a.id_orders = $id_order");
            while($item = mysqli_fetch_array($query)) {
            ?>
          <tr>            
            <td>.</td>
            <td><?= $item['nama_produk'] ?></td>
            <td><?= $item['berat'] ?></td>
            <td><?= $item['jumlah'] ?></td>
            <td><?= $item['harga'] ?></td>
            <td><?= $item['harga']*$item['jumlah'] ?></td>
            <td><a href="<?= $admin_url; ?>module/order/aksi.php?id_produk=<?= $item['id_produk']; ?>&jumlah=<?= $item['jumlah'] ?>&aksi=hapus_item" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
          </tr>
           <?php } ?>
        </tbody>
      </table>
    </div>
    <button type="submit" name="order" class="btn btn-primary float-right ml-2">Order</button>
    <!-- /.card-body -->
  </div>
  </form>
<!-- /.card -->
  </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
