<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Buku</h1>
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
          <div class="card">
            <div class="card-body">
              <form action="<?= base_url('buku/do_edit') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $buku['id'] ?>">
                <div class="form-group">
                  <label for="isbn">ISBN</label>
                  <input type="text" name="ISBN" class="form-control" id="isbn" value="<?= $buku['ISBN'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="judul">Judul Buku</label>
                  <input type="text" name="judul" class="form-control" id="judul" value="<?= $buku['judul'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="deskripsi">Deskripsi Buku</label>
                  <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10"><?= $buku['deskripsi'] ?></textarea>
                </div>
                <div class="form-group">
                  <label for="penulis">Penulis Buku</label>
                  <input type="text" name="penulis" class="form-control" id="penulis" value="<?= $buku['penulis'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="penerbit">Penerbit Buku</label>
                  <input type="text" name="penerbit" class="form-control" id="penerbit" value="<?= $buku['penerbit'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="gambar">Gambar Buku 
                    <small>(tidak perlu upload file jika tidak ingin merubah)</small>
                  </label>
                  <br>
                  <img src="<?= base_url('uploads/') . $buku['gambar'] ?>" style="width: 150px" alt="Tidak ada gambar" class="pb-2">
                  <input type="file" name="gambar" class="form-control" id="gambar">
                </div>

                <div class="form-group">
                  <label for="lemari">Nomor Lemari</label>
                  <input type="text" name="lemari" class="form-control" id="lemari" value="<?= $buku["lemari"] ?>">
                </div>

                <div class="form-group">
                  <label for="rak">Nomor Rak</label>
                  <input type="text" name="rak" class="form-control" id="rak" value="<?= $buku["rak"] ?>">
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block btn-lg">SIMPAN DATA BUKU</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  // const getNameOfMember = () => {

  // }
</script>