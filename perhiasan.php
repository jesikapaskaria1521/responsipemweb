<?php

include("connect.php");
 
  //jika tombol simpan diklik
   if(isset($_POST['bsimpan']))
   {
     //pengujian apakah data disimpan baru atau di edit
     if($_GET['hal']=="edit")
     {
       //data akan diedit
       $edit = mysqli_query($koneksi, "UPDATE perhiasan set id_perhiasan='$_POST[tid_perhiasan]', id_merk='$_POST[tid_merk]', 
       harga='$_POST[tharga]', stok='$_POST[tstok]'
       WHERE id_perhiasan='$_GET[id]'");
 
       if($edit)
       {
         echo "<script>
         alert('Edit Data Sukses!');
         document.location='perhiasan.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Edit Data Gagal!');
         document.location='perhiasan.php';
         </script>";
       }
 
     }
     else
     {
       //data akan disimpan baru    
       $simpan = mysqli_query($koneksi, "INSERT INTO perhiasan (id_perhiasan, id_merk, harga, stok)
       VALUES ('$_POST[tid_perhiasan]', '$_POST[tid_merk]','$_POST[tharga]','$_POST[tstok]')");
 
       if($simpan)
       {
         echo "<script>
         alert('Simpan Data Sukses!');
         document.location='perhiasan.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Simpan Data Gagal!');
         document.location='perhiasan.php';
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
       $tampil = mysqli_query($koneksi, "SELECT * FROM perhiasan WHERE id_perhiasan = '$_GET[id]'");
       $data = mysqli_fetch_array($tampil);
       if($data)
       {
         //jika data ditemukan, maka data ditampung ke dalam variabel
         $vid_perhiasan= $data['id_perhiasan'];
         $vid_merk= $data['id_merk'];
         $vharga= $data['harga'];
         $vstok= $data['stok'];
       }
     }
     else if($_GET['hal']=="hapus")
     {
       //persipahan hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM perhiasan WHERE id_perhiasan='$_GET[id]' ");
       if($hapus)
       {
         echo "<script>
         alert('Hapus Data Sukses!');
         document.location='perhiasan.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Hapus Data Gagal!');
         document.location='merk.php';
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
        <li class="nav-item active">
          <a class="nav-link active js-scroll-trigger" href="perhiasan.php">Perhiasan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="detail.php">Detail Bayar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="header.php">Header Bayar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="pemasukan.php">Laporan Keuangan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!--Akhir Nav bar untuk menu-->
<br><br><br>
  <h3 class="text-center">Data Perhiasan</h3>

<!--Awal Card Form-->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    Form Input Data Perhiasan
  </div>
  <div class="card-body">
    <form method = "post" action="">
    <div class="form-group">
        <label>ID Perhiasan</label>
        <input type="text" name="tid_perhiasan" value="<?=@$vid_perhiasan?>" class="form-control" placeholder="Input ID perhiasan di sini!" required>
    </div>
    <div class="form-group">
        <label>ID Merk</label>
        <input type="text" name="tid_merk" value="<?=@$vid_merk?>" class="form-control" placeholder="Input ID Merk di sini!" required>
    </div>
    <div class="form-group">   
        <label>Harga</label>
        <input type="text" name="tharga" value="<?=@$vharga?>" class="form-control" placeholder="Input Harga perhiasan di sini!" required>
    </div>
    <div class="form-group">   
        <label>Jumlah Stok</label>
        <input type="text" name="tstok" value="<?=@$vstok?>" class="form-control" placeholder="Input Jumlah Stok perhiasan di sini!" required>
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
    Data Perhiasan
  </div>
  <div class="card-body">
    <table class ="table table-bordered table-striped">
      <tr>
        <th>No.</th>
        <th>ID perhiasan</th>
        <th>ID Merk</th>
        <th>Harga</th>
        <th>Jumlah Stok</th>
        <th>Aksi</th>
      </tr>
      <?php
        $no = 1;
        $tampil = mysqli_query($koneksi, "SELECT * FROM perhiasan order by id_perhiasan desc");
        while($data = mysqli_fetch_array($tampil)) :
      ?>
      <tr>
        <td><?=$no++;?></td>
        <td><?=$data['id_perhiasan'];?></td>
        <td><?=$data['id_merk'];?></td>
        <td><?=$data['harga'];?></td>
        <td><?=$data['stok'];?></td>
        <td>
          <a href="perhiasan.php?hal=edit&id=<?=$data['id_perhiasan']?>" class ="btn btn-warning">Edit</a>
          <a href="perhiasan.php?hal=hapus&id=<?=$data['id_perhiasan']?>" onclick="return confirm('Apakah yakin ingin menghapus data?')" 
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