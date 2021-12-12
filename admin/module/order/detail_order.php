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
    <div class="card-body">      
      <?php
        $id_orders = $_GET['id_orders'];
        $query = mysqli_query($koneksi, "SELECT * FROM orders a JOIN kustomer b ON a.id_kustomer = b.id_kustomer WHERE a.id_orders = $id_orders");
        $i=1;
        $item=mysqli_fetch_array($query);
      ?> 
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">No. Order</label>
          <div class="col-sm-10">
            <label class="col-form-label"><?= $item['id_orders'] ?></label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tanggal & Jam Order</label>
          <div class="col-sm-10">
            <label class="col-form-label"><?= tgl_indo($item['tgl_order']) ?> & <?= $item['jam_order'] ?></label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Status Order</label>
          <div class="col-sm-10">
            <label class="col-form-label"><?= $item['status_order'] ?></label>
          </div>
        </div>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width: 20px">#</th>
            <th>Nama Produk</th>
            <th>Berat</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($koneksi, "SELECT * FROM produk a JOIN orders_detail b ON a.id_produk = b.id_produk WHERE b.id_orders = $id_orders");
            $i=1;
            $total = 0;
            $totalberat = 0;
            while($item=mysqli_fetch_array($query)){
            $disc        = ($item['diskon']/100)*$item['harga'];
            $hargadisc   = number_format(($item['harga']-$disc),0,",","."); 
            $subtotal    = ($item['harga']-$disc) * $item['jumlah'];

            $total       = $total + $subtotal;
            $subtotal_rp = format_rupiah($subtotal);    
            $total_rp    = format_rupiah($total);    
            $harga       = format_rupiah($item['harga']);

            $subtotalberat = $item['berat'] * $item['jumlah']; // total berat per item produk 
            $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli                      
          ?>
          <tr>
            <td><?= $i ?>.</td>
            <td><?= $item['nama_produk'] ?></td>
            <td><?= $item['berat'] ?></td>
            <td><?= $item['jumlah'] ?></td>
            <td>Rp<?= format_rupiah($item['harga']) ?></td>
            <td>Rp<?= $subtotal_rp ?></td>
          </tr>
          <?php $i++;} ?> 
        </tbody>
      </table>
    </div>

    <div class="row invoice-info">
      <div class="col-sm-9 invoice-col ml-4">
        <a class="btn btn-primary" href="module/order/nota.php?id_orders=<?= $id_orders ?>"><i class="fas fa-print"></i></a>  
      </div>
      <!-- /.col -->
      <?php
      $query = mysqli_query($koneksi, "SELECT * FROM kota a JOIN kustomer b ON a.id_kota = b.id_kota JOIN orders c ON b.id_kustomer = c.id_kustomer WHERE c.id_orders = $id_orders");
      $item=mysqli_fetch_array($query);
      $ongkoskirim1=$item['ongkos_kirim'];
      $ongkoskirim=$ongkoskirim1 * $totalberat;

      $grandtotal    = $total + $ongkoskirim; 

      $ongkoskirim_rp = format_rupiah($ongkoskirim);
      $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
      $grandtotal_rp  = format_rupiah($grandtotal);
      ?>
      <div class=" invoice-col mb-3 mt-3 ">
        <b>Total  :</b> Rp<?= $total_rp ?><br>
        <b>Ongkos Kirim  :</b> Rp<?= $ongkoskirim1_rp ?><br>
        <b>Total Berat  :</b> <?= $totalberat ?> kg<br>
        <b>Total Ongkos Kirim :</b> Rp<?= $ongkoskirim_rp ?><br>
        <b>Grand Total :</b> Rp<?= $grandtotal_rp ?>
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
