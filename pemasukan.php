<?php
include("connect.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Toko Sepatu</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">   
</head>
<body id="page-top">
<div class="container">
  <!--Nav bar untuk menu-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top" id="mainNav">
  <div class="container-fluid">
    <a class="navbar-brand" href="page-top">Jesika Colection</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" aria-current="page" href="merk.php">Merk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="perhiasan.php">Perhiasan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="detail.php">Detail Bayar</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link active js-scroll-trigger" href="pemasukan.php">Laporan Keuangan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!--Akhir Nav bar untuk menu-->
<br><br><br>  
<h3 class="text-center">Pemasukan Harian</h3>

<!--Awal Card Table-->
<div class="card mt-3">
  <div class="card-header bg-success text-white">
    Data Pemasukan
  </div>
  <div class="card-body">
    <table class ="table table-bordered table-striped">
      <tr>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Total Pembayaran</th>
      </tr>
      <?php
        $no = 1;
        $tampil = mysqli_query($koneksi, "SELECT * FROM pemasukan_harian");
        while($data = mysqli_fetch_array($tampil)) :
      ?>
      <tr>
        <td><?=$no++;?></td>
        <td><?=$data['tanggal'];?></td>
        <td><?=$data['SUM(total_pembelian)'];?></td>
      </tr>

      <?php endwhile; //penutup perulangan while ?>

    </table>

  </div>
</div>
<!--Akhir Card Table-->

</div>

<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>