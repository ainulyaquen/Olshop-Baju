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

<div class="well well-small">
			<h4>Produk Terbaru </h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
			<div class="carousel-inner">



					<?php 
                      $no=1;
	                  $query1=mysqli_query($db,"select * from tb_detailkategori WHERE id_detailkategori IN(SELECT id_detailkategori FROM tb_barang GROUP BY id_detailkategori)");
	                  $hitung1= mysqli_num_rows($query1);
	                  if($hitung1>0){
	                  while ($pecahdet= mysqli_fetch_assoc($query1)) { 

	                  	$iddetk=$pecahdet['id_detailkategori'];

                    ?>
			  <div class="item <?php if($no==1){ echo 'active'; }else{ echo '';} ?>">
			  <ul class="thumbnails">

					<?php 
                          
                          $query=mysqli_query($db,"select * from tb_barang a join tb_detailkategori b on a.id_detailkategori=b.id_detailkategori where b.id_detailkategori='$iddetk' limit 4");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {                 
                      ?>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details.html"><img src="gambar/<?php echo $pecah['gambar'] ?>" alt=""></a>
					<div class="caption">
					  <h5><?php echo $pecah['nama_barang'] ?></h5>
					  <h4 style="text-align:center">
					  	
					  	<a class="btn" onclick=" return confirm('Anda Yakin Ingin Membeli??')" href="index.php?aksi=beli&id=<?php echo $pecah['id_barang'] ?>"><i class="icon-shopping-cart"></i></a>

					  	&nbsp 

					  	<a class="btn btn-success" ><?php echo rupiah($pecah['harga']) ?></a></h4>
					</div>
				  </div>
				</li>
					<?php }} ?>

			  </ul>
			  </div>
			  <?php $no++; }} ?>





			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
		</div>