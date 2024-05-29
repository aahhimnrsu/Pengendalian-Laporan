<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('dashboard') ?>"> <img alt="image" src="<?= base_url('assets/img/logo.png') ?>" class="header-logo" /> <span class="logo-name" style="color: black; font-family: 'Poppins';">PERTAMINA</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <?php if(session()->get('role') != 'Peminjam'){ ?>
                <li class="menu-header">Dashboard</li>
                <li class="dropdown <?php if ($page == "Dashboard") {
                    echo 'active';
                } ?>">
                <a href="<?= base_url('dashboard') ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <?php } ?>
            <li class="menu-header">Menu</li>
            <li class="dropdown <?php if ($page == "Peminjaman") {
                echo 'active';
            } ?>">
                <a href="<?= base_url('peminjaman') ?>" class="nav-link"><i data-feather="inbox"></i><span>Peminjaman</span></a>
            </li>
            <?php if(session()->get('role') == 'Admin'){ ?>
            <li class="dropdown <?php if ($page == "Laporan Kerusakan") {
                echo 'active';
            } ?>">
                <a href="<?= base_url('laporan') ?>" class="nav-link"><i data-feather="clipboard"></i><span>Laporan Kerusakan</span></a>
            </li>
            <li class="dropdown <?php if ($page == "Data Barang") {
                                    echo 'active';
                                } ?>">
                <a href="<?= base_url('barang') ?>" class="nav-link"><i data-feather="box"></i><span>Data Barang</span></a>
            </li>
            <li class="dropdown <?php if ($page == "Manajemen Akun") {
                                    echo 'active';
                                } ?>">
                <a href="<?= base_url('manajemenakun') ?>" class="nav-link"><i data-feather="users"></i><span>Manajemen Akun</span></a>
            </li>
            <?php } ?>
        </ul>
    </aside>
</div>