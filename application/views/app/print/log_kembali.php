<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Buku Kembali</title>
  </head>
  <body>
  <div class="container my-5 py-5">

    <img src="<?= base_url('assets/image/') ?>/Kayuh_Baimbai.png" width="20%" height="20%" align="left"/>
      <p align="center">
        <b>
          <font size="4">PERPUSTAKAAN KEJAKSAAN TINGGI KALIMANTAN SELATAN</font>
        </b>
        <br>
        <font size="2">Jln. D.I. Pandjaitan No 26, Antasan Besar, Kec. Banjarmasin Tengah</font><br>
        <font size="2">Kota Banjarmasin, Kalimantan Selatan 70123</font> 
        <br>
        <br>
        <br>
        <hr size="2px" color="black">
      </p>

      <div class="row">
        <div class="col-12">
          <table style="border: 0; width: 100%">
            <tr>
              <td>Cetak : (<?= $this->session->userdata("SESS_SIPERPUS_USERNAME") ?>) ((<?= $this->session->userdata("SESS_SIPERPUS_NAME") ?>))</td>
              <td align="right">Tanggal Cetak : <?= date("d M Y", time()) ?></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>
                Filter : 
                <?php if($filter['filter_awal'] != null && $filter['filter_akhir'] != null): ?>
                  <?= date('d M Y', strtotime($filter['filter_awal'])) . " - " . date('d M Y', strtotime($filter['filter_akhir'])) ?> / Rentang Tanggal / Log Buku Kembali
                <?php endif; ?>
              </td>
              <td></td>
            </tr>
          </table>
        </div>
      </div>

      <h3 class="text-center mb-2">LAPORAN BUKU KEMBALI</h3>
      <table class="table table-bordered">
        <thead>
          <th>#</th>
          <th>Kode Buku</th>
          <th>ISBN</th>
          <th>Judul Buku</th>
          <th>Peminjam</th>
          <th>Terlambat</th>
          <th>Tanggal Kembali</th>
        </thead>
        <tbody>
          <?php $nomor = 1; ?>
          <?php foreach($all_laporan as $laporan): ?>
            <tr>
              <td><?= $nomor++ ?></td>
              <td><?= $laporan['kode_buku'] ?></td>
              <td><?= $laporan['ISBN'] ?></td>
              <td><?= $laporan['judul'] ?></td>
              <td><?= $laporan['nama_lengkap'] ?></td>
              <td>
                <?php if($laporan['terlambat']): ?>
                  Ya
                <?php else: ?>
                  Tidak
                <?php endif; ?>
              </td>
              <td><?= $laporan['created_at'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      
      <br>
      <div style="text-align: center; display: inline-block; float: right;">
        <h6>
          Mengetahui
          <br>
            Banjarmasin, <?php echo (date('d M Y')); ?>
          <br>
          <br>
          <br>
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://primbon.com/hantu.php" alt="TTD QR">
          <br>
          <br>
          <br><u>Ir. M. MAKHMUD, MS</u>
          <br>NIP. 19650328 198803 1 009
        </h6> 
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <script>
      window.addEventListener("load", () => {
        window.print();
      });
    </script>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>