<?php 
if (isset($_GET['aksi'])) 
{
  if ($_GET['aksi']='hapus') 
  {
    $id=$_GET['id'];

    mysqli_query($db,"delete from tb_supplier where id_supplier='$id'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=supplier';</script>";
                  
  }
}
 ?>

<section class="content-header">
          <h1>
            Supplier
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i>Data Master</a></li>
            <li class="active">Supplier</li>
          </ol>
        </section>
    
  <section class="content">
     <div class="row">
    
<div class="col-md-12">
  <div class="box box-info ">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Supplier</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                  <a type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahdata"><i class="fa fa-plus"></i> Tambah </a><br><br>

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"select * from tb_supplier");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['id_supplier'] ?></td>
                        <td><?php echo $pecah['nama_supplier'] ?></td>
                        <td><?php echo $pecah['alamat'] ?></td>
                        <td><?php echo $pecah['telp'] ?></td>
                        <td>
                          <a class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=supplier&aksi=hapus&id=<?php echo $pecah['id_supplier'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
                            <h4 class="modal-title">Tambah Data Supplier</h4>
                        </div>
                        <div class="modal-body">

                          
                            <form role="form" method="POST">
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input type="text" class="form-control" required="" name="nama">
                                <label>Alamat</label>
                                <textarea type="text" row="2" class="form-control" required="" name="alamat"></textarea>
                                <label>Telepon</label>
                                <input type="text" class="form-control" required="" name="telp">
                            </div>
                            <button type="submit" name="save" class="btn btn-lg btn-success"><i class="fa fa-save"></i> Simpan</button>
                            </form>

                                
                                
                            <?php
                                if(isset($_POST['save']))
                                {
                                  $sql="SELECT max(id_supplier) as terakhir from tb_supplier";
                                  $hasil= mysqli_query($db,$sql);
                                  $data= mysqli_fetch_array($hasil);
                                  $lastID= $data['terakhir'];
                                  $lastnourut= (int)substr($lastID,2, 4);
                                  $nextnourut=$lastnourut+1;
                                  $nextID="SP".sprintf("%04s",$nextnourut);
                                  
                                  
                                  $nama=$_POST['nama'];
                                  $alamat=$_POST['alamat'];
                                  $telp=$_POST['telp'];
                                  
                                  mysqli_query($db,"INSERT INTO tb_supplier(id_supplier,nama_supplier,alamat,telp) 
      VALUES ('$nextID','$nama','$alamat','$telp')");

                                    echo "<script>alert('Data Berhasil Tersimpan')</script>";
                                    echo "<script>window.location='homeadmin.php?halaman=supplier';</script>";
                                  
                                }
                          ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
          


