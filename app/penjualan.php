<?php 
if (isset($_GET['aksi'])) 
{
  if ($_GET['aksi']='hapus') 
  {
    $id=$_GET['id'];

    mysqli_query($db,"delete from tb_pegawai where id_pegawai='$id'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=penjualan';</script>";
                  
  }
}

if (isset($_GET['aksiubah'])) 
{
  if ($_GET['aksiubah']='ubahstatus') 
  {
    $idpenj=$_GET['idpenj'];

    mysqli_query($db,"update tb_penjualan set keterangan='Mengirim Barang' where id_penjualan='$idpenj'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='homeadmin.php?halaman=penjualan';</script>";
                  
  }
}

 ?>
<section class="content-header">
          <h1>
            Penjualan
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i>Transaksi</a></li>
            <li class="active">Penjualan</li>
          </ol>
        </section>
    
  <section class="content">
     <div class="row">
    
<div class="col-md-12">
  <div class="box box-info ">
                <div class="box-header with-border">
                  <center><h3 class="box-title">Data Penjualan</h3></center>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <br>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID Penjualan</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Invoice</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          $query=mysqli_query($db,"select id_penjualan,tgl_penjualan,b.id_pelanggan,b.nama_pelanggan,alamat_pengiriman,keterangan,invoice from tb_penjualan a join tb_pelanggan b on a.id_pelanggan=b.id_pelanggan where keterangan!='pesan'");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><a href='#myModal' id='custId' data-toggle='modal' data-id="<?php echo $pecah['id_penjualan'] ?>"><?php echo $pecah['id_penjualan'] ?></a></td>
                        <td><?php echo $pecah['nama_pelanggan'] ?></td>
                        <td><?php echo $pecah['tgl_penjualan'] ?></td>
                        <td><?php echo $pecah['keterangan'] ?></td>
                        <td><a href="invoice/<?php echo $pecah['invoice']?>" target="_blank" class="btn btn-xs btn-success">Cetak Invoice</a></td>
                        <td>
                          <?php if($pecah['keterangan']=='Lunas'){
                            echo "<a onclick='return confirm('Apakah Anda Yakin???')' href='template/mailinvoice.php?ak=invoice&idpnj=".$pecah['id_penjualan']."&idpl=".$pecah['id_pelanggan']."' class='btn btn-xs btn-success'>Mengirim Barang</a>";
                        }if($pecah['keterangan']=='Mengirim Barang'){
                          echo '<a class="btn btn-xs btn-success">Selesai</a>';
                        } ?>
                          <a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="homeadmin.php?halaman=penjualan&aksi=hapus&id=<?php echo $pecah['id_penjualan'] ?>" class="btn btn-xs btn-danger">Hapus</a>
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


<div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Detail Penjualan</h4>
                        </div>
                        <div class="modal-body">
                            <div class="fetched-data"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

