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
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                            <span>
                                @if (auth()->user()->level == 1)
                                    Admin
                                @else
                                    Kasir
                                @endif
                            </span>
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
                            <a href="{{ route('laporan.index') }}"
                                class="nav-item nav-link {{ Request::is('laporan') ? 'active' : '' }}"><i
                                    class="fa-solid fa-file-contract"></i>Laporan</a>
                            <a href="{{ route('analisis.index') }}"
                                class="nav-item nav-link {{ Request::is('analisis') ? 'active' : '' }}"><i
                                    class="fa-solid fa-chart-simple"></i>Analisis</a>
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
