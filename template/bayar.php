<?php 
if (isset($_GET['aksiok'])) 
{
  if ($_GET['aksiok']='okbayar') 
  {
    $idpen=$_SESSION['id_penjualan'];
    $idpel=$_SESSION['id_pelanggan'];
	$alamatpeng=$_SESSION['alamatpeng'];
	$tot=$_SESSION['totalhasilall'];
  	$jml=$_SESSION['jumlahbarang'];

    
    mysqli_query($db,"insert into tb_detailpenjualan(id_penjualan,id_barang,jumlah) select '$idpen' as id_penjualan,id_barang,jumlah from tmp_penjualan where id_penjualan='$idpen' and id_pelanggan='$idpel' ");
    mysqli_query($db,"insert into tb_penjualan(id_penjualan,id_pelanggan,tgl_penjualan,alamat_pengiriman,totalharga,jumlahbarang) VALUES ('$idpen','$idpel',curdate(),'$alamatpeng','$tot','$jml') ");

    mysqli_query($db,"delete from tmp_penjualan where id_penjualan='$idpen' and id_pelanggan='$idpel' ");

    $_SESSION['id_penjualan']=date('dmYHis').$idpel;
        echo "<script>window.location='index.php?halaman=profil';</script>";
                  
  }
}
 ?>

<?php 
  $no=1;
  $idpen=$_SESSION['id_penjualan'];
  $idpel=$_SESSION['id_pelanggan'];
  $alamatpeng=$_SESSION['alamatpeng'];
  $query1=mysqli_query($db,"select sum(harga) as totalharga,count(a.id_barang) as jumlahbarang from tmp_penjualan a join tb_barang b on a.id_barang=b.id_barang where id_penjualan='$idpen' and id_pelanggan='$idpel'");
  $hitung1= mysqli_num_rows($query1);
  if($hitung1>0){
  while ($pecah1= mysqli_fetch_assoc($query1)) {
  $totall=$_SESSION['totalhasilall'];  
  $_SESSION['jumlahbarang']=$pecah1['jumlahbarang'];          
?>
<table class="table table-bordered">
			 <tr><th>Form Pembayaran </th></tr>
			 <tr> 
			 <td>
			 	<br>
				<form class="form-horizontal">
				  <div class="control-group">
					<label><pre>Silahkan Transfer ke Bank BRI, nomer rekening 3084-505696-69560 dengan jumlah yang di bayarkan sebesar Rp. <?php echo rupiah($totall); ?></pre></label>
				  </div>
				  
				</form>				  
			  </td>
			  </tr>
            </table>
            <a href="index.php?halaman=bayar&aksiok=okbayar" class="btn btn-large btn-success"> OK Bayar </a>	
<?php }} ?>