<?php 

if (isset($_GET['ak'])) 
{
  if ($_GET['ak']='invoice') 
  {
    $idpen=$_GET['idpnj'];
    $idpel=$_GET['idpl'];

                  
  }
}

function rupiah($angka){
    $hasil_rupiah= number_format($angka,0,'.','.');
    return $hasil_rupiah;

}
 ?>

<html>


<head>

<style type="text/css">
.tabel {border-collapse: collapse;}
.tabel th {padding: 8px 10px; background-color: #CFD5F7;}
.tabel td {padding: 8px 10px;}
hr{width: 700px; color: blue; position: center;}
img {height: 90px;}
</style>
</head>






<body>
  <p align="center"><img src="../gambar/logo2.jpg"></p> 
<hr>
<br>
<h1 align="center">Invoice Pembayaran</h1>
<br><br>
<table cellspacing="7" cellpadding="7" width="1000" border="2" class="tabel" align="center">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th>Nama Produk</th>
                  <th>Jumlah</th>
				  <th>Harga</th>
                  <th>Diskon</th>
                  <th>Total</th>
				</tr>
              </thead>
              <tbody>
          		<?php 
                      $no=1;
                      $query=mysqli_query($db,"select b.gambar,b.nama_barang,b.harga,a.jumlah from tb_detailpenjualan a join tb_barang b on a.id_barang=b.id_barang JOIN tb_penjualan c ON a.id_penjualan=c.id_penjualan where a.id_penjualan='$idpen' and c.id_pelanggan='$idpel'");
                      $hitung= mysqli_num_rows($query);
                      if($hitung>0){
                      while ($pecah= mysqli_fetch_assoc($query)) {                 
                  ?>
                <tr>
                  <td> <img width="60" src="../gambar/<?php echo $pecah['gambar']?>" alt=""/></td>
                  <td> 
                  	
                  	<?php echo $pecah['nama_barang']?>
                  </td>
				  <td>
				  	
					<!-- <div class="input-append"><input class="span1" style="max-width:34px" value="0" name="hasil1" size="16" type="text"><button class="btn" type="button" name=submit onclick="kurang()"><i class="icon-minus"></i></button><button class="btn" name="submit1" type="button" onclick="tambah()"><i class="icon-plus"></i></div> -->
					<?php echo $pecah['jumlah']?>
					
				  </td>
                  <td><?php echo rupiah($pecah['harga'])?></td>
                  <td>Rp. 0</td>
                  <td><?php echo rupiah($pecah['harga'])?></td>
                  
                </tr>
            	<?php }} ?>
				<?php 
                      $no=1;
                      $query1=mysqli_query($db,"SELECT SUM(harga) AS totalhargaawal,COUNT(a.id_barang) AS jumlahbarang,c.totalharga,c.totalharga-SUM(harga) AS jasakirim
FROM tb_detailpenjualan a JOIN tb_barang b ON a.id_barang=b.id_barang JOIN tb_penjualan c ON a.id_penjualan=c.id_penjualan 
WHERE a.id_penjualan='$idpen' AND c.id_pelanggan='$idpel'");
                      $hitung1= mysqli_num_rows($query1);
                      if($hitung1>0){
                      while ($pecah1= mysqli_fetch_assoc($query1)) {                 
                  ?>
                <tr>
                  <td colspan="5" style="text-align:right">Total Harga:	</td>
                  <td> Rp. <?php echo rupiah($pecah1['totalhargaawal'])?></td>
                </tr>
				 <tr>
                  <td colspan="5" style="text-align:right">Total Diskon: </td>
                  <td> Rp. 0</td>
                </tr>
                <tr>
                  <td colspan="5" style="text-align:right">Jasa Kirim: </td>
                  <td> Rp. <?php echo rupiah($pecah1['jasakirim'])?></td>
                </tr>
				 <tr>
                  <td colspan="5" style="text-align:right;background-color: #FA8F5B;" ><strong>TOTAL</strong></td>
                  <td style="background-color: #FA8F5B;"> Rp. <strong><?php echo rupiah($pecah1['totalharga'])?> </strong></td>
                </tr>
            	<?php }} ?>
            
				</tbody>
            </table>
</body>
</html>