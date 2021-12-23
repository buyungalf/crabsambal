  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="asset/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="asset/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          
        </div>
        <?php
          include "../lib/config.php";
          include "../lib/koneksi.php";
          if ($_GET) {
            $page = "?module=".$_GET['module'];
            }
            $username = $_SESSION['username'];
            $query = mysqli_query($koneksi, "SELECT * FROM admins WHERE username='$username'");
            $user = mysqli_fetch_array($query);
          
          
          ?>
        <div class="info">
          <a href="#" class="d-block"><?= $user['username'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="main.php?module=home" class = 'nav-link <?php if ($page == 'home') echo " active"; ?> '>
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home 
              </p>
            </a>            
          </li>
          <li class="nav-header">MAIN</li>
          <?php
            include "../lib/config.php";
            include "../lib/koneksi.php";
            $query = mysqli_query($koneksi, "SELECT * FROM modul");
            $i=1;
            while($mod=mysqli_fetch_array($query)){                              
          ?>
          <li class="nav-item">
            <a href="main.php<?= $mod['link'] ?>" class = 'nav-link <?php if ($page == $mod['link']) echo " active"; ?> '>
              <i class="nav-icon fas fa-book"></i>
              <p>
                <?= $mod['nama_modul'] ?>
              </p>
            </a>            
          </li>
          <?php } ?>
          <li class="nav-header">SETTINGS</li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>