            <!-- Sidebar Start -->
            <div class="sidebar pe-7 pb-3">
                <nav class="navbar bg-light navbar-dark">
                    <div class="logo" style="margin-left:15px; margin-bottom:10px">

                        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
                            <img src="{{ asset('img/logo.png') }}" width="120" height="100" alt=""
                                style="width: 100px; height: 100px; margin-left:20px">
                        </a>
                        <h5> <b> <i> <span class="badge bg-primary">POS - LSP</span></i> </b> </h5>
                    </div>

                    <div class="d-flex align-items-center" style="margin-left:70px">
                        <div class="" style="align-items: center">
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                            <span>
                                @if (auth()->user()->level == 1)
                                    Admin
                                @else
                                    Kasir
                                @endif
                            </span>
                        </div>
                        <div class="ms-3">
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        {{-- jika user login level 1 --}}
                        @if (auth()->user()->level == 1)
                            <a href="{{ route('dashboard') }}"
                                class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}"><i
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
                            <a href="{{ route('pengeluaran.index') }}"
                                class="nav-item nav-link {{ Request::is('pengeluaran') ? 'active' : '' }}"><i
                                    class="fa fa-cube"></i>pengadaan produk</a>
                            <a href="{{ route('pengeluaranToko.index') }}"
                                class="nav-item nav-link {{ Request::is('pengeluaranToko') ? 'active' : '' }}"><i
                                    class="fa fa-wallet"></i> Pengeluaran
                            </a>
                            <a href="{{ route('laporan.index') }}"
                                class="nav-item nav-link {{ Request::is('laporan') ? 'active' : '' }}"><i
                                    class="fa-solid fa-file-contract"></i>Laporan</a>
                            <a href="{{ route('analisis.index') }}"
                                class="nav-item nav-link {{ Request::is('analisis') ? 'active' : '' }}"><i
                                    class="fa-solid fa-chart-simple"></i>Analisis</a>
                            <a href="{{ route('user.index') }}"
                                class="nav-item nav-link {{ Request::is('user') ? 'active' : '' }}"><i
                                    class="fa-solid fa-user"></i>user</a>
                            <a href="{{ route('registrasi') }}"
                                class="nav-item nav-link {{ Request::is('registrasi') ? 'active' : '' }}"><i
                                    class="fa-solid fa-users"></i>Registrasi</a>
                        @else
                            {{-- jika user login level 2, hanya menu tersebut yang tampil --}}
                            <a href="{{ route('transaksi.index') }}"
                                class="nav-item nav-link {{ Request::is('transaksi') ? 'active' : '' }}"><i
                                    class="fa fa-calculator"></i>Transaksi</a>
                        @endif
                        <a href="{{ route('logout') }}" class="nav-item nav-link" id="logout"><i
                                class="fa-solid fa-arrow-left"></i>Logout</a>
                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->
            {{-- SweetAlert --}}
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const logoutLink = document.getElementById('logout');

                    logoutLink.addEventListener('click', function(event) {
                        event.preventDefault();

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, logout!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "get",
                                    url: "{{ route('logout') }}",
                                    success: function(response) {
                                        window.location.href = '/';
                                    }
                                });
                            }
                        });
                    });
                });
            </script>

            {{-- mari kita coba wkwkwkw --}}
