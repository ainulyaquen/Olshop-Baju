<?php 
if (isset($_GET['idkat'])) 
      {
            $iddet=$_GET['idkat'];
      }
 ?>


<?php 
if (isset($_GET['aksi'])) 
{
  if ($_GET['aksi']='beli') 
  {
    $id=$_GET['id'];
    $idpen=$_SESSION['id_penjualan'];
    $idpel=$_SESSION['id_pelanggan'];

    if(empty($_SESSION['id_pelanggan'])){
    	echo "<script>alert('Silahkan Login Terlebih Dahulu Sebelum Melakukan Pembelian!!!')</script>";
        echo "<script>window.location='index.php';</script>";
    }else{
    mysqli_query($db,"insert into tmp_penjualan(id_penjualan,id_pelanggan,id_barang,jumlah) VALUES ('$idpen','$idpel','$id','1') ");
                  
        echo "<script>alert('Berhasil Membeli Barang')</script>";
        echo "<script>window.location='index.php';</script>";
    }
                  
  }
}
 ?>

<ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active"> Daftar Produk</li>
    </ul>
    <hr class="soft"/>
<h4>Daftar Produk </h4>
			  <ul class="thumbnails">

					<?php 
                          $query=mysqli_query($db,"select * from tb_barang a join tb_detailkategori b on a.id_detailkategori=b.id_detailkategori where b.id_detailkategori='$iddet'");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
				<li class="span3">
				  <div class="thumbnail">
					<a  href=""><img src="gambar/<?php echo $pecah['gambar'] ?>" style="width:50%;"></a>
					<div class="caption">
					  <h5><?php echo $pecah['nama_barang'] ?></h5>
					  <p> 
						<!-- Lorem Ipsum is simply dummy text.  -->
					  </p>
					 
					  <h4 style="text-align:center"><a class="btn" onclick=" return confirm('Anda Yakin Ingin Membeli??')" href="index.php?aksi=beli&id=<?php echo $pecah['id_barang'] ?>"><i class="icon-shopping-cart"></i></a>&nbsp<a class="btn" href="product_details.html"><?php echo $pecah['stok'] ?></a>  <a class="btn btn-primary" ><?php echo rupiah($pecah['harga']) ?></a></h4>
					</div>
				  </div>
				</li>
				<?php }} ?>
			  </ul>	
