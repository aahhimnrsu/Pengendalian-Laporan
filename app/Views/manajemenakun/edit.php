<!-- Main Content -->
<?php $page = 'Dashboard' ?>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Detail Akun</h4>
          </div>
          <div class="card-body p-3">
            <?php foreach ($datapeminjam as $peminjam) { ?>
              <h5>Data Peminjam</h5>
              <form action="<?= base_url('manajemenakun/edit/proses')?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="nama_peminjam">Username</label>
                <input type="text" name="username" id="nama" value="<?= $peminjam->username ?>" class="form-control" >
                <input type="text" name="id" id="nama" value="<?= $peminjam->id ?>" class="form-control" hidden>
              </div>
              <div class="form-group">
                <label for="nama_peminjam">Email</label>
                <input type="email" name="email" id="nama" value="<?= $peminjam->email ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="nama_peminjam">Role</label>
                <select name="role" class="form-control">
                  <option value="Admin" <?php if($peminjam->role == 'Admin'){ echo 'selected'; }?>>Admin</option>
                  <option value="Kepala Bagian" <?php if($peminjam->role == 'Kepala Bagian'){ echo 'selected'; }?>>Kepala Bagian</option>
                  <option value="Peminjam" <?php if($peminjam->role == 'Peminjam'){ echo 'selected'; }?>>Peminjam</option>
                </select>
              </div>
              <div class="form-group">
                <label for="nama_peminjam">Nama Peminjam</label>
                <input type="text" name="nama" id="nama" value="<?= $peminjam->nama ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="nama_peminjam">Universitas</label>
                <input type="text" name="universitas" id="nama" value="<?= $peminjam->universitas ?>" class="form-control" >
              </div>
              <div class="form-group">
                <label for="nama_peminjam">Alamat</label>
                <textarea name="alamat" id="" class="form-control" ><?= $peminjam->alamat ?></textarea>
              </div>
              <div class="form-group">
                <label for="nama_peminjam">Foto Peminjam</label><br>
                <img src="<?= base_url('assets/uploads/fotopeminjam/' . $peminjam->foto) ?>" width="150px">
                <input type="file" name="foto" id="nama" class="form-control" >
              </div>
              <div class="d-flex justify-content-end">
                <button class="btn btn-warning" type="submit"><i class="fa fa-edit"></i> Ubah Akun</button>
              </div>
              </form>
            <?php } ?>
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