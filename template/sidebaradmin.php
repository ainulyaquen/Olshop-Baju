<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">-MENU-</li>
            <li>
              <a href="homeadmin.php">
                <i class="fa fa-th text-blue"></i> <span>Beranda</span>
              </a>
            </li>


      <li class="treeview <?php 

      if ($_GET['halaman']=='kategori') 
      {
            echo 'active';
      }
      else if ($_GET['halaman']=='pegawai') 
      {
            echo 'active';
      }
      else if ($_GET['halaman']=='pelanggan') 
      {
            echo 'active';
      }
      else if ($_GET['halaman']=='supplier') 
      {
            echo 'active';
      }
      else if ($_GET['halaman']=='barang') 
      {
            echo 'active';
      }
      else{ echo ''; }


       ?>">
              <a href="#">
                <i class="fa fa-database text-red"></i>
                <span>Data Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="homeadmin.php?halaman=kategori"><i class="fa fa-database text-red"></i> Data Kategori</a></li>
                <li><a href="homeadmin.php?halaman=barang"><i class="fa fa-database text-red"></i> Data Barang</a></li>
                <li><a href="homeadmin.php?halaman=pelanggan"><i class="fa fa-user text-red"></i> Data Pelanggan</a></li>
                <li><a href="homeadmin.php?halaman=supplier"><i class="fa fa-user text-red"></i> Data Supllier</a></li>
                <li><a href="homeadmin.php?halaman=pegawai"><i class="fa fa-user text-red"></i> Data Pegawai</a></li>
              </ul>
      </li>


			<li class="treeview <?php 

      if ($_GET['halaman']=='pembelian') 
      {
            echo 'active';
      }
      else if ($_GET['halaman']=='penjualan') 
      {
            echo 'active';
      }
      else if ($_GET['halaman']=='pemesanan') 
      {
            echo 'active';
      }
      else if ($_GET['halaman']=='tambahpembelian') 
      {
            echo 'active';
      }
      else{ echo ''; }


       ?>">
              <a href="#">
                <i class="fa fa-bar-chart text-green"></i>
                <span> Data Transaksi</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="homeadmin.php?halaman=pembelian"><i class="fa fa-bar-chart text-green"></i> Pembelian</a></li>
                <li><a href="homeadmin.php?halaman=pemesanan"><i class="fa fa-bar-chart text-orange"></i> Pemesanan</a></li>
                <li><a href="homeadmin.php?halaman=penjualan"><i class="fa fa-bar-chart text-aqua"></i> Penjualan</a></li>
              </ul>
      </li>

      <li class="treeview ">
              <a href="#">
                <i class="fa fa-file-pdf-o text-red"></i>
                <span> Laporan</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="homeadmin.php?halaman=pembelian"><i class="fa fa-file-pdf-o text-blue"></i> Laporan Pembelian</a></li>
                <li><a href="homeadmin.php?halaman=pemesanan"><i class="fa fa-file-pdf-o text-orange"></i> Laporan Pemesanan</a></li>
              </ul>
      </li>


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>