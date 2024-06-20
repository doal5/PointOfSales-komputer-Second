            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-dark">
                    <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
                        <h4 class="text-primary"><i class="fa fa-laptop"></i> POS PAROENG </h4>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src="{{ asset('dashmin/img/user.jpg') }}" alt=""
                                style="width: 40px; height: 40px;">
                            <div
                                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <span>Admin</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="{{ route('dashboard') }}"
                            class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}"><i
                                class="fa fa-tachometer-alt me-2"></i>Dashboard</a>


                        <a href="{{ route('produk.index') }}"
                            class="nav-item nav-link {{ Request::is('produk') ? 'active' : '' }}"><i
                                class="fa fa-th me-2"></i>Produk</a>
                        <a href="{{ route('kategori.index') }}"
                            class="nav-item nav-link {{ Request::is('kategori') ? 'active' : '' }}"><i
                                class="fa fa-keyboard me-2"></i>Kategori</a>
                        <a href="{{ route('supplier.index') }}"
                            class="nav-item nav-link {{ Request::is('supplier') ? 'active' : '' }}"><i
                                class="fa fa-table me-2"></i>Supplier</a>
                        <a href="{{ route('transaksi.index') }}"
                            class="nav-item nav-link {{ Request::is('transaksi') ? 'active' : '' }}"><i
                                class="fa fa-calculator"></i>Transaksi</a>
                        <a href="{{ route('laporan.index') }}"
                            class="nav-item nav-link {{ Request::is('laporan') ? 'active' : '' }}"><i
                                class="fa-solid fa-file-contract"></i>Laporan</a>
                        <a href="{{ route('analisis.index') }}"
                            class="nav-item nav-link {{ Request::is('analisis') ? 'active' : '' }}"><i
                                class="fa-solid fa-chart-simple"></i>Analisis</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="far fa-file-alt me-2"></i>Pages</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="signin.html" class="dropdown-item">Sign In</a>
                                <a href="signup.html" class="dropdown-item">Sign Up</a>
                                <a href="404.html" class="dropdown-item">404 Error</a>
                                <a href="blank.html" class="dropdown-item">Blank Page</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->
