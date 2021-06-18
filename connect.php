<?php

//Buat Koneksi Database
  $server="localhost";
  $user="root";
  $password="";
  $database="toko_perhiasan";
  
  $koneksi= mysqli_connect($server, $user, $password, $database)or die(mysqli_error($koneksi));
  ?>