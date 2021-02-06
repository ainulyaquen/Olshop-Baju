
<h3>  RIWAYAT BELANJA </h3>
<hr class="soft"/>
<table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Status Barang</th>
				          <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Alamat</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
				</tr>
              </thead>
              <tbody>
              	<form name="form">
          		<?php 
                      $no=1;
                      $idpen=$_SESSION['id_penjualan'];
    				          $idpel=$_SESSION['id_pelanggan'];
                      $query=mysqli_query($db,"select * from tb_penjualan a join tb_pelanggan b on a.id_pelanggan=b.id_pelanggan where a.id_pelanggan='$idpel'");
                      $hitung= mysqli_num_rows($query);
                      if($hitung>0){
                      while ($pecah= mysqli_fetch_assoc($query)) {                 
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $pecah['tgl_penjualan']?></td>
				  <td>
				  	<center>
					<!-- <div class="input-append"><input class="span1" style="max-width:34px" value="0" name="hasil1" size="16" type="text"><button class="btn" type="button" name=submit onclick="kurang()"><i class="icon-minus"></i></button><button class="btn" name="submit1" type="button" onclick="tambah()"><i class="icon-plus"></i></div> -->
					<?php if($pecah['keterangan']=='pesan'){echo "Belum Lunas";}else if($pecah['keterangan']=='Lunas'){echo "Pembayaran Lunas";}else{echo "Barang Sedang DiKirim";}?>
					</center>
				  </td>
                  <td><?php echo rupiah($pecah['totalharga'])?></td>
                  <td><CENTER><?php echo $pecah['jumlahbarang']?></CENTER></td>
                  <td><?php echo $pecah['alamat_pengiriman']?></td>
                  <td><a href="gambar/<?php echo $pecah['gambar']?>" target="_blank"><img src="gambar/<?php echo $pecah['gambar']?>" style="width: 30%;"></a></td>
                  <td>
                  	<a id="actiongambar" data-toggle="modal" data-target="#gambar" data-id="<?php echo $pecah['id_penjualan']?>" class="btn btn-xs btn-success">Upload Nota</a>
                  </td>
                </tr>
            	<?php $no++; }} ?>
				</form>
				
				</tbody>
            </table>

<div id="gambar" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Upload Gambar</h3>
      </div>
      <div class="modal-body">
      <form class="form-horizontal loginFrm" method="POST" enctype="multipart/form-data">
        <div class="form-control"> 
        <input type="hidden" name="idpen" id="idpen">               
        <center><input type="file" class="form-control" required="" name="gambar"></center>
        </div>
        <br>
        <center><button name="upload" type="submit" class="btn btn-success">Upload Gambar</button></center>
      </form>

      <?php
                                if(isset($_POST['upload']))
                                {
                                  
                                  $idpenj=$_POST['idpen'];
                                  $gambar=$_FILES['gambar']['name'];
                                  $tmp=$_FILES['gambar']['tmp_name'];

                                  $fotobaru = date('dmYHis').$_SESSION['id_penjualan'].$gambar;
                                  $path="gambar/".$fotobaru;

                                  if(move_uploaded_file($tmp,$path)){
                                  
                                  mysqli_query($db,"UPDATE tb_penjualan set gambar='$fotobaru' where id_penjualan='$idpenj'");

                                    echo "<script>alert('Data Berhasil Tersimpan')</script>";
                                    echo "<script>window.location='index.php?halaman=profil';</script>";
                                  }
                                }
                          ?>
      </div>
  </div>

  