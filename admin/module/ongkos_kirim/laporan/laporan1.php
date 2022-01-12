  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?module=home">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <div class="">
        <h3 class="card-title">Daftar Laporan</h3>
        <form action="main.php?" method="GET">
          <div style="display: flex; justify-content: flex-end">            
            <table>
              <tr>
                <td align="right">
                  <div class="input-group date col-sm-10" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="mulai" />
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
            <h3 class="card-title mt-2">sampai</h3>
            <table>
              <tr>
                <td align="left">
                  <div class="input-group date col-sm-10" id="reservationdate2" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate2" name="selesai" />
                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="input-group-btn mt-3 mr-5" style="display: flex; justify-content: flex-end">            
            <h3 class="card-title mt-2">Pilih Status : </h3>
            <table>
              <tr>
                <td align="right">
                  <div class="input-group col-12" >
                    <select name="status" class="form-control" style="width: 100%;">
                      <option value="Lunas">Lunas</option>
                      <option value="Baru">Baru</option>
                      <option value="Batal">Batal</option>
                    </select>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="input-group-btn mt-3 mr-5" style="display: flex; justify-content: flex-end">            
            <button class="btn btn-secondary" name="module" value="laporan" type="submit">Tampilkan </button>
          </div>
        </form>
  </div>
</div>
</div>
<?php
  if (!empty($_GET['mulai']) && !empty($_GET['selesai'])) {
    ?>
    <div class="col-12">
  <div class="card">
    <div class="card-header">
        <h3 class="card-title">Laporan</h3>
      </div>
      <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Faktur</th>
            <th>Nama Produk</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Harga Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $mulai = date("Y-m-d", strtotime($_GET['mulai']));
          $selesai = date("Y-m-d", strtotime($_GET['selesai']));
          $status = $_GET['status'];
            $query = mysqli_query($koneksi, "SELECT c.id_orders as faktur,DATE_FORMAT(c.tgl_order, '%Y-%m-%d') as tanggal, nama_produk,jumlah,harga FROM produk a JOIN orders_detail b ON a.id_produk=b.id_produk JOIN orders c ON b.id_orders=c.id_orders WHERE c.status_order='$status' AND c.tgl_order BETWEEN '$mulai' AND '$selesai'");
            $i=1;
            while($item=mysqli_fetch_array($query)){  
            $harga = $item['harga']*$item['jumlah'];                            
          ?>
          <tr>
            <td><?= $item['faktur'] ?></td>
            <td><?= $item['nama_produk'] ?></td>
            <td><?= tgl_indo($item['tanggal']) ?></td>
            <td><?= $item['jumlah'] ?></td>
            <td><?= rp($harga) ?></td>            
          </tr>
          <?php $i++;} ?> 
        </tbody>
      </table>
      <a class="btn btn-primary" href="module/laporan/content.php?mulai=<?= $mulai ?>&selesai=<?= $selesai ?>&status=<?= $status ?>"><i class="fas fa-print"></i></a>  
    </div>
    </div>
  </div>
    <?php
  }
?>
<!-- /.card -->
  </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
