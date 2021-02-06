<?php
  include 'app/database.php';

  function rupiah($angka){
    $hasil_rupiah= "Rp. ".number_format($angka,0,'.','.');
    return $hasil_rupiah;
	}

if (isset($_GET['aksi'])) {
  if ($_GET['aksi']=='logout') {

      session_destroy();
      echo "<script>alert('Anda Telah Logout')</script>";
      echo "<script>window.location='index.php';</script>";

  }
}
if (isset($_GET['kirim'])) {
  if ($_GET['kirim']=='email') {
  		$usernme=$_GET['user'];
  		$aktifasi=$_GET['akt'];

      mysqli_query($db,"update tb_pelanggan set status='$aktifasi' where username='$usernme' ");
      echo "<script>alert('Akun Anda Telah Berhasil Aktif')</script>";
      echo "<script>window.location='index.php';</script>";

  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootshop online Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
  </head>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<?php 

		if (empty($_SESSION['nama_pelanggan'])) {
		        echo "<div class='span6'>&nbsp Welcome!<strong> User</strong></div>";
		}
		else{ 
			$namapel=$_SESSION['nama_pelanggan'];
			echo "<div class='span6'> Welcome!<strong> $namapel</strong>&nbsp ,Tanggal ";
			$tgl =date('d');
				echo $tgl;
				$bulan =date('F');
				if ($bulan=="January") {
				 echo " Januari ";
				}elseif ($bulan=="February") {
				 echo " Februari ";
				}elseif ($bulan=="March") {
				 echo " Maret ";
				}elseif ($bulan=="April") {
				 echo " April ";
				}elseif ($bulan=="May") {
				 echo " Mei ";
				}elseif ($bulan=="June") {
				 echo " Juni ";
				}elseif ($bulan=="July") {
				 echo " Juli ";
				}elseif ($bulan=="August") {
				 echo " Agustus ";
				}elseif ($bulan=="September") {
				 echo " September ";
				}elseif ($bulan=="October") {
				 echo " Oktober ";
				}elseif ($bulan=="November") {
				 echo " November ";
				}elseif ($bulan=="December") {
				 echo " Desember ";
				}
				$tahun=date('Y');
				echo $tahun;

				echo "&nbsp,Pukul <span id='clock'></span></div>";
		}
	 ?>
	
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="index.php"><img src="gambar/logo1.jpg" width="150px"></a>
    <?php 
	          $no=1;
	          if(empty($_SESSION['id_pelanggan'])){
	          	$idpen='';
	          	$idpel='';
	          }else{
	          $idpen=$_SESSION['id_penjualan'];
			  $idpel=$_SESSION['id_pelanggan'];
				}
	          $query1=mysqli_query($db,"select sum(harga) as totalharga,count(a.id_barang) as jumlahbarang from tmp_penjualan a join tb_barang b on a.id_barang=b.id_barang where id_penjualan='$idpen' and id_pelanggan='$idpel'");
	          $hitung1= mysqli_num_rows($query1);
	          if($hitung1>0){
	          while ($pecah1= mysqli_fetch_assoc($query1)) {                 
	      ?>
	    <!-- <li class=''>  
		<a href="index.php?halaman=pembayaran"><img src="themes/images/ico-cart.png" alt="cart"><?php echo $pecah1['jumlahbarang']?> Barang<span class="badge badge-warning pull-left"><?php echo rupiah($pecah1['totalharga'])?></span></a></li> -->
		
    <ul id="topMenu" class="nav pull-right">
    	<?php 
    	if (empty($_SESSION['nama_pelanggan'])) {
		        echo "<li class=''><a href='#registrasi' data-toggle='modal'>Buat Member</a></li>
	 <li class=''>
	 <a href='#login' role='button' data-toggle='modal' style='padding-right:0'><span class='btn btn-large btn-success'>Login</span></a></li>";
		}
		else{
			echo "<li class=''><a href='index.php?halaman=pembayaran'><span class='btn btn-large btn-warning'><img src='themes/images/ico-cart.png'> ".$pecah1['jumlahbarang']." Barang ,  ".rupiah($pecah1['totalharga'])."</span></a></li>

			<li class=''><a href='index.php?halaman=profil'>Riwayat Belanja</a></li>
			<li class=''><a href='index.php?aksi=logout'><span class='btn btn-large btn-danger'>Logout</span></a></li>";
		} 

    	 ?>
	 <?php }} ?>
	<div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Login</h3>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm" method="POST">
			  <div class="form-control">								
				<center><input name="username" type="text" id="inputEmail" placeholder="Username"></center>
			  </div>
			  <div class="form-control">
				<center><input name="password" type="password" id="inputPassword" placeholder="Password"></center>
			  </div>
			  <center><button name="pelangganlogin" type="submit" class="btn btn-success">Masuk</button></center>
			</form>
		  </div>
	</div>
	<?php
              if(isset($_POST['pelangganlogin']))
              {
                $user=$_POST['username'];
                $pass=$_POST['password'];

                $cobalogin= mysqli_query($db,"select * from tb_pelanggan where username='$user' and password='$pass' and status='aktif' ");
                      $hitung= mysqli_num_rows($cobalogin);
                      $pecah= mysqli_fetch_array($cobalogin);
                      if($hitung>0)
                      {
                        $_SESSION['id_pelanggan']= $pecah['id_pelanggan'];
                        $_SESSION['username']= $pecah['username'];
                        $_SESSION['password']= $pecah['password'];
                        $_SESSION['nama_pelanggan']= $pecah['nama_pelanggan'];
                        $_SESSION['id_penjualan']= date('dmYHis').$pecah['id_pelanggan'];
                        $_SESSION['alamatpeng']=$pecah['alamat'];
                        $_SESSION['totalhargases']='0';
                        

                        echo "<script>window.location='index.php';</script>";
                      }
                      else
                      {
                        echo "<script>alert('Login Gagal, Coba Lagi.......')</script>";
                        echo "<script>window.location='index.php';</script>";
                      }
                }
        ?>
	<div id="registrasi" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Registrasi</h3>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm"  method="POST">
			  <div class="form-group">
			  	<table align="center">
			  		<tr>
			  			<th></th>
			  			<th></th>
			  		</tr>
			  		<tr>
			  			<td>Nama Pelanggan </td>
			  			<td>: <input type="text" class="form-control" required="" name="nama"></td>
			  		</tr>
			  		<tr>
			  			<td>Alamat</td>
			  			<td>: <textarea type="text" row="2" class="form-control" required="" name="alamat"></textarea></td>
			  		</tr>
			  		<tr>
			  			<td>Telepon</td>
			  			<td>: <input type="text" class="form-control" required="" name="telp"></td>
			  		</tr>
			  		<tr>
			  			<td>Email :</td>
			  			<td>: <input type="email" class="form-control" required="" name="email"></td>
			  		</tr>
			  		<tr>
			  			<td>Username</td>
			  			<td>: <input type="text" class="form-control" required="" name="user"></td>
			  		</tr>
			  		<tr>
			  			<td>Password</td>
			  			<td>: <input type="password" class="form-control" required="" name="pass"></td>
			  		</tr>
			  		<tr>
			  			<td></td>
			  			<td>&nbsp&nbsp<button name="pelanggan" type="submit" class="btn btn-success">Simpan Member</button></td>
			  		</tr>
			  	</table>
            	</div>
            	
			</form>		
		  </div>
		     <?php
                                if(isset($_POST['pelanggan']))
                                {
                                  $sql="SELECT max(id_pelanggan) as terakhir from tb_pelanggan";
                                  $hasil= mysqli_query($db,$sql);
                                  $data= mysqli_fetch_array($hasil);
                                  $lastID= $data['terakhir'];
                                  $lastnourut= (int)substr($lastID,3, 4);
                                  $nextnourut=$lastnourut+1;
                                  if(mysqli_num_rows($hasil)>0){
                                      $nextID="PLG".sprintf("%04s",$nextnourut);
                                  }
                                  else{ 
                                    $nextID= "PLG0001";
                                  }
                                  
                                  $nama=$_POST['nama'];
                                  $alamat=$_POST['alamat'];
                                  $telp=$_POST['telp'];
                                  $email=$_POST['email'];
                                  $user=$_POST['user'];
                                  $pass=$_POST['pass'];

                                  $_SESSION['emailmember']=$email;
                                  $_SESSION['usermember']=$user;
                                  $_SESSION['passmember']=$pass;


                                  
                                  mysqli_query($db,"INSERT INTO tb_pelanggan(id_pelanggan,nama_pelanggan,alamat,telp,email,username,password) 
      VALUES ('$nextID','$nama','$alamat','$telp','$email','$user','$pass')");
                                    echo "<script>window.location='template/mail.php';</script>";
                                  
                                }
                          ?>
	</div>
	</li>
    </ul>
  </div>
</div>
</div>
</div>

			<?php 
			if (isset($_GET['halaman'])) {

                 
            }
            else
            { 
            	echo '
              <div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">

		  <div class="item active">
		  <div class="container">
			<a href=""><img style="width:100%" src="gambar/beranda10.jpg" alt="special offers"/></a>
		  </div>
		  </div>
		  
		<div class="item">
		  <div class="container">
			<a href=""><img style="width:100%" src="gambar/beranda12.jpeg" alt=""/></a>
		  </div>
		  </div>

		  </div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div> ';
            }
            ?>
<!-- Header End====================================================================== -->

</div>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<div id="sidebar" class="span3">
		
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
		
			<?php include 'template/sidebar.php' ?>
		</ul>
		<br/>
			<!-- <div class="thumbnail">
				<img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
				<div class="caption">
				  <h5>Payment Methods</h5>
				</div>
			  </div> -->
	</div>
<!-- Sidebar end=============================================== -->
		<div class="span9">	

			<?php ?>

			<?php 
			if (isset($_GET['halaman'])) {
				if($_GET['halaman']=='pembayaran'){
					include 'template/pembayaran.php';
				}else if($_GET['halaman']=='bayar'){
					include 'template/bayar.php';
				}else if($_GET['halaman']=='profil'){
					include 'template/profil.php';
				}else{
                	include 'template/produk.php';
                } 
            }
            else
            {
               include 'template/produknew.php';
            }
            ?>
		
		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="login.html">YOUR ACCOUNT</a>
				<a href="login.html">PERSONAL INFORMATION</a> 
				<a href="login.html">ADDRESSES</a> 
				<a href="login.html">DISCOUNT</a>  
				<a href="login.html">ORDER HISTORY</a>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="contact.html">CONTACT</a>  
				<a href="register.html">REGISTRATION</a>  
				<a href="legal_notice.html">LEGAL NOTICE</a>  
				<a href="tac.html">TERMS AND CONDITIONS</a> 
				<a href="faq.html">FAQ</a>
			 </div>
			<div class="span3">
				<h5>OUR OFFERS</h5>
				<a href="#">NEW PRODUCTS</a> 
				<a href="#">TOP SELLERS</a>  
				<a href="special_offer.html">SPECIAL OFFERS</a>  
				<a href="#">MANUFACTURERS</a> 
				<a href="#">SUPPLIERS</a> 
			 </div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="themes/images/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="themes/images/youtube.png" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		<p class="pull-right">&copy; Metro Sport & Fasion</p>
	</div><!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<script src="themes/js/jquery.js" type="text/javascript"></script>
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
	
	<!-- Themes switcher section ============================================================================================= -->
<div id="secectionBox">
<link rel="stylesheet" href="themes/switch/themeswitch.css" type="text/css" media="screen" />
<script src="themes/switch/theamswitcher.js" type="text/javascript" charset="utf-8"></script>
	<div id="themeContainer">
	<div id="hideme" class="themeTitle">Style Selector</div>
	<div class="themeName">Oregional Skin</div>
	<div class="images style">
	<a href="themes/css/#" name="bootshop"><img src="themes/switch/images/clr/bootshop.png" alt="bootstrap business templates" class="active"></a>
	<a href="themes/css/#" name="businessltd"><img src="themes/switch/images/clr/businessltd.png" alt="bootstrap business templates" class="active"></a>
	</div>
	<div class="themeName">Bootswatch Skins (11)</div>
	<div class="images style">
		<a href="themes/css/#" name="amelia" title="Amelia"><img src="themes/switch/images/clr/amelia.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="spruce" title="Spruce"><img src="themes/switch/images/clr/spruce.png" alt="bootstrap business templates" ></a>
		<a href="themes/css/#" name="superhero" title="Superhero"><img src="themes/switch/images/clr/superhero.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="cyborg"><img src="themes/switch/images/clr/cyborg.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="cerulean"><img src="themes/switch/images/clr/cerulean.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="journal"><img src="themes/switch/images/clr/journal.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="readable"><img src="themes/switch/images/clr/readable.png" alt="bootstrap business templates"></a>	
		<a href="themes/css/#" name="simplex"><img src="themes/switch/images/clr/simplex.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="slate"><img src="themes/switch/images/clr/slate.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="spacelab"><img src="themes/switch/images/clr/spacelab.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="united"><img src="themes/switch/images/clr/united.png" alt="bootstrap business templates"></a>
		<p style="margin:0;line-height:normal;margin-left:-10px;display:none;"><small>These are just examples and you can build your own color scheme in the backend.</small></p>
	</div>
	<div class="themeName">Background Patterns </div>
	<div class="images patterns">
		<a href="themes/css/#" name="pattern1"><img src="themes/switch/images/pattern/pattern1.png" alt="bootstrap business templates" class="active"></a>
		<a href="themes/css/#" name="pattern2"><img src="themes/switch/images/pattern/pattern2.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern3"><img src="themes/switch/images/pattern/pattern3.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern4"><img src="themes/switch/images/pattern/pattern4.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern5"><img src="themes/switch/images/pattern/pattern5.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern6"><img src="themes/switch/images/pattern/pattern6.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern7"><img src="themes/switch/images/pattern/pattern7.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern8"><img src="themes/switch/images/pattern/pattern8.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern9"><img src="themes/switch/images/pattern/pattern9.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern10"><img src="themes/switch/images/pattern/pattern10.png" alt="bootstrap business templates"></a>
		
		<a href="themes/css/#" name="pattern11"><img src="themes/switch/images/pattern/pattern11.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern12"><img src="themes/switch/images/pattern/pattern12.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern13"><img src="themes/switch/images/pattern/pattern13.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern14"><img src="themes/switch/images/pattern/pattern14.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern15"><img src="themes/switch/images/pattern/pattern15.png" alt="bootstrap business templates"></a>
		
		<a href="themes/css/#" name="pattern16"><img src="themes/switch/images/pattern/pattern16.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern17"><img src="themes/switch/images/pattern/pattern17.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern18"><img src="themes/switch/images/pattern/pattern18.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern19"><img src="themes/switch/images/pattern/pattern19.png" alt="bootstrap business templates"></a>
		<a href="themes/css/#" name="pattern20"><img src="themes/switch/images/pattern/pattern20.png" alt="bootstrap business templates"></a>
		 
	</div>
	</div>
</div>
<span id="themesBtn"></span>
<script type="text/javascript">
            $(document).on("click","#actiongambar",function(){
                var idpen= $(this).data('id');
                
                $("#gambar #idpen").val(idpen);

            })

            </script>

<script type="text/javascript">        
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
    var waktu = new Date();            //membuat object date berdasarkan waktu saat 
    var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
    var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
    var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>

<script language="javascript">
 function cek(){
	
		
		 if(form.totalhasilsemua.value<1){
		  //jika angka kosong maka pesan akan tampil
		 	form.totalhasilsemua.value = 0;
		 exit;
		 }
		 
 }

 // function tambahcoba() {
	// 	 //panggil function cek
	// 	 var a=document.getElementById('tiki').value;
	// 	 var b=document.getElementById('tikihasil').value; //mengisi variabel a dengan isi dari input name angka1
	// 	 var c=parseInt(a)+1; //menjumlahkan kedua variabel
	// 	 document.getElementById('totalhasil').innerHTML=" "+c; //memberikan hasil penjumlahan ke input name total
	// 	 //cek();
	
 // }
 function tambah() {
		 //panggil function cek
		 a=eval(form.tiki.value);
		 d=eval(form.tikihasil.value); //mengisi variabel a dengan isi dari input name angka1
		 c=a+d //menjumlahkan kedua variabel
		 document.getElementById('totalhasil').innerHTML="Rp. "+c; 
		 document.getElementById('labeljasa').innerHTML="( TIKI )";
		 form.totalhasilall.value=c;
		 document.getElementById('test1').innerHTML="Rp. "+a; //memberikan hasil penjumlahan ke input name total
		 cek();
	
 }
 function tambah2() {
		 //panggil function cek
		 a=eval(form.jne.value);
		 d=eval(form.jnehasil.value); //mengisi variabel a dengan isi dari input name angka1
		 c=a+d //menjumlahkan kedua variabel
		 document.getElementById('totalhasil').innerHTML="Rp. "+c; 
		 document.getElementById('labeljasa').innerHTML="( JNE )";
		 form.totalhasilall.value=c;
		 document.getElementById('test1').innerHTML="Rp. "+a; //memberikan hasil penjumlahan ke input name total
		 cek();;
	
 }
 function tambah3() {
		 //panggil function cek
		 a=eval(form.jt.value);
		 d=eval(form.jthasil.value); //mengisi variabel a dengan isi dari input name angka1
		 c=a+d //menjumlahkan kedua variabel
		 document.getElementById('totalhasil').innerHTML="Rp. "+c;
		 document.getElementById('labeljasa').innerHTML="( J&T Express )";
		 form.totalhasilall.value=c;
		 document.getElementById('test1').innerHTML="Rp. "+a; //memberikan hasil penjumlahan ke input name total
		 cek();
	
 }
 // var rupiah = document.getElementById('totalhasil');
	// 	rupiah.addEventListener('keyup', function(e){
	// 		// tambahkan 'Rp.' pada saat form di ketik
	// 		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
	// 		rupiah.value = formatRupiah(this.value, 'Rp. ');
	// 	});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
 </script>
</body>
</html>