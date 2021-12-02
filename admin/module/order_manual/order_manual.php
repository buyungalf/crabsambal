  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Reservasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=home">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $admin_url ?>main.php?pages=reservasi">Reservasi</a></li>
              <li class="breadcrumb-item active">Shop</li>
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
                    <h3 class="card-title">Order Tamu Hotel</h3>
                  </div>           
              <!-- /.card-header -->
                <?php                  
                  include "../lib/config.php";
                  include "../lib/koneksi.php";
                  $id_tamu = $_GET['id_tamu'];
                  $query = mysqli_query($koneksi, "SELECT * from tb_tamu b JOIN tb_kamar c ON b.id_kamar = c.id_kamar WHERE b.id_tamu = $id_tamu");
                  $to=mysqli_fetch_array($query);
                  $i=1;                           
                ?>
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Tamu</label>
                    <div class="col-sm-10">
                      <label class="col-form-label"><?= $to['nm_tamu'] ?></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">(Tanggal | Jam) Check in</label>
                    <div class="col-sm-10">
                      <label class="col-form-label"><?= date("j F Y | H:i",$to['checkin']) ?></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Kamar</label>
                    <div class="col-sm-10">
                      <label class="col-form-label"><?= $to['nm_kamar'] ?></label>
                    </div>
                  </div>
                </div>
              </div>
                <form method="post" action="pages/reservasi/aksi_tambah.php" class="form-horizontal">
                  <input type="hidden" name="id_tamu" value="<?= $to['id_tamu'] ?>">
                  <input type="hidden" name="id_kamar" value="<?= $to['id_kamar'] ?>">
                <div class="card card-info"> 
                  <div class="card-header">
                    <h3 class="card-title">Tambah Order Tamu</h3>
                  </div> 
                <div class="card-body ml-5 mr-5">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Order</label>
                    <div class="col-sm-10">
                      <label class=" col-form-label"><?= date("j F Y | H:i") ?></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" name="id_order" style="width: 100%;">
                        <option value="">-- Pilih Barang --</option>
                        <?php
                          include "../lib/config.php";
                          include "../lib/koneksi.php";
                          $q = mysqli_query($koneksi, "SELECT * FROM tb_order");
                          while($oj=mysqli_fetch_array($q)){
                        ?>                          
                          <option value="<?php echo $oj['id']; ?>">
                            <?php echo $oj['nm_order']; ?>
                          </option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Qty</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="qty" placeholder="Quantity">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button class="btn btn-default float-right ml-2">Batal</button>
                  <button type="submit" class="btn btn-info float-right">Tambah</button>
                  
                </div>
                <!-- /.card-footer -->
              </form>
              </div>              
            </div>
            <!-- /.card -->
                    </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>