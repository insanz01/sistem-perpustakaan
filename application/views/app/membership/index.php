<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Membership</h1>
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
              <a href="<?= base_url('membership/add') ?>" class="btn btn-primary float-right mb-2">TAMBAH MEMBER</a>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <table class="table custom-table">
                    <thead>
                      <th>#</th>
                      <th>Kode Member</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Email</th>
                      <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $index = 1 ?>
                      <?php foreach ($memberships as $membership) : ?>
                        <tr>
                          <td><?= $index++ ?></td>
                          <td><?= $membership['kode_member'] ?></td>
                          <td><?= $membership['nama_lengkap'] ?></td>
                          <td><?= $membership['alamat'] ?></td>
                          <td><?= $membership['email'] ?></td>
                          <td>
                            <a href="<?= base_url('print/member/') . $membership['id'] ?>" class="badge badge-sm badge-primary badge-pill">riwayat</a>
                            <a href="<?= base_url('membership/edit/') . $membership['id'] ?>" class="badge badge-sm badge-info badge-pill">edit</a>
                            <a href="#!" data-toggle="modal" data-target="#hapusModal" class="badge badge-sm badge-danger badge-pill" onclick="hapusData(this)" data-id="<?= $membership['id'] ?>">hapus</a>
                          </td>
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

<!-- Modal -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapusModalLabel">Hapus Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('membership/delete') ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" id="delete-id">
          <p>Apakah anda yakin ingin menghapus data member ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  const hapusData = (target) => {
    const id = target.getAttribute('data-id');

    console.log(id);

    document.getElementById('delete-id').value = id;
  }
</script>