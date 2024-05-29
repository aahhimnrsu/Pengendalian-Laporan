<!-- Main Content -->
<?php $page = 'Dashboard' ?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Detail Laporan</h4>
            <?php foreach($datapeminjaman as $peminjaman){ ?>
              <div class="card-action">
                <a href="<?= base_url('laporan/cetaklaporan/'. $peminjaman->id)?>" class="btn btn-success"><i class="fas fa-print"></i> Cetak Laporan Kerusakan</a>
            </div>
            <?php } ?>
          </div>
          <div class="card-body p-3">
            <div class="row">
              <div class="col-md-6">
                <?php foreach($datapeminjam as $peminjam){ ?>
                <h5>Data Peminjam</h5>
                <div class="form-group">
                  <label for="nama_peminjam">ID Peminjam</label>
                  <input type="text" name="nama" id="nama" value="<?= $peminjam->id ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Nama Peminjam</label>
                  <input type="text" name="nama" id="nama" value="<?= $peminjam->nama ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Universitas/Bagian</label>
                  <input type="text" name="nama" id="nama" value="<?= $peminjam->universitas ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Alamat</label>
                  <textarea name="" id="" class="form-control" readonly><?= $peminjam->alamat ?></textarea>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Foto Peminjam</label><br>
                  <img src="<?= base_url('assets/uploads/fotopeminjam/'.$peminjam->foto) ?>" width="150px">
                </div>
                <?php } ?>
              </div>
              <div class="col-md-6">
              <?php foreach($datapeminjaman as $peminjaman){ ?>
                <h5>Data Peminjaman</h5>
                <div class="form-group">
                  <label for="nama_peminjam">Nama Barang</label>
                  <input type="text" name="nama" id="nama" value="<?= $peminjaman->nama_barang ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Jumlah</label>
                  <input type="text" name="nama" id="nama" value="<?= $peminjaman->jumlah ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Tanggal Peminjaman</label>
                  <input type="text" name="nama" id="nama" value="<?= $peminjaman->tanggal_peminjaman ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Tanggal Pengembalian</label>
                  <input type="text" name="nama" id="nama" value="<?= $peminjaman->tanggal_pengembalian ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Kondisi</label>
                  <input type="text" name="nama" id="nama" value="<?= $peminjaman->kondisi ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Keterangan</label>
                  <textarea name="" id="" class="form-control" readonly><?= $peminjaman->keterangan ?></textarea>
                </div>
                <div class="form-group">
                  <label for="nama_peminjam">Foto ID Card</label><br>
                  <img src="<?= base_url('assets/uploads/idcard/'. $peminjaman->foto) ?>" width="150px">
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<!-- JS Libraies -->
<script src="<?= base_url('assets/bundles/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/export-tables/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/export-tables/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/export-tables/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/export-tables/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/export-tables/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/export-tables/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- Template JS File -->
<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
<!-- Custom JS File -->
<script src="<?= base_url('assets/js/custom.js') ?>"></script>
<script>
  $("[data-checkboxes]").each(function() {
    var me = $(this),
      group = me.data('checkboxes'),
      role = me.data('checkbox-role');

    me.change(function() {
      var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
        checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
        dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
        total = all.length,
        checked_length = checked.length;

      if (role == 'dad') {
        if (me.is(':checked')) {
          all.prop('checked', true);
        } else {
          all.prop('checked', false);
        }
      } else {
        if (checked_length >= total) {
          dad.prop('checked', true);
        } else {
          dad.prop('checked', false);
        }
      }
    });
  });

  $('#tableSemua').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
  $('#tableTerpopuler').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
  $('#tableTerbaru').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
</script>
<!-- Page Specific JS File -->