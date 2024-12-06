<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
        <!--plugins-->
        <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
        <!-- loader-->
        <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('assets/js/pace.min.js') }}"></script>
        <!-- Bootstrap CSS -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
        <title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
    </head>

    <body class="">
        <!--wrapper-->
        <div class="wrapper">
            <div class="section-authentication-cover">
                <div class="">
                    <div class="row g-0">

                        <div
                            class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                            <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                                <div class="card-body">
                                    <img src="assets/images/login-images/register-cover.svg"
                                        class="img-fluid auth-img-cover-login" width="550" alt="" />
                                </div>
                            </div>

                        </div>

                        <div
                            class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                            <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                                <div class="card-body p-sm-5">
                                    <div class="">
                                        <div class="mb-3 text-center">
                                            <img src="assets/images/logo-icon.png" width="60" alt="" />
                                        </div>
                                        <div class="text-center mb-4">
                                            <h5 class="">LSP Admin</h5>
                                            <p class="mb-0">Please fill the below details to create your account</p>
                                        </div>
                                        @if ($message = session('sukses'))
                                            <div class="alert alert-success" role="alert">
                                                {{ $message }}
                                            </div>
                                        @endif
                                        <div class="form-body">
                                            <form class="row g-3" method="POST"
                                                action="{{ route('registrasi-insert') }}">
                                                @csrf
                                                @error('nama')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="col-12">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        id="nama" placeholder="Sechan"
                                                        value="{{ old('nama') }}">
                                                </div>
                                                @error('email')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email
                                                        Address</label>
                                                    <input type="email" name="email" class="form-control"
                                                        id="inputEmailAddress" placeholder="example@user.com"
                                                        value="{{ old('email') }}">
                                                </div>
                                                @error('level')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Role</label>
                                                    <select name="level" id="" class="form-select">
                                                        <option value="#">Pilih Role</option>
                                                        <option value="1">Admin</option>
                                                        <option value="2">Kasir</option>
                                                    </select>
                                                </div>
                                                @error('password')
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" name="password"
                                                            class="form-control border-end-0" id="inputChoosePassword"
                                                            value="{{ old('password') }}" placeholder="Enter Password">
                                                        <a href="javascript:;"
                                                            class="input-group-text bg-transparent"><i
                                                                class='bx bx-hide'></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckChecked">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">I
                                                            read and agree to Terms & Conditions</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">Sign
                                                            up</button>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center ">
                                                        <p class="mb-0">Kembali Ke<a
                                                                href="{{ route('dashboard') }}">
                                                                Dashboard</a></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--end wrapper-->
        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        <!--Password show & hide js -->
        <script>
            $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("bx-hide");
                        $('#show_hide_password i').removeClass("bx-show");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("bx-hide");
                        $('#show_hide_password i').addClass("bx-show");
                    }
                });
            });
        </script>
        <!--app JS-->
        <script src="assets/js/app.js"></script>
        <script>
            $(document).ready(function() {
                $('.alert').fadeOut(5000);
            });
        </script>

    </body>

</html>
