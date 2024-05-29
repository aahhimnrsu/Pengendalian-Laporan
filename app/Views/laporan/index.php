<!-- Main Content -->
<?php $page = 'Dashboard' ?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Laporan Kerusakan</h4>
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
                    <th class="text-center">Kondisi</th>
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
                      <td class="text-center"><?php if($peminjaman->kondisi == 'Rusak'){
                          echo '<span class="badge badge-danger">Rusak</span>';
                        }else if($peminjaman->kondisi == 'Baik'){
                          echo '<span class="badge badge-info">Baik</span>';
                        }else if($peminjaman->kondisi == 'Hilang'){
                          echo '<span class="badge badge-warning">Hilang</span>';
                        }?></td>
                      <td class="text-center">
                        <a href="<?= base_url('laporan/detail/' . $peminjaman->id) ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <?php if(session()->get('role') == 'Kepala Bagian'){?>
                          <?php if($peminjaman->status == 'Telah Dikembalikan' && $peminjaman->keterangan == NULL){?>
                            <button data-id="<?=  $peminjaman->id ?>" class="btn btn-sm btn-warning edit-btn"><i class="fas fa-edit"></i></button>
                          <?php }?>
                        <?php }?>
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

<!-- MODAL UPDATE -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Pertanggungjawaban Laporan Kehilangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('laporan/bayar') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="text" name="id" id="editId" hidden>
          <div class="form-group">
            <label>Kondisi</label>
            <textarea name="keterangan" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-share"></i> Kirim</button>
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
    $(document).ready(function(){
        // Ketika tombol "Edit" di klik
        $('.edit-btn').click(function(){
            var id = $(this).data('id');
            // Lakukan AJAX request untuk mengambil data berdasarkan ID
            $.ajax({
                url: '<?= base_url('controller/get_data_by_id'); ?>',
                method: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response){
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