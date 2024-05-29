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
          <div class="card-body">
            <?= session()->getFlashdata('error'); ?>
            <form action="<?= base_url('ubahpassword/prosesubahpassword') ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Kata Sandi Lama</label>
                <input type="password" class="form-control" name="old" id="password" require>
                <input type="password" class="form-control" name="id" id="password" require hidden value="<?= session()->get('id') ?>">
              </div>
              <div class="form-group">
                <label>Kata Sandi Baru</label>
                <input type="password" class="form-control" name="new" id="password" require>
              </div>
              <div class="form-group">
                <label>Ulangi Kata Sandi Baru</label>
                <input type="password" class="form-control" name="repeat" id="password" require>
              </div>
              <div class="d-flex justify-content-end">
                <button class="btn btn-warning" type="submit"><i class="fa fa-key"></i> Ubah Kata Sandi</button>
              </div>
            </form>
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