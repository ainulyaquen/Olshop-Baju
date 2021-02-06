<?php 
if(empty($_SESSION['id_pelanggan'])){
	echo "";
}else{

if (isset($_GET['aksihp'])) 
{
  if ($_GET['aksihp']='hapus') 
  {
    $idhps=$_GET['idhps'];

    mysqli_query($db,"delete from tmp_penjualan where id_detailpenjualan='$idhps'");
                  
        echo "<script>alert('Data Berhasil Terhapus')</script>";
        echo "<script>window.location='index.php?halaman=pembayaran';</script>";
                  
  }
}
 ?>
<?php 
  $no=1;
  $idpen=$_SESSION['id_penjualan'];
  $idpel=$_SESSION['id_pelanggan'];
  $query2=mysqli_query($db,"select sum(harga) as totalharga,count(a.id_barang) as jumlahbarang from tmp_penjualan a join tb_barang b on a.id_barang=b.id_barang where id_penjualan='$idpen' and id_pelanggan='$idpel'");
  $hitung2= mysqli_num_rows($query2);
  if($hitung2>0){
  while ($pecah2= mysqli_fetch_assoc($query2)) {                 
?>
<h3>  KERANJANG BELANJA [ <small><?php echo $pecah2['jumlahbarang']?> Barang </small>]<a href="index.php" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Lanjut Belanja </a></h3>
<?php }} ?>	
	<hr class="soft"/>
	<?php 
		if (empty($_SESSION['nama_pelanggan'])) {
		        echo '<table class="table table-bordered">
		<tr><th> SILAHKAN LOGIN TERLEBIH DAHULU SEBELUM MELAKUKAN TRANSAKSI PEMBELIAN  </th></tr>
		 <tr> 
		 <td>
			<form class="form-horizontal">
				<br>
				<div class="control-group">
				  <label class="control-label" for="inputUsername">Username</label>
				  <div class="controls">
					<input type="text" id="inputUsername" placeholder="Username">
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="inputPassword1">Password</label>
				  <div class="controls">
					<input type="password" id="inputPassword1" placeholder="Password">
				  </div>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn">Login</button>
				  </div>
				</div>
			</form>
		  </td>
		  </tr>
	</table>';
		}
		else{
			echo '';
}


	 ?>
		
	<?php 
                      
                      $idpen1=$_SESSION['id_penjualan'];
    				  $idpel1=$_SESSION['id_pelanggan'];
                      $query1=mysqli_query($db,"select * from tmp_penjualan a join tb_barang b on a.id_barang=b.id_barang where id_penjualan='$idpen1' and id_pelanggan='$idpel1'");
                      $hitung1= mysqli_num_rows($query1);
                      if($hitung1>0){                 
                  ?>		
	<table class="table table-bordered">
			 <tr><th>Alamat Pengiriman </th></tr>
			 <tr> 
			 <td>
			 	<br>
				  <div class="control-group">
					<div class="controls">
					  <textarea type="text" name="alamatpeng" rows="5" style="width: 80%;" required><?php $alamat=$_SESSION['alamatpeng']; echo $alamat; ?></textarea>
					</div>
				  </div>			  
			  </td>
			  </tr>
            </table>
            <table class="table table-bordered">
			 <tr><th>Jasa Kirim</th></tr>
			 <tr> 
			 <td>
			 	<br>
				<form name="form" method="post">
				  <div class="control-group">
					<div class="controls">
						<button class="btn" name="submit" type="button" onclick="tambah()"><img src='gambar/jne.png' style="width:20%;"></button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<button class="btn" name="submit" type="button" onclick="tambah2()"><img src='gambar/tiki.png' style="width:20%;"></button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<button class="btn" name="submit" type="button" onclick="tambah3()"><img src='gambar/jt.png' style="width:20%;"></button>
					  <!-- <textarea type="text" name="alamatpeng" rows="5" style="width: 80%;" required></textarea> -->
					</div>
				  </div>			  
			  </td>
			  </tr>
            </table>			
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th><input type="hidden" name="totalhasilall" id="ttt">
                  	<input type="hidden" name="jne" id="jne" value="19000">
                  	<input type="hidden" name="tiki" id="tiki" value="22000">
                  	<input type="hidden" name="jt" id="jt" value="25000">
                  	<input type="hidden" name="jnehasil" id="jnehasil" value="<?php echo $_SESSION['totalhargases']; ?>">
                  	<input type="hidden" name="tikihasil" id="tikihasil" value="<?php echo $_SESSION['totalhargases']; ?>">
                  	<input type="hidden" name="jthasil" id="jthasil" value="<?php echo $_SESSION['totalhargases']; ?>">
                  Produk</th>
                  <th>Nama Produk</th>
                  <th>Jumlah</th>
				  <th>Harga</th>
                  <th>Diskon</th>
                  <th>Total</th>
                  <th>Aksi</th>
				</tr>
              </thead>
              <tbody>
          		<?php 
                      $no=1;
                      $idpen=$_SESSION['id_penjualan'];
    				  $idpel=$_SESSION['id_pelanggan'];
                      $query=mysqli_query($db,"select * from tmp_penjualan a join tb_barang b on a.id_barang=b.id_barang where id_penjualan='$idpen' and id_pelanggan='$idpel'");
                      $hitung= mysqli_num_rows($query);
                      if($hitung>0){
                      while ($pecah= mysqli_fetch_assoc($query)) {                 
                  ?>
                <tr>
                  <td> <img width="60" src="gambar/<?php echo $pecah['gambar']?>" alt=""/></td>
                  <td> 
                  	
                  	<?php echo $pecah['nama_barang']?>
                  </td>
				  <td>
				  	<center>
					<!-- <div class="input-append"><input class="span1" style="max-width:34px" value="0" name="hasil1" size="16" type="text"><button class="btn" type="button" name=submit onclick="kurang()"><i class="icon-minus"></i></button><button class="btn" name="submit1" type="button" onclick="tambah()"><i class="icon-plus"></i></div> -->
					<?php echo $pecah['jumlah']?>
					</center>
				  </td>
                  <td><?php echo rupiah($pecah['harga'])?></td>
                  <td>Rp. 0</td>
                  <td><?php echo rupiah($pecah['harga'])?></td>
                  <td>
                  	<a onclick=" return confirm('Anda Yakin Ingin Menghapus??')" href="index.php?halaman=pembayaran&aksihp=hapus&idhps=<?php echo $pecah['id_detailpenjualan'] ?>" class="btn btn-xs btn-danger">Hapus</a>
                  </td>
                </tr>
            	<?php }} ?>
				<?php 
                      $no=1;
                      $idpen=$_SESSION['id_penjualan'];
    				  $idpel=$_SESSION['id_pelanggan'];
                      $query1=mysqli_query($db,"select sum(harga) as totalharga,count(a.id_barang) as jumlahbarang from tmp_penjualan a join tb_barang b on a.id_barang=b.id_barang where id_penjualan='$idpen' and id_pelanggan='$idpel'");
                      $hitung1= mysqli_num_rows($query1);
                      if($hitung1>0){
                      while ($pecah1= mysqli_fetch_assoc($query1)) { 
                      	$_SESSION['totalhargases']=$pecah1['totalharga'];                
                  ?>
                <tr>
                  <td colspan="6" style="text-align:right">Total Harga:	</td>
                  <td> <?php echo rupiah($pecah1['totalharga'])?></td>
                </tr>
				 <tr>
                  <td colspan="6" style="text-align:right">Total Diskon: </td>
                  <td> Rp. 0</td>
                </tr>
                <tr>
                  <td colspan="6" style="text-align:right">Jasa Kirim: <label id="labeljasa"></label></td>
                  <td><label id="test1"></label></td>
                </tr>
				 <tr>
                  <td colspan="6" style="text-align:right"><strong>TOTAL</strong></td>
                  <td class="label label-important" style="display:block"> <strong> <label name="totalhasilsemua" id="totalhasil"></label> </strong></td>
                </tr>
            	<?php }} ?>
            
				</tbody>
            </table>
		
		
            <!-- <table class="table table-bordered">
			<tbody>
				 <tr>
                  <td> 
				<form class="form-horizontal">
				<div class="control-group">
				<label class="control-label"><strong> VOUCHERS CODE: </strong> </label>
				<div class="controls">
				<input type="text" class="input-medium" placeholder="CODE">
				<button type="submit" class="btn"> ADD </button>
				</div>
				</div>
				</form>
				</td>
                </tr>
				
			</tbody>
			</table> -->
			
<button type="submit" name="lanjut" class="btn btn-large pull-right">Bayar <i class="icon-arrow-right"></i></button>			
		<?php }else{ ?>		
	<a href="index.php" class="btn btn-large"><i class="icon-arrow-left"></i> Lanjut Belanja </a>
	<?php } ?>
	</form>		
	<?php 
		if(isset($_POST['lanjut']))
        {
        	$_SESSION['totalhasilall']=$_POST['totalhasilall'];
        	echo "<script>window.location='index.php?halaman=bayar';</script>";
        }

	 ?>

<?php } ?>
	