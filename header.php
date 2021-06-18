<?php

include("connect.php");
    
  //jika tombol simpan diklik
   if(isset($_POST['bsimpan']))
   {
     //pengujian apakah data disimpan baru atau di edit
     if($_GET['hal']=="edit")
     {
       //data akan diedit
       $edit = mysqli_query($koneksi, "UPDATE header_bayar set no_nota='$_POST[tno_nota]', tanggal='$_POST[ttanggal]', id_detail='$_POST[tid_detail]', 
       total_pembelian='$_POST[ttotal_pembelian]', bayar='$_POST[tbayar]', sisa_bayar='$_POST[tsisa_bayar]', cara_pembayaran='$_POST[tcara_pembayaran]'
       WHERE no_nota='$_GET[id]'");
 
       if($edit)
       {
         echo "<script>
         alert('Edit Data Sukses!');
         document.location='header.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Edit Data Gagal!');
         document.location='header.php';
         </script>";
       }
 
     }
     else
     {
       //data akan disimpan baru    
       $simpan = mysqli_query($koneksi, "INSERT INTO header_bayar (no_nota, tanggal, id_detail, total_pembelian, bayar, sisa_bayar, cara_pembayaran)
       VALUES ('$_POST[tno_nota]','$_POST[ttanggal]','$_POST[tid_detail]', '$_POST[ttotal_pembelian]', 
       '$_POST[tbayar]','$_POST[tsisa_bayar]','$_POST[tcara_pembayaran]')");
 
       if($simpan)
       {
         echo "<script>
         alert('Simpan Data Sukses!');
         document.location='header.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Simpan Data Gagal!');
         document.location='header.php';
         </script>";
       }
     }
   }
   //jika tombol edit/hapus diklik
   if(isset($_GET['hal']))
   {
     //jika data diedit
     if($_GET['hal']=="edit")
     {
       //tampilkan data yang akan diedit
       $tampil = mysqli_query($koneksi, "SELECT * FROM header_bayar WHERE no_nota = '$_GET[id]'");
       $data = mysqli_fetch_array($tampil);
       if($data)
       {
         //jika data ditemukan, maka data ditampung ke dalam variabel
         $vno_nota= $data['no_nota'];
         $vtanggal= $data['tanggal'];
         $vid_detail= $data['id_detail'];
         $vtotal_pembelian= $data['total_pembelian'];
         $vbayar= $data['bayar'];
         $vsisa_bayar= $data['sisa_bayar'];
         $vcara_pembayaran= $data['cara_pembayaran'];
       }
     }
     else if($_GET['hal']=="hapus")
     {
       //persipahan hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM header_bayar WHERE no_nota='$_GET[id]' ");
       if($hapus)
       {
         echo "<script>
         alert('Hapus Data Sukses!');
         document.location='header.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Hapus Data Gagal!');
         document.location='header.php';
         </script>";
       }
     }
   }
 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Toko Perhiasan</title>
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
          <a class="nav-link active js-scroll-trigger" href="header.php">Header Bayar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="pemasukan.php">Laporan Keuangan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!--Akhir Nav bar untuk menu-->
<br><br><br>  <h3 class="text-center">Data Header Bayar</h3>

<!--Awal Card Form-->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    Form Input Data Header Bayar
  </div>
  <div class="card-body">
    <form method = "post" action="">
    <div class="form-group">
        <label>No Nota</label>
        <input type="text" name="tno_nota" value="<?=@$vno_nota?>" class="form-control" placeholder="Input No Nota di sini!" required>
    </div>
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="ttanggal" value="<?=@$vtanggal?>" class="form-control" placeholder="Input Tanggal di sini!" required>
    </div> 
    <div class="form-group">   
        <label>ID Detail</label>
        <input type="text" name="tid_detail" value="<?=@$vid_detail?>" class="form-control" placeholder="Input ID Detail di sini!" required>
    </div>
    <div class="form-group">   
        <label>Total Pembelian</label>
        <input type="text" name="ttotal_pembelian" value="<?=@$vtotal_pembelian?>" class="form-control" placeholder="Input Total Pembelian di sini!" required>
    </div>
    <div class="form-group">   
        <label>Harga yang Dibayar</label>
        <input type="text" name="tbayar" value="<?=@$vbayar?>" class="form-control" placeholder="Input Uang yang di Bayar di sini!" required>
    </div>
    <div class="form-group">   
        <label>Sisa Bayar</label>
        <input type="text" name="tsisa_bayar" value="<?=@$vsisa_bayar?>" class="form-control" placeholder="Input Sisa Pembayaran di sini!" required>
    </div>
    <div class="form-group">   
        <label>Cara Pembayaran</label>
        <input type="text" name="tcara_pembayaran" value="<?=@$vcara_pembayaran?>" class="form-control" placeholder="Input Cara Pembayaran di sini!" required>
    </div>
    <br>
    <button type ="submit" class="btn btn-success" name="bsimpan">Simpan</button>
    <button type ="reset" class="btn btn-danger" name="breset">Kosongkan</button>

    </form>
  </div>
</div>
<!--Akhir Card Form-->

<!--Awal Card Table-->
<div class="card mt-3">
  <div class="card-header bg-success text-white">
    Data Header Pembayaran
  </div>
  <div class="card-body">
    <table class ="table table-bordered table-striped">
      <tr>
        <th>No.</th>
        <th>No Nota</th>
        <th>Tanggal</th>
        <th>ID Detail</th>
        <th>Total Pembayaran</th>
        <th>Uang yang diBayar</th>
        <th>Sisa Bayar</th>
        <th>Cara Pembayaran</th>
        <th>Aksi</th>
      </tr>
      <?php
        $no = 1;
        $tampil = mysqli_query($koneksi, "SELECT * FROM header_bayar order by no_nota");
        while($data = mysqli_fetch_array($tampil)) :
      ?>
      <tr>
        <td><?=$no++;?></td>
        <td><?=$data['no_nota'];?></td>
        <td><?=$data['tanggal'];?></td>
        <td><?=$data['id_detail'];?></td>
        <td><?=$data['total_pembelian'];?></td>
        <td><?=$data['bayar'];?></td>
        <td><?=$data['sisa_bayar'];?></td>
        <td><?=$data['cara_pembayaran'];?></td>
        <td>
          <a href="header.php?hal=edit&id=<?=$data['no_nota']?>" class ="btn btn-warning">Edit</a>
          <a href="header.php?hal=hapus&id=<?=$data['no_nota']?>" onclick="return confirm('Apakah yakin ingin menghapus data?')" 
          class ="btn btn-danger">Hapus</a>
        </td>
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