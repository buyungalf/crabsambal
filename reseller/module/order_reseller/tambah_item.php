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
              <li class="breadcrumb-item"><a href="<?= $reseller_url ?>main.php?module=home">Home</a></li>
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
    <?php
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
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tanggal & Jam Order</label>
          <div class="col-sm-10">
            <label class="col-form-label"><?= tgl_indo(date('Y/m/d')) ?> & <?= date("H:i") ?></label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Status Order</label>
          <div class="col-sm-10">
            <label class="col-form-label">Baru</label>
          </div>
        </div>
    </div>
    <div class="row invoice-info">
      <div class="col-sm-9 invoice-col">
      </div>
      <div class=" invoice-col mb-3 mt-3 ">
      </div>          
    </div>
    <!-- /.card-body -->
  </div>

<!-- /.card -->
  </div>
    <form method="post" action="module/order_reseller/aksi.php" class="form-horizontal">
        <input type="hidden" name="id_orders" value="<?= $id_order ?>">
      <div class="card card-info"> 
        <div class="card-header">
          <h3 class="card-title">Tambah Item</h3>
        </div> 
      <div class="card-body ml-5 mr-5">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama Barang</label>
          <div class="col-sm-10">
            <select class="form-control select2" name="id_produk" style="width: 100%;">
              <?php
                $q = mysqli_query($koneksi, "SELECT * FROM produk");
                while($item=mysqli_fetch_array($q)){
              ?>                          
                <option value="<?php echo $item['id_produk']; ?>">
                  <?php echo $item['nama_produk']; ?> - Rp.<?php echo rp($item['harga_reseller']); ?>
                </option>
                <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Jumlah</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah barang">
          </div>
        </div>  
        <button name="tambah_item" type="submit" class="btn btn-info float-right">Tambah</button>
      </form>
        </div>
        </div>      
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
