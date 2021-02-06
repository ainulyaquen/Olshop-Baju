<?php 
if (isset($_GET['aksi'])) 
{
  if ($_GET['aksi']='hapus') 
  {
    $id=$_GET['id'];

    mysqli_query($db,"delete from tb_detailpembelian where id_detailpembelian='$id'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=pembelian';</script>";
                  
  }
}
if (isset($_GET['aksipem'])) 
{
  if ($_GET['aksipem']='hapuspem') 
  {
    $idpm=$_GET['idpem'];

    mysqli_query($db,"delete from tb_pembelian where id_pembelian='$idpm'");
    mysqli_query($db,"delete from tb_detailpembelian where id_pembelian='$idpm'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=pembelian';</script>";
                  
  }
}
if (isset($_GET['sim'])) 
{
  if ($_GET['sim']='simpan') 
  {
    $idsim=$_GET['idsim'];
    $idsuppp=$_SESSION['idsup'];

    mysqli_query($db,"insert into tb_pembelian(id_pembelian,id_supplier,tgl_pembelian,status) values ('$idsim','$idsuppp',curdate(),'Lunas')");
                  
        echo "<script>alert('Data Berhasil Tersimpan')</script>";
        $_SESSION['idsup']='';
        echo "<script>window.location='homeadmin.php?halaman=pembelian';</script>";
                  
  }
}
 ?>

<section class="content-header">
          <h1>
            Pembelian Barang
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i>Transaksi</a></li>
            <li class="active">Pembelian</li>
          </ol>
        </section>
    
  <section class="content">
     <div class="row">
    
<div class="col-md-12">
  <div class="box box-info ">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Pembelian Barang</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab1" data-toggle="tab">Tambah Pembelian</a></li>
                      <li><a href="#tab2" data-toggle="tab">Data Pembelian</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="active tab-pane" id="tab1">
                  <center><h4>Tambah Data Pembelian Barang</h4></center><br>
                  <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">ID Pembelian</label>
                                <div class="col-sm-9"> 
                                  <?php 
                                  $sql1="SELECT max(id_pembelian) as terakhir from tb_pembelian";
                                  $hasil1= mysqli_query($db,$sql1);
                                  $data1= mysqli_fetch_array($hasil1);
                                  $lastID1= $data1['terakhir'];
                                  $lastnourut1= (int)substr($lastID1,2, 4);
                                  $nextnourut1=$lastnourut1+1;
                                  $nextIDpm="PM".sprintf("%04s",$nextnourut1);
                                   ?>
                                    <input type="text" class="form-control" id="id" value="<?php echo $nextIDpm ?>" disabled>
                                  </div>
                                </div>
                               <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Supplier</label>
                                  <div class="col-sm-9"> 
                                    <select class="form-control" style="width: 100%;" name="idsup" id="nomer">
                                      <?php 
                                      if(isset($_SESSION['idsup'])){
                                        if($_SESSION['idsup']==''){
                                          $idsupss='';
                                        }else{
                                          $idsupss=$_SESSION['idsup'];
                                        }

                                      }
                                        $queryaddsub=mysqli_query($db,"select * from tb_supplier where id_supplier like '%$idsupss%'");
                                          $hitungaddsub= mysqli_num_rows($queryaddsub);
                                          if($hitungaddsub>0){
                                          while ($pecahaddsub= mysqli_fetch_assoc($queryaddsub)) {
                                        ?>
                                      <option value="<?php echo $pecahaddsub['id_supplier'] ?>">
                                        <?php echo $pecahaddsub['nama_supplier'] ?></option>
                                      <?php }} ?>
                                    </select>
                                  </div>
                              </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Nama Barang</label>
                                <div class="col-sm-9"> 
                                    <select class="form-control" style="width: 100%;" name="idbar" id="nomer">
                                      <?php 
                                        $queryadd=mysqli_query($db,"select * from tb_barang");
                                          $hitungadd= mysqli_num_rows($queryadd);
                                          if($hitungadd>0){
                                          while ($pecahadd= mysqli_fetch_assoc($queryadd)) {
                                        ?>
                                      <option value="<?php echo $pecahadd['id_barang'] ?>">
                                        <?php echo $pecahadd['nama_barang'] ?>  , Stok : <?php echo $pecahadd['stok'] ?> </option>
                                      <?php }} ?>
                                    </select>
                                  </div>
                                </div>
                               <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Jumlah</label>
                                <div class="col-sm-9">
                                  <input type="number" class="form-control" id="id" name="qty" placeholder="Qty">
                                </div>
                              </div>
                              <button type="submit" name="save" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah</button>
                              <br><br><br><br>
                        </div>


                            </form>

                                
                                
                            <?php
                                if(isset($_POST['save']))
                                {                                  
                                  
                                  $idsup=$_POST['idsup'];
                                  $idbar=$_POST['idbar'];
                                  $qty=$_POST['qty'];
                                  $_SESSION['idsup']=$idsup;
                                  
                                  mysqli_query($db,"INSERT INTO tb_detailpembelian(id_pembelian,id_barang,jumlah) 
      VALUES ('$nextIDpm','$idbar','$qty')");

                                    echo "<script>alert('Data Berhasil Tersimpan')</script>";
                                    echo "<script>window.location='homeadmin.php?halaman=pembelian';</script>";
                                 
                                }
                          ?>
<hr>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Pembelian</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"select a.id_detailpembelian,a.id_pembelian,a.id_barang,b.nama_barang,a.jumlah,b.harga*a.jumlah as total from tb_detailpembelian a join tb_barang b on a.id_barang=b.id_barang where id_pembelian like '%$nextIDpm%'");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['id_pembelian'] ?></td>
                        <td><?php echo $pecah['id_barang'] ?></td>
                        <td><?php echo $pecah['nama_barang'] ?></td>
                        <td><?php echo $pecah['jumlah'] ?></td>
                        <td>Rp <?php echo rupiah($pecah['total']) ?></td>
                        <td>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=pembelian&aksi=hapus&id=<?php echo $pecah['id_detailpembelian'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                      </tr>
                      <?php $no++;}} ?>

                    </tbody>
                  </table>
                  <div class="box-footer">
                    <?php 
                        $sql2="SELECT sum(b.harga*jumlah) as harga from tb_detailpembelian a join tb_barang b on a.id_barang=b.id_barang where a.id_pembelian='$nextIDpm'";
                        $hasil2= mysqli_query($db,$sql2);
                        $data2= mysqli_fetch_array($hasil2);
                        $sumharga= $data2['harga']; 
                    ?>
                    <button class='btn btn-warning' ><b>Total Harga : Rp <?php echo rupiah($sumharga); ?></b></button>
                    <a onclick=" return confirm('Anda Yakin Ingin Menyimpan??')" href="homeadmin.php?halaman=pembelian&sim=simpan&idsim=<?php echo $nextIDpm; ?>" class='btn btn-info' style='float:right;'><i class="fa fa-save"></i> Simpan</a>
                  </div>
                  </div>
                  




                      <div class="tab-pane" id="tab2">
                        <center><h3>Data Pembelian</h3></center>
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Pembelian</th>
                        <th>Supplier</th>
                        <th>Tanggal Pembelian</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"SELECT a.id_pembelian,c.nama_supplier,tgl_pembelian,sum(d.harga*a.jumlah) AS subtotal,b.status 
                            FROM tb_detailpembelian a  
                            JOIN tb_pembelian b ON a.id_pembelian=b.id_pembelian 
                            JOIN tb_supplier c ON b.id_supplier=c.id_supplier
                            JOIN tb_barang d ON a.id_barang=d.id_barang 
                            GROUP BY a.id_pembelian
                            ");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['id_pembelian'] ?></td>
                        <td><?php echo $pecah['nama_supplier'] ?></td>
                        <td><?php echo $pecah['tgl_pembelian'] ?></td>
                        <td>Rp <?php echo rupiah($pecah['subtotal']) ?></td>
                        <td><?php echo $pecah['status'] ?></td>
                        <td>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=pembelian&aksipem=hapuspem&idpem=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                      </tr>
                      <?php $no++;}} ?>

                    </tbody>
                  </table>
                  <hr>
                  <center><h3>Data Detail Pembelian</h3></center>
                  <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Pembelian</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"select a.id_detailpembelian,a.id_pembelian,a.id_barang,b.nama_barang,a.jumlah,b.harga*a.jumlah as total from tb_detailpembelian a join tb_barang b on a.id_barang=b.id_barang order by a.id_pembelian");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['id_pembelian'] ?></td>
                        <td><?php echo $pecah['id_barang'] ?></td>
                        <td><?php echo $pecah['nama_barang'] ?></td>
                        <td><?php echo $pecah['jumlah'] ?></td>
                        <td>Rp <?php echo rupiah($pecah['total']) ?></td>
                        <td>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=pembelian&aksi=hapus&id=<?php echo $pecah['id_detailpembelian'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                      </tr>
                      <?php $no++;}} ?>

                    </tbody>
                  </table>

                      </div>




              </div>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
      
    </div>
   </section>


          


