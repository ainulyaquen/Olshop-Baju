<section class="content-header">
          <h1>
            Beranda
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
          </ol>
        </section>
    
  <section class="content">
     <div class="row">
    
<div class="col-md-12">
  <div class="box box-info ">
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <center><h2>5 Barang Terlaris</h2></center>       
                  <div class="col-md-8">
                                        <div class="chart-responsive">
                  <canvas id="pieChart" height="150"></canvas>
                  </div>
                  </div>
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <?php 
                          $no=0;
                          $warna=['red','green','yellow','aqua','light-blue'];
                          $query=mysqli_query($db,"SELECT b.nama_barang,SUM(a.jumlah) AS jum FROM tb_detailpenjualan a JOIN tb_barang b ON a.id_barang=b.id_barang GROUP BY a.id_barang ORDER BY jum DESC LIMIT 5");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <li><i class="fa fa-circle-o text-<?php echo $warna[$no];?>"></i> <?php echo $pecah['nama_barang'];?> ,Jumlah : <?php echo $pecah['jum'];?></li>
                      <?php $no++; }} ?>
                    </ul>
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
      
    </div>
   </section>