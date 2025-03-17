@extends('layoutbootstrap')

@section('konten')

<!--  Main wrapper -->
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                        <i class="ti ti-bell-ringing"></i>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                </li>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('images/profile/user-1.jpg')}}" alt="" width="35" height="35"
                                class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-mail fs-6"></i>
                                    <p class="mb-0 fs-3">My Account</p>
                                </a>
                                <a href="{{url('logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Data Akun</h5>

                <!-- Display Error jika ada error -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Akhir Display Error -->

                <!-- Awal Dari Input Form -->
                <form action="{{ route('akun.update', ['akun' => $akun->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <fieldset disabled>
                        <div class="mb-3"><label for="kodeakunlabel">ID</label>
                            <input class="form-control form-control-solid" id="kode_akun_tampil" name="kode_akun_tampil"
                                type="text" placeholder="Cth: KG-1" value="{{$akun->kode_akun}}" readonly>
                        </div>
                    </fieldset>
                    <input type="hidden" id="kode_akun" name="kode_akun" value="{{$akun->kode_akun}}">

                    <div class="mb-3"><label for="nama_akun">Nama Akun</label>
                        <input class="form-control form-control-solid" id="nama_akun" name="nama_akun" type="text"
                            value="{{$akun->nama_akun}}">
                    </div>

                    <div class="mb-3"><label for="header_akun">Header Akun</label>
                        <input class="form-control form-control-solid" id="header_akun" name="header_akun" type="text"
                            placeholder="Cth: Elouis Rosliana Balqis" value="{{$akun->header_akun}}">
                    </div>

                    <div class="mb-3">
                        <label for="dbcrlabel">Keterangan</label>
                        <select class="form-control form-control-solid" id="db_cr" name="db_cr" required>
                            <option value="" disabled selected>-- Choose an option --</option>
                            <option value="Debit">Debit</option>
                            <option value="Kredit">Kredit</option>
                        </select>
                    </div>

                    <br>
                    <!-- untuk tombol simpan -->

                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Ubah">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-success  btn-sm" href="{{ url('/akun') }}" role="button">Batal</a>

                </form>
                <!-- Akhir Dari Input Form -->

            </div>
        </div>
    </div>




    @endsection