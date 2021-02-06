<?php 
if (isset($_GET['aksi'])) 
{
  if ($_GET['aksi']='hapus') 
  {
    $id=$_GET['id'];

    mysqli_query($db,"delete from tb_supplier where id_supplier='$id'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=barang';</script>";
                  
  }
}
 ?>

<section class="content-header">
          <h1>
            Data Master Barang
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i>Data Master</a></li>
            <li class="active">Barang</li>
          </ol>
        </section>
    
  <section class="content">
     <div class="row">
    
<div class="col-md-12">
  <div class="box box-info ">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Barang</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                  <a type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahdata"><i class="fa fa-plus"></i> Tambah </a><br><br>

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"select * from tb_barang a join tb_detailkategori b on a.id_detailkategori=b.id_detailkategori");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['id_barang'] ?></td>
                        <td><?php echo $pecah['nama_detailkategori'] ?></td>
                        <td><?php echo $pecah['nama_barang'] ?></td>
                        <td><?php echo rupiah($pecah['harga']) ?></td>
                        <td><?php echo $pecah['stok'] ?></td>
                        <td><img src="gambar/<?php echo $pecah['gambar'] ?>" width="50px" height="50px"></td>
                        <td>
                          <a class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=barang&aksi=hapus&id=<?php echo $pecah['id_barang'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php $no++;}} ?>

                    </tbody>
                  </table>
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
                            <h4 class="modal-title">Tambah Data Barang</h4>
                        </div>
                        <div class="modal-body">

                          
                            <form role="form" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Kategori</label>
                                    <select class="form-control" style="width: 100%;" name="iddetkat" id="nomer">
                                      <?php 
                                        $queryadd=mysqli_query($db,"select * from tb_detailkategori");
                                          $hitungadd= mysqli_num_rows($queryadd);
                                          if($hitungadd>0){
                                          while ($pecahadd= mysqli_fetch_assoc($queryadd)) {
                                        ?>
                                      <option value="<?php echo $pecahadd['id_detailkategori'] ?>">
                                        <?php echo $pecahadd['nama_detailkategori'] ?></option>
                                      <?php }} ?>
                                    </select>
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" required="" name="nama">
                                <label>Harga</label>
                                <input type="text" class="form-control" required="" name="harga">
                                <label>Stok</label>
                                <input type="text" class="form-control" required="" name="stok">
                                <label>Gambar</label>
                                <input type="file" class="form-control" required="" name="gmbr">
                            </div>
                            <button type="submit" name="save" class="btn btn-lg btn-success"><i class="fa fa-save"></i> Simpan</button>
                            </form>

                                
                                
                            <?php
                                if(isset($_POST['save']))
                                {
                                  $sql="SELECT max(id_barang) as terakhir from tb_barang";
                                  $hasil= mysqli_query($db,$sql);
                                  $data= mysqli_fetch_array($hasil);
                                  $lastID= $data['terakhir'];
                                  $lastnourut= (int)substr($lastID,2, 4);
                                  $nextnourut=$lastnourut+1;
                                  $nextID="BR".sprintf("%04s",$nextnourut);
                                  
                                  
                                  $iddetkat=$_POST['iddetkat'];
                                  $nama=$_POST['nama'];
                                  $harga=$_POST['harga'];
                                  $stok=$_POST['stok'];

                                  $gambar=$_FILES['gmbr']['name'];
                                  $tmp=$_FILES['gmbr']['tmp_name'];

                                  $fotobaru = date('dmYHis').$gambar;
                                  $path="gambar/".$fotobaru;

                                  if(move_uploaded_file($tmp,$path)){
                                  
                                  mysqli_query($db,"INSERT INTO tb_barang(id_barang,id_detailkategori,nama_barang,harga,stok,gambar) 
      VALUES ('$nextID','$iddetkat','$nama','$harga','$stok','$fotobaru')");

                                    echo "<script>alert('Data Berhasil Tersimpan')</script>";
                                    echo "<script>window.location='homeadmin.php?halaman=barang';</script>";
                                  }
                                }
                          ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
          


