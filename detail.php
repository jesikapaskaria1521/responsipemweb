<?php
include("connect.php");
  
  //jika tombol simpan diklik
   if(isset($_POST['bsimpan']))
   {
     //pengujian apakah data disimpan baru atau di edit
     if($_GET['hal']=="edit")
     {
       //data akan diedit
       $edit = mysqli_query($koneksi, "UPDATE detail_bayar set id_detail='$_POST[tid_detail]', id_perhiasan='$_POST[tid_perhiasan]', 
       jumlah_beli='$_POST[tjumlah_beli]'
       WHERE id_detail='$_GET[id]'");
 
       if($edit)
       {
         echo "<script>
         alert('Edit Data Sukses!');
         document.location='detail.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Edit Data Gagal!');
         document.location='detail.php';
         </script>";
       }
 
     }
     else
     {
       //data akan disimpan baru    
       $simpan = mysqli_query($koneksi, "INSERT INTO detail_bayar (id_detail, id_perhiasan, jumlah_beli)
       VALUES ('$_POST[tid_detail]', '$_POST[tid_perhiasan]','$_POST[tjumlah_beli]')");
 
       if($simpan)
       {
         echo "<script>
         alert('Simpan Data Sukses!');
         document.location='detail.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Simpan Data Gagal!');
         document.location='detail.php';
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
       $tampil = mysqli_query($koneksi, "SELECT * FROM detail_bayar WHERE id_detail = '$_GET[id]'");
       $data = mysqli_fetch_array($tampil);
       if($data)
       {
         //jika data ditemukan, maka data ditampung ke dalam variabel
         $vid_detail= $data['id_detail'];
         $vid_perhiasan= $data['id_perhiasan'];
         $vukuran= $data['jumlah_beli'];
       }
     }
     else if($_GET['hal']=="hapus")
     {
       //persipahan hapus data
       $hapus = mysqli_query($koneksi, "DELETE FROM detail_bayar WHERE id_detail='$_GET[id]' ");
       if($hapus)
       {
         echo "<script>
         alert('Hapus Data Sukses!');
         document.location='detail.php';
         </script>";
       }
       else
       {
         echo "<script>
         alert('Hapus Data Gagal!');
         document.location='detail.php';
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
        <li class="nav-item active">
          <a class="nav-link active js-scroll-trigger" href="detail.php">Detail Bayar</a>
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
  <h3 class="text-center">Data Detail Pembayaran</h3>

<!--Awal Card Form-->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    Form Input Data Detail Bayar
  </div>
  <div class="card-body">
    <form method = "post" action="">
    <div class="form-group">
        <label>ID Detail</label>
        <input type="text" name="tid_detail" value="<?=@$vid_detail?>" class="form-control" placeholder="Input ID Detail di sini!" required>
    </div>
    <div class="form-group">
        <label>ID Perhiasan</label>
        <input type="text" name="tid_perhiasan" value="<?=@$vid_perhiasan?>" class="form-control" placeholder="Input ID Perhiasan di sini!" required>
    </div>
        <div class="form-group">   
        <label>Jumlah Beli Barang</label>
        <input type="text" name="tjumlah_beli" value="<?=@$vjumlah_beli?>" class="form-control" placeholder="Input Jumlah Beli Perhiasan di sini!" required>
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
    Data Detail Pembayaran
  </div>
  <div class="card-body">
    <table class ="table table-bordered table-striped">
      <tr>
        <th>No.</th>
        <th>ID Detail</th>
        <th>ID Perhiasan</th>
        <th>Jumlah Beli Barang</th>
        <th>Aksi</th>
      </tr>
      <?php
        $no = 1;
        $tampil = mysqli_query($koneksi, "SELECT * FROM detail_bayar order by id_detail");
        while($data = mysqli_fetch_array($tampil)) :
      ?>
      <tr>
        <td><?=$no++;?></td>
        <td><?=$data['id_detail'];?></td>
        <td><?=$data['id_perhiasan'];?></td>
        <td><?=$data['jumlah_beli'];?></td>
        <td>
          <a href="detail.php?hal=edit&id=<?=$data['id_detail']?>" class ="btn btn-warning">Edit</a>
          <a href="detail.php?hal=hapus&id=<?=$data['id_detail']?>" onclick="return confirm('Apakah yakin ingin menghapus data?')" 
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