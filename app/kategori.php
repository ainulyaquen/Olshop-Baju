<?php 
if (isset($_GET['aksi'])) 
{
  if ($_GET['aksi']='hapus') 
  {
    $id=$_GET['id'];

    mysqli_query($db,"delete from tb_kategori where id_kategori='$id'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=kategori';</script>";
                  
  }
}
if (isset($_GET['aksidet'])) 
{ 
  if ($_GET['aksidet']='hapuskat') 
  {
    $iddet=$_GET['iddet'];

    mysqli_query($db,"delete from tb_detailkategori where id_detailkategori='$iddet'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=kategori';</script>";
                  
  }
}
 ?>


<section class="content-header">
          <h1>
            Kategori
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i>Data Master</a></li>
            <li class="active">Kategori</li>
          </ol>
        </section>
    
  <section class="content">
     <div class="row">
    
<div class="col-md-12">
  <div class="box box-info ">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Kategori</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                  <a type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahdata"><i class="fa fa-plus"></i> Tambah </a><br><br>
          <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Kategori</a></li>
                <li><a href="#tab2" data-toggle="tab">Detail Kategori</a></li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="tab1">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"select * from tb_kategori");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['id_kategori'] ?></td>
                        <td><?php echo $pecah['nama_kategori'] ?></td>
                        <td>
                          <a class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=kategori&aksi=hapus&id=<?php echo $pecah['id_kategori'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php $no++;}} ?>

                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="tab2">
                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Detail Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"select * from tb_detailkategori a join tb_kategori b on a.id_kategori=b.id_kategori");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['id_detailkategori'] ?></td>
                        <td><?php echo $pecah['nama_kategori'] ?></td>
                        <td><?php echo $pecah['nama_detailkategori'] ?></td>
                        <td>
                          <a class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=kategori&aksidet=hapuskat&iddet=<?php echo $pecah['id_detailkategori'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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


<div id="tambahdata" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Tambah Data Kategori</h4>
                        </div>
                        <div class="modal-body">

                          <div class="nav-tabs-custom">
                              <ul class="nav nav-tabs">
                                <li class="active"><a href="#kat1" data-toggle="tab">Kategori</a></li>
                                <li><a href="#kat2" data-toggle="tab">Detail Kategori</a></li>
                              </ul>
                              <div class="tab-content">
                                <div class="active tab-pane" id="kat1">
                                <form role="form" method="POST">
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" class="form-control" required="" name="namakat">
                                </div>
                                <button type="submit" name="savekat" class="btn btn-lg btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </form>
                                </div>

                                <div class="tab-pane" id="kat2">
                                <form role="form" method="POST">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" style="width: 100%;" name="iddetkat" id="nomer">
                                      <?php 
                                        $queryadd=mysqli_query($db,"select * from tb_kategori");
                                          $hitungadd= mysqli_num_rows($queryadd);
                                          if($hitungadd>0){
                                          while ($pecahadd= mysqli_fetch_assoc($queryadd)) {
                                        ?>
                                      <option value="<?php echo $pecahadd['id_kategori'] ?>">
                                        <?php echo $pecahadd['nama_kategori'] ?></option>
                                      <?php }} ?>
                                    </select>
                                    <label>Nama Detail Kategori</label>
                                    <input type="text" class="form-control" required="" name="namadet">
                                </div>
                                <button type="submit" name="savedet" class="btn btn-lg btn-success"><i class="fa fa-save"></i> Simpan</button>
                                </form>
                                </div>
                              </div>
                            </div>
                            <?php
                                if(isset($_POST['savekat']))
                                {
                                  $sql="SELECT max(id_kategori) as terakhir from tb_kategori";
                                  $hasil= mysqli_query($db,$sql);
                                  $data= mysqli_fetch_array($hasil);
                                  $lastID= $data['terakhir'];
                                  $lastnourut= (int)substr($lastID,2, 4);
                                  $nextnourut=$lastnourut+1;
                                  $nextID="KT".sprintf("%04s",$nextnourut);
                                  $namakat=$_POST['namakat'];
                                  
                                  mysqli_query($db,"INSERT INTO tb_kategori(id_kategori,nama_kategori) 
      VALUES ('$nextID','$namakat')");

                                    echo "<script>alert('Data Berhasil Tersimpan')</script>";
                                    echo "<script>window.location='homeadmin.php?halaman=kategori';</script>";
                                  
                                }else if(isset($_POST['savedet']))
                                {
                                  $namadet=$_POST['namadet'];
                                  $iddetkat=$_POST['iddetkat'];
                                  
                                  mysqli_query($db,"INSERT INTO tb_detailkategori(id_kategori,nama_detailkategori) 
      VALUES ('$iddetkat','$namadet')");

                                    echo "<script>alert('Data Berhasil Tersimpan')</script>";
                                    echo "<script>window.location='homeadmin.php?halaman=kategori';</script>";
                                  
                                }
                          ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
          


