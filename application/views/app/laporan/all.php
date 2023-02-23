<style>
  .hidden {
    display: none;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Buku</h1>
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
            <div class="col-9 mx-auto">
              <div class="card">
                <div class="card-body">
                  <form action="<?= base_url("print/cetak") ?>" method="post">
                    <div class="form-group">
                      <label for="jenis_laporan">Jenis Laporan</label>
                      <select name="jenis_laporan" id="jenis_laporan" class="form-control">
                        <option value="">- PILIH LAPORAN -</option>
                        <option value="BUKU_POPULER">Buku Populer</option>
                        <option value="BUKU_TAMU">Buku Tamu</option>
                        <option value="BUKU_TAMU_MEMBER">Buku Tamu Member</option>
                        <option value="LOG_PINJAM">Log Peminjaman Buku</option>
                        <option value="LOG_KEMBALI">Log Pengembalian Buku</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="filter">Filter</label>
                      <select name="filter" id="filter" class="form-control" onchange="pilihFilter(this)">
                        <option value="SEMUA">Semua Laporan</option>
                        <option value="TANGGAL">Berdasarkan Tanggal</option>
                      </select>
                    </div>

                    <div id="filter-tanggal" class="hidden">
                      <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                      </div>
      
                      <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir">
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block btn-lg">CETAK DENGAN FILTER</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  const pilihFilter = (target) => {
    const jenisFilter = target.value;
    const filterTanggal = document.getElementById("filter-tanggal");
    
    if(jenisFilter == "TANGGAL") {

      filterTanggal.classList.remove("hidden");
    } else {
      filterTanggal.classList.add("hidden");
    }
  }
</script>