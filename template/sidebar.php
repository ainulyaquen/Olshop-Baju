			
					<?php 
                          $query=mysqli_query($db,"select * from tb_kategori");
                          $hitung= mysqli_num_rows($query);
                          if($hitung>0){
                          while ($pecah= mysqli_fetch_assoc($query)) {   

                          $idkat=$pecah['id_kategori'];              
                     ?>


			<li class="subMenu"><a> <?php echo $pecah['nama_kategori'] ?></a>
				<ul>

					<?php 
                      
	                  $query1=mysqli_query($db,"select * from tb_detailkategori where id_kategori='$idkat'");
	                  $hitung1= mysqli_num_rows($query1);
	                  if($hitung1>0){
	                  while ($pecahdet= mysqli_fetch_assoc($query1)) {                 
                    ?>

				<li><a href="index.php?halaman=tes&idkat=<?php echo $pecahdet['id_detailkategori'] ?>"><i class="icon-chevron-right"></i><?php echo $pecahdet['nama_detailkategori'] ?> </a></li>

						<?php }} ?>

				</ul>
			</li>

			<?php }} ?>


		<!-- 	<li class="subMenu"><a> Sepatu [840] </a>
			<ul style="display:none">
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Sepatu Bola(45)</a></li>
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Sepatu Basket (8)</a></li>												
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Sepatu Voli (5)</a></li>												
			</ul>
			</li>
			<li class="subMenu"><a>Bola [1000]</a>
				<ul style="display:none">
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Bola Sepak  (35)</a></li>
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Bola Fustal (8)</a></li>												
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Bola Basket (5)</a></li>	
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Bola Voli  (45)</a></li>
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Bola Takrau (8)</a></li>												
			</ul>
			</li>
			<li class="subMenu"><a>Badminton [1000]</a>
				<ul style="display:none">
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Raket  (35)</a></li>
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Tas Raket (8)</a></li>
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Kok (5)</a></li>						
			</ul>
			</li>
			<li class="subMenu"><a>Lain-lain [1000]</a>
				<ul style="display:none">
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Deker  (35)</a></li>
				<li><a href="index.php?halaman=tes"><i class="icon-chevron-right"></i>Keranjang Bola  (35)</a></li>						
			</ul>
			</li> -->