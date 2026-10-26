```php
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo AdminLTE -->
    <a href="<?= base_url('Admin_C') ?>" class="brand-link">
        <img
            src="<?= base_url('AdminLTE-3.2.0/dist/img/AdminLTELogo.png') ?>"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">

        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img
                    src="<?= base_url('foto.png') ?>"
                    class="img-circle elevation-2"
                    alt="Foto Indra"
                    style="width: 35px; height: 35px; object-fit: cover;">
            </div>

            <div class="info">
                <a href="#" class="d-block">User: Indra</a>
            </div>
        </div>

        <!-- Search -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input
                    class="form-control form-control-sidebar"
                    type="search"
                    placeholder="Search"
                    aria-label="Search">

                <div class="input-group-append">
                    <button class="btn btn-sidebar" type="button">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="true">

                <!-- MASTER DATA -->
                <li class="nav-item">
                    <a href="#" class="nav-link bg-primary">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('Mobil_C/index') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Mobil</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Penyewa</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- TRANSAKSI -->
                <li class="nav-item">
                    <a href="#" class="nav-link bg-primary">
    <i class="nav-icon fas fa-exchange-alt"></i>
    <p>
        Transaksi
        <i class="right fas fa-angle-left"></i>
    </p>
</a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Sewa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pembayaran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kembali</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Denda</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- LAPORAN -->
                <li class="nav-item">
                    <a href="#" class="nav-link bg-primary">
    <i class="nav-icon fas fa-chart-bar"></i>
    <p>
        Laporan
        <i class="right fas fa-angle-left"></i>
    </p>
</a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kembali</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- LOGOUT -->
                <li class="nav-item">
                    <a href="<?= base_url('Login_C/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>
```