<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>APL Pertamina</title>
  <!-- General CSS Files -->
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <!-- General CSS Files -->
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='<?= base_url('assets/img/icon.png') ?>' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
            <div class="card card-info">
              <div class="card-header d-flex justify-content-center">
                <img src="<?= base_url('assets/img/logo.png') ?>" style="width: 100px;">
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pelajar-tab" data-toggle="tab" href="#pelajar" role="tab" aria-controls="pelajar" aria-selected="true">PELAJAR</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pegawai-tab" data-toggle="tab" href="#pegawai" role="tab" aria-controls="pegawai" aria-selected="false">PEGAWAI</a>
                  </li>
                </ul>
                <div class="tab-content d-flex justify-content-center" id="myTabContent">
                  <div class="tab-pane fade show active" id="pelajar" role="tabpanel" aria-labelledby="pelajar-tab">
                    <form method="POST" action="<?= base_url('daftar/proses') ?>" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="Nama">Nama Lengkap</label>
                            <input id="Nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                          </div>
                          <div class="form-group">
                            <label for="Nama">Email</label>
                            <input id="Nama" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                          </div>
                          <div class="form-group">
                            <label for="Nama">Username</label>
                            <input id="Nama" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                          </div>
                          <div class="form-group">
                            <label for="password" class="control-label">Kata Sandi</label>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="Nama">Universitas</label>
                            <input id="Nama" type="text" class="form-control" name="universitas" tabindex="1" required autofocus>
                          </div>
                          <div class="form-group">
                            <label for="Nama">Alamat</label>
                            <textarea name="alamat" class="form-control"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="Nama">Foto</label>
                            <input id="Nama" type="file" class="form-control" name="foto" tabindex="1" required autofocus>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                          Daftar
                        </button>
                        <div class="text-center mt-3">
                          Sudah Memiliki Akun? <a href="<?= base_url('/') ?>">Masuk</a>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="pegawai" role="tabpanel" aria-labelledby="pegawai-tab">
                    <form method="POST" action="<?= base_url('daftar/proses') ?>" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="Nama">Nama Lengkap</label>
                            <input id="Nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                          </div>
                          <div class="form-group">
                            <label for="Nama">Email</label>
                            <input id="Nama" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                          </div>
                          <div class="form-group">
                            <label for="Nama">Username</label>
                            <input id="Nama" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                          </div>
                          <div class="form-group">
                            <label for="password" class="control-label">Kata Sandi</label>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="Nama">Bagian</label>
                            <input id="Nama" type="text" class="form-control" name="universitas" tabindex="1" required autofocus>
                          </div>
                          <div class="form-group">
                            <label for="Nama">Alamat</label>
                            <textarea name="alamat" class="form-control"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="Nama">Foto</label>
                            <input id="Nama" type="file" class="form-control" name="foto" tabindex="1" required autofocus>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                          Daftar
                        </button>
                        <div class="text-center mt-3">
                          Sudah Memiliki Akun? <a href="<?= base_url('/') ?>">Masuk</a>
                        </div>
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
   <!-- General JS Scripts -->
   <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>