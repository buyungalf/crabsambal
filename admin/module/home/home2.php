<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Income  Charts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Flot</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-7">
            <!-- Bar chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Grafik Pendapatan Per Tahun
                </h3>
              </div>
              <div class="card-body">
                <div id="bar-chart-2" style="height: 300px; width: 500px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-5">
         <!-- Donut chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Donut Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="donut-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <!-- Bar chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Grafik Pendapatan <?php if (!empty($_GET['tahun'])) {
                    $tahun = $_GET['tahun'];
                    echo "(tahun $tahun)";
                 } ?>                
                </h3>

                <div class="card-tools" style="width: 300px;">
                  <form action="main.php?" method="get">
                    <input type="hidden" name="pages" value="test">
                  <select class="custom-select" name="tahun" style="width: 50%">
                    <option value="">-- Pilih Tahun --</option>
                    <?php
                      include "../lib/config.php";
                      include "../lib/koneksi.php";
                      $q = mysqli_query($koneksi, "SELECT distinct thn_trans FROM tb_trans_tot ORDER BY thn_trans");
                      while($o=mysqli_fetch_array($q)){
                    ?>                          
                      <option value="<?php echo $o['thn_trans']; ?>">
                        <?php echo $o['thn_trans']; ?>
                      </option>
                      <?php } ?>
                  </select>
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                  </form>
                </div>
              </div>
              <div class="card-body">
                <div id="bar-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->