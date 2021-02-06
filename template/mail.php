<?php 

include('../admin/PHPMailer/class.phpmailer.php');
include('../admin/PHPMailer/class.smtp.php');
include('../app/database.php');
$mail=new PHPMailer();
// Konfigurasi SMTP
$mail->isSMTP();
$mail->Host = "ssl://smtp.gmail.com";
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;


$mail->Username = "metrosportmagelang@gmail.com";
$mail->Password = "metrosport123";


	$emailpmb="".$_SESSION['emailmember']."";
	$userpmb="".$_SESSION['usermember']."";
	$passpmb="".$_SESSION['passmember']."";


$emailku="metrosportmagelang@gmail.com";


$mail->setFrom("$emailku");
$mail->addReplyTo("$emailku");


// Menambahkan penerima
$mail->addAddress("$emailpmb");
// Menambahkan cc atau bcc 
//$mail->addCC('cc@contoh.com');
//$mail->addBCC('bcc@contoh.com');
// Subjek email
$mail->Subject = "Pendaftaran Member Metro Sport";
// Mengatur format email ke HTML
$mail->isHTML(true);
// Konten/isi email
$mailContent = "<h1>Pendaftaran Member Metro Sport</h1><br><br>
    <p>Berikut ini adalah username dan password yang akan anda gunakan </p><br>
    <p>Username : $userpmb </p><br>
    <p>Password : $passpmb </p><br>
    <p>Silahkan klik untuk mengaktifasi akun http://localhost/ecommerce/index.php?kirim=email&user=$userpmb&akt=aktif </p>";
$mail->Body = $mailContent;
// Kirim email
if(!$mail->send()){
    echo "<script>alert('Gagal Mendaftar, Silahkan Cek Email Anda dengan benar!!!')</script>";
    echo "<script>window.location='../index.php';</script>";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    echo "<script>alert('Berhasil Mendaftar, Silahkan Cek Email Anda untuk Aktifasi akun!!!')</script>";
    echo "<script>window.location='../index.php';</script>";
}


 ?>