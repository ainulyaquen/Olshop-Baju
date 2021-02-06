<?php 
if (isset($_GET['aksi'])) 
{
  if ($_GET['aksi']='hapus') 
  {
    $id=$_GET['id'];

    mysqli_query($db,"delete from tb_penjualan where id_penjualan='$id'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=pemesanan';</script>";
                  
  }
}
if (isset($_GET['aksilunas'])) 
{
  if ($_GET['aksilunas']='lunas') 
  {
    $idlunas=$_GET['idlunas'];

    mysqli_query($db,"update tb_penjualan set keterangan='Lunas' where id_penjualan='$idlunas'");
                  
        echo "<script>alert('Data Pemesanan telah Lunas')</script>";
        echo "<script>window.location='homeadmin.php?halaman=pemesanan';</script>";
                  
  }
}

 ?>
<section class="content-header">
          <h1>
            Pemesanan
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i>Transaksi</a></li>
            <li class="active">Pemesanan</li>
          </ol>
        </section>
    
  <section class="content">
     <div class="row">
    
<div class="col-md-12">
  <div class="box box-info ">
                <div class="box-header with-border">
                  <center><h3 class="box-title">Data Pemesanan</h3></center>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <br>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Pemesanan</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Jumlah Barang</th>
                        <th>Nota</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"select id_penjualan,tgl_penjualan,b.id_pelanggan,b.nama_pelanggan,alamat_pengiriman,gambar,keterangan,totalharga,jumlahbarang from tb_penjualan a join tb_pelanggan b on a.id_pelanggan=b.id_pelanggan where keterangan='pesan'");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $pecah['id_penjualan'] ?></td>
                        <td><?php echo $pecah['nama_pelanggan'] ?></td>
                        <td><?php echo $pecah['tgl_penjualan'] ?></td>
                        <td><?php echo rupiah($pecah['totalharga']) ?></td>
                        <td><?php echo $pecah['jumlahbarang'] ?></td>
                        <td><a href="gambar/<?php echo $pecah['gambar']?>" target="_blank"><img src="gambar/<?php echo $pecah['gambar'] ?>" style="width: 30%;"></a></td>
                        <td><?php if($pecah['keterangan']=='pesan'){echo "Menunggu Bayar";}else{echo "Pembayaran Lunas";} ?></td>
                        <td>
                          <a onclick=" return confirm('Anda Yakin Ingin Mengubah Status Pembayaran??')" href="homeadmin.php?halaman=pemesanan&aksilunas=lunas&idlunas=<?php echo $pecah['id_penjualan'] ?>"class="btn btn-xs btn-success">Lunas</a>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=pemesanan&aksi=hapus&id=<?php echo $pecah['id_penjualan'] ?>" class="btn btn-xs btn-danger">Batal</a>
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
                            <h4 class="modal-title">Tambah Data Pegawai</h4>
                        </div>
                        <div class="modal-body">

                          
                            <form role="form" method="POST">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control" required="" name="nama">
                                <label>Alamat</label>
                                <textarea type="text" row="2" class="form-control" required="" name="alamat"></textarea>
                                <label>Bagian</label>
                                <select class="form-control" name="jabatan">
                                  <option>Admin</option>
                                  <option>Kasir</option>
                                  <option>Gudang</option>
                                </select>
                            </div>
                            <button type="submit" name="save" class="btn btn-lg btn-success"><i class="fa fa-save"></i> Simpan</button>
                            </form>

                                
                                
                            <?php
                                if(isset($_POST['save']))
                                {
                                  $sql="SELECT max(id_pegawai) as terakhir from tb_pegawai";
                                  $hasil= mysqli_query($db,$sql);
                                  $data= mysqli_fetch_array($hasil);
                                  $lastID= $data['terakhir'];
                                  $lastnourut= (int)substr($lastID,2, 4);
                                  $nextnourut=$lastnourut+1;
                                  $nextID="KR".sprintf("%04s",$nextnourut);
                                  
                                  
                                  $nama=$_POST['nama'];
                                  $alamat=$_POST['alamat'];
                                  $jab=$_POST['jabatan'];
                                  
                                  mysqli_query($db,"INSERT INTO tb_pegawai(id_pegawai,nama_pegawai,alamat,jabatan) 
      VALUES ('$nextID','$nama','$alamat','$jab')");

                                    echo "<script>alert('Data Berhasil Tersimpan')</script>";
                                    echo "<script>window.location='homeadmin.php?halaman=pegawai';</script>";
                                  
                                }
                          ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>