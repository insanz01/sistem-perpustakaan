<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Buku Tamu</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <!-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active"></li>
          </ol> -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="row">
          <div class="col-12">
              <a href="<?= base_url('buku_tamu') ?>" class="btn btn-outline-primary float-right mb-2">LIHAT BUKU TAMU</a>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <table class="table custom-table">
                    <thead>
                      <th>#</th>
                      <th>Kode Member</th>
                      <th>Nama Lengkap</th>
                      <th>Tanggal CheckIn</th>
                    </thead>
                    <tbody>
                      <?php $nomor = 1 ?>
                      <?php foreach ($tamu as $tm) : ?>
                        <tr>
                          <td><?= $nomor++ ?></td>
                          <td><?= $tm['kode_member'] ?></td>
                          <td><?= $tm['nama_lengkap'] ?></td>
                          <td><?= $tm['created_at'] ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>