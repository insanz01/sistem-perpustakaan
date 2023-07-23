<?php
  include "./database/db.php";

  $query = "SELECT harga_produsen.id, harga_produsen.harga, komoditas.id as id_komoditas, komoditas.nama as komoditas, satuan.nama as satuan, harga_produsen.approved_at, harga_produsen.created_at, harga_produsen.updated_at FROM harga_produsen JOIN komoditas ON harga_produsen.id_komoditas = komoditas.id JOIN satuan ON komoditas.id_satuan = satuan.id WHERE harga_produsen.deleted_at is NULL AND harga_produsen.approved_at is not NULL";

  $result = mysqli_query($connection, $query);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Laporan Harga Grosir</title>
  </head>
  <body>

  <img src="<?= base_url('assets/image/') ?>/Kayuh_Baimbai.png" width="20%" height="20%" align="left"/>
        <p align="center"><b>

        <font size="4">PERPUSTAKAAN KEJAKSAAN TINGGI KALIMANTAN SELATAN</font> <br>
        <!-- <font size="4">DINAS KETAHANAN PANGAN, PERTANIAN DAN PERIKANAN</font> </b><br> -->
        <font size="2">Jln. D.I. Pandjaitan No 26, Antasan Besar, Kec. Banjarmasin Tengah</font><br>
        <font size="2">Kota Banjarmasin, Kalimantan Selatan 70123</font> 
        <br><br>
        <hr size="2px" color="black">
        </p>
	<center>
		<h4>LAPORAN PENGEMBALIAN BUKU</h4>
	</center>

  <table border="1" style="width: 100%">
  <thead>
              <th>No</th>
              <th>Nama Komoditas</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Tanggal</th>
            </thead>
    <tbody>
              <?php if(mysqli_num_rows($result) > 0): ?>
                <?php $number = 1; ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                  <tr>
                    <td><?= $number++ ?></td>
                    <td><?= $row['komoditas'] ?></td>
                    <td><?= $row['satuan'] ?></td>
                    <td><?= $row['harga'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                  </tr>
                <?php endwhile; ?>
              <?php endif; ?>
            </tbody>
	</table>
  <br>
	<div style="text-align: center; display: inline-block; float: right;">
    <h5>
            Banjarmasin, <?php echo (date('d M Y')); ?>
			<br>KEPALA DINAS<br>
			<br>
            <br>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://primbon.com/hantu.php" alt="TTD QR">
            <br>
            <br>
            <br><u>Ir. M. MAKHMUD, MS</u>
            <br>Pembina Utama Muda
            <br>NIP. 19650328 198803 1 009
    </h5> 
  </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

    <script>
      window.print()
    </script>
  </body>
</html>