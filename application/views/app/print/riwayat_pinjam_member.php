<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <title>Laporan Riwayat Member</title>
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
              <td align="right">Kode Member : <?= $member['kode_member'] ?></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>
                <?php if($filter['filter_awal'] != null && $filter['filter_akhir'] != null): ?>
                  Filter : 
                  <?= date('d M Y', strtotime($filter['filter_awal'])) . " - " . date('d M Y', strtotime($filter['filter_akhir'])) ?> / Rentang Tanggal / Riwayat Peminjaman
                <?php endif; ?>
              </td>
              <td align="right">Tanggal Cetak : <?= date("d M Y", time()) ?></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td align="left">Nama Member : <?= $member['nama_lengkap'] ?></td>
              <td></td>
            </tr>
          </table>
        </div>
      </div>

      <h3 class="text-center mb-2">LAPORAN RIWAYAT PEMINJAMAN</h3>
      <table class="table table-bordered">
        <thead>
          <th>#</th>
          <th>Tanggal</th>
          <th>Judul Buku</th>
          <th>Penerbit</th>
          <th>Penulis</th>
          <th>Status Peminjaman</th>
          <th>Terlambat</th>
        </thead>
        <tbody>
          <?php $nomor = 1; ?>
          <?php foreach($all_laporan as $laporan): ?>
            <tr>
              <td><?= $nomor++ ?></td>
              <td><?= $laporan['created_at'] ?></td>
              <td><?= $laporan['judul'] ?></td>
              <td><?= $laporan['penerbit'] ?></td>
              <td><?= $laporan['penulis'] ?></td>
              <td><?= $laporan['status'] ?></td>
              <td>
                <?php if($laporan['terlambat']): ?>
                  Terlambat
                <?php else: ?>
                  Tidak Terlambat
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="row">
        <div class="col-12">
          <canvas id="line-chart"></canvas>
        </div>
      </div>
      
      <br>
      <div style="text-align: center; display: inline-block; float: right;">
        <h6>
          Mengetahui
          <br>
            Banjarmasin, <?php echo (date('d M Y')); ?>
          <br>
          <br>
          <br>
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://google.com/" alt="TTD QR">
          <br>
          <br>
          <br><u>Ir. M. MAKHMUD, MS</u>
          <br>NIP. 19650328 198803 1 009
        </h6> 
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const lineChart = () => {
        const labels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nop", "Des"];
        const data = {
          labels: labels,
          datasets: [{
            label: 'Riwayat Peminjaman',
            data: [65, 59, 80, 81, 56, 55, 40, 41, 54, 12, 30, 45],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        };

        const config = {
          type: 'line',
          data: data,
        };

        console.log(config);

        const ctx = document.getElementById('line-chart');

        new Chart(ctx, config)
      }

      window.addEventListener("load", () => {
        lineChart();

        setTimeout(() => {
          window.print();
        }, 3000);
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