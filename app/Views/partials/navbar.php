<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                            <i data-feather="maximize"></i>
                        </a></li>
                    <li>

                    </li>
                </ul>
            </div>
            <ul class="navbar-nav navbar-right">
                
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="<?= base_url('assets/img/user.webp') ?>" class="user-img-radious-style"><span class="d-sm-none d-lg-inline-block"></span></a>
                    <div class="dropdown-menu dropdown-menu-right pullDown">
                        <div class="dropdown-title">Hai, <?= session()->get('nama') ?></div>
                        <div class="dropdown-divider"></div>
                            <a href="<?= base_url('ubahpassword') ?>" class="dropdown-item has-icon"> <i class="fas fa-key"></i>
                                Ubah Kata Sandi
                            </a>
                        <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                            Keluar
                        </a>
                    </div>
                </li>
            </ul>
        </nav>