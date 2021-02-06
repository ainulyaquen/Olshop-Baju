<?php
  include 'app/database.php';

if (empty($_SESSION['id_pengguna'])) {
        echo "<script>alert('Login Dulu')</script>";
        echo "<script>window.location='admin.php';</script>";
}

if (isset($_GET['aksi'])) {
  if ($_GET['aksi']=='logout') {

      session_destroy();
      echo "<script>alert('Anda Telah Logout')</script>";
      echo "<script>window.location='admin.php';</script>";

  }
}

function rupiah($angka){
    $hasil_rupiah= number_format($angka,0,'.','.');
    return $hasil_rupiah;

}
 ?>



<!DOCTYPE html>
<html>
<?php include 'template/head.php'?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
<?php include 'template/header.php'?>
      <?php include 'template/sidebaradmin.php'?>
	
      
<!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
	<!-- Content Header (Page header) -->
              <?php 
              if (isset($_GET['halaman'])) {

                    if ($_GET['halaman']=='kategori') 
                    {
                      include 'app/kategori.php';
                    }
                    else if ($_GET['halaman']=='pegawai') 
                    {
                      include 'app/pegawai.php';
                    }
                    else if ($_GET['halaman']=='pelanggan') 
                    {
                      include 'app/pelanggan.php';
                    }
                    else if ($_GET['halaman']=='supplier') 
                    {
                      include 'app/supplier.php';
                    }
                    else if ($_GET['halaman']=='barang') 
                    {
                      include 'app/barang.php';
                    }
                    else if ($_GET['halaman']=='penjualan') 
                    {
                      include 'app/penjualan.php';
                    }
                    else if ($_GET['halaman']=='pembelian') 
                    {
                      include 'app/pembelian.php';
                    }
                    else if ($_GET['halaman']=='pemesanan') 
                    {
                      include 'app/pemesanan.php';
                    }
                    else if ($_GET['halaman']=='tambahpembelian') 
                    {
                      include 'app/tambahpembelian.php';
                    }

              }else{
                include 'app/home.php';
              }

              ?>
        
     </div><!-- /.content-wrapper -->
	 
      <?php include 'template/footer.php'?>

      
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="admin/plugins/chartjs/Chart.min.js"></script>

    <script src="admin/plugins/select2/select2.full.min.js"></script>
    <script src="admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="admin/dist/js/demo.js"></script>
    
    <script>
      $(function () {
        $(".select2").select2();
        $("#example1").DataTable();
        $("#example3").DataTable();
        $("#example4").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
        <?php 
              $no=0;
              $warna=['#f56954','#00a65a','#f39c12','#00c0ef','#3c8dbc'];
              $query=mysqli_query($db,"SELECT b.nama_barang,SUM(a.jumlah) AS jum FROM tb_detailpenjualan a JOIN tb_barang b ON a.id_barang=b.id_barang GROUP BY a.id_barang ORDER BY jum DESC LIMIT 5");
              $hitung= mysqli_num_rows($query);
              if($hitung>0){
              while ($pecah= mysqli_fetch_assoc($query)) {                 
          ?>
          {
            value: <?php echo $pecah['jum']; ?>,
            color: "<?php echo $warna[$no];?>",
            highlight: "<?php echo $warna[$no];?>",
            label: "<?php echo $pecah['nama_barang']; ?>"
          },
          <?php $no++; }} ?>
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

      });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'modalpenjualan.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
  
  </body>
</html>
