<!-- Main Content -->
<?php $page = 'Dashboard' ?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Data Peminjaman</h4>
            <?php if (session()->get('role') == 'Peminjam') { ?>
              <div class="card-action">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#TambahBuku"><i class="fas fa-box-open"></i> Pinjam Barang</button>
              </div>
            <?php } ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="tableSemua" style="width:100%;">
                <thead>
                  <tr>
                    <th class="text-center">Nama Peminjam</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Tanggal Peminjaman</th>
                    <th class="text-center">Tanggal Pengembalian</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Opsi</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($datapeminjaman as $peminjaman) { ?>
                    <tr>
                      <td class="text-center"><?= $peminjaman->nama_peminjam ?></td>
                      <td class="text-center"><?= $peminjaman->nama_barang ?></td>
                      <td class="text-center"><?= $peminjaman->jumlah ?></td>
                      <td class="text-center"><?= $peminjaman->tanggal_peminjaman ?></td>
                      <td class="text-center"><?= $peminjaman->tanggal_pengembalian ?></td>
                      <td class="text-center"><?php if ($peminjaman->status == 'Tidak Tervalidasi') {
                                                echo '<span class="badge badge-danger">Tidak Tervalidasi</span>';
                                              } else if ($peminjaman->status == 'Telah Tervalidasi') {
                                                echo '<span class="badge badge-info">Telah Tervalidasi</span>';
                                              } else if ($peminjaman->status == 'Belum Dikembalikan') {
                                                echo '<span class="badge badge-warning">Belum Dikembalikan</span>';
                                              } else if ($peminjaman->status == 'Telah Dikembalikan') {
                                                echo '<span class="badge badge-success">Telah Dikembalikan</span>';
                                              } else if ($peminjaman->status == 'Menunggu Validasi') {
                                                echo '<span class="badge badge-primary">Menunggu Validasi</span>';
                                              } ?></td>
                      <td class="text-center">
                        <a href="<?= base_url('peminjaman/detail/' . $peminjaman->id) ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <?php if (session()->get('role') == 'Kepala Bagian') {
                          if ($peminjaman->status == 'Menunggu Validasi') { ?>
                            <a href="<?= base_url('peminjaman/validasi/' . $peminjaman->id) ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                            <a href="<?= base_url('peminjaman/tidakvalidasi/' . $peminjaman->id) ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                            <?php } ?>
                            <?php } ?>
                            <?php if (session()->get('role') == 'Admin') {
                              if ($peminjaman->status == 'Belum Dikembalikan') { ?>
                                <button data-id="<?= $peminjaman->id ?>" class="btn btn-sm btn-success edit-btn"><i class="fas fa-calendar-check"></i></button>
                                <?php } ?>
                                <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="TambahBuku" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">+ Pinjam Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('peminjaman/tambah') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Peminjam</label>
            <input type="text" class="form-control" name="id_peminjam" value="<?= session()->get('id') ?>" require hidden>
            <input type="text" class="form-control" name="nama_peminjam" value="<?= session()->get('nama') ?>" require readonly>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <select class="form-control select" name="nama_barang">
              <?php foreach ($databarang as $barang) { ?>
                <option value="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" step="1" class="form-control" name="jumlah" require>
          </div>
          <div class="form-group">
            <label>Tanggal Peminjaman</label>
            <input type="date" step="1" min="0" class="form-control" name="tanggal_peminjaman" value="<?= date('Y-m-d') ?>" require readonly>
          </div>
          <div class="form-group">
            <label>Tanggal Pengembalian</label>
            <input type="date" step="1" min="0" class="form-control" name="tanggal_pengembalian" require>
          </div>
          <div class="form-group">
            <label>Foto ID Card</label>
            <input type="file" step="1" class="form-control" name="foto" require>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Pinjam</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- MODAL UPDATE -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Pengembalian Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('peminjaman/pengembalian') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="text" name="id" id="editId" hidden>
          <div class="form-group">
            <label>Kondisi</label>
            <select class="form-control select" name="kondisi">
              <option value="Baik">Baik</option>
              <option value="Rusak">Rusak</option>
              <option value="Hilang">Hilang</option>
            </select>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Kembalikan</button>
        </div>
      </form>
    </div>
  </div>
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
  // Ketika tombol "Edit" di klik
  $(document).ready(function() {
    // Ketika tombol "Edit" di klik
    $('.edit-btn').click(function() {
      var id = $(this).data('id');
      // Lakukan AJAX request untuk mengambil data berdasarkan ID
      $.ajax({
        url: '<?= base_url('controller/get_data_by_id'); ?>',
        method: 'post',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          // Isi form di dalam modal dengan data yang diambil
          $('#editId').val(response.id);
          $('#editName').val(response.name);
          $('#editEmail').val(response.email);
          // Tampilkan modal
          $('#editModal').modal('show');
        }
      });
    });
  });

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