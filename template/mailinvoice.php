<?php 

include('../admin/PHPMailer/class.phpmailer.php');
include('../admin/PHPMailer/class.smtp.php');
include('../app/database.php');

ob_start();
    include(dirname(__FILE__).'/invoice.php');
    $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/../admin/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output("../invoice/".$idpen.".pdf","F");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

$query2=mysqli_query($db,"select * from tb_pelanggan where id_pelanggan='$idpel'");
$hitung2= mysqli_num_rows($query2);
if($hitung2>0){
while ($pecah2= mysqli_fetch_assoc($query2)) {    
   $emailpelanggan=$pecah2['email']; 
}}

$conidpen=$idpen.".pdf";


$mail=new PHPMailer();
// Konfigurasi SMTP
$mail->isSMTP();
$mail->Host = "ssl://smtp.gmail.com";
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;


$mail->Username = "metrosportmagelang@gmail.com";
$mail->Password = "metrosport123";




$emailku="metrosportmagelang@gmail.com";


$mail->setFrom("$emailku");
$mail->addReplyTo("$emailku");


// Menambahkan penerima
$mail->addAddress("$emailpelanggan");
// Menambahkan cc atau bcc 
//$mail->addCC('cc@contoh.com');
//$mail->addBCC('bcc@contoh.com');
// Subjek email
$mail->Subject = "Invoice Penjualan Metro Sport";
// Mengatur format email ke HTML
$mail->isHTML(true);
// Konten/isi email
$mailContent = "Berikut Ini Invoice Penjualan Metro Sport";
$mail->Body = $mailContent;
$mail->addAttachment("../invoice/".$idpen.".pdf");
// Kirim email
if(!$mail->send()){
    echo "<script>alert('Gagal Mendaftar, Silahkan Cek Email Anda dengan benar!!!')</script>";
    echo "<script>window.location='../homeadmin.php?halaman=penjualan';</script>";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    mysqli_query($db,"update tb_penjualan set keterangan='Mengirim Barang',invoice='$conidpen' where id_penjualan='$idpen'");
    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='../homeadmin.php?halaman=penjualan';</script>";
}


 ?>