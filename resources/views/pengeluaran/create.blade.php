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
                                <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35"
                                    height="35" class="rounded-circle">
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
                                    <a href="{{ url('logout') }}"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
                    <h5 class="card-title fw-semibold mb-4">Pengeluaran </h5>

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

                    <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Kode Pengeluaran (Readonly) -->
                        <div class="mb-3">
                            <label for="kode_pengeluaran" class="form-label">Kode Pengeluaran</label>
                            <input type="text" class="form-control" id="kode_pengeluaran" name="kode_pengeluaran"
                                value="{{ $kode_pengeluaran }}" readonly>
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ old('tanggal') }}" required>
                        </div>

                        <!-- Pilih Akun (Selain "Kas") -->
                        <div class="mb-3">
                            <label for="akun_id" class="form-label">Akun</label>
                            <select class="form-control" id="akun_id" name="akun_id" required>
                                <option value="">---</option>
                                @foreach ($akun as $a)
                                    @if ($a->nama_akun != 'Kas')
                                        <option value="{{ $a->id }}">{{ $a->nama_akun }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                        </div>

                        <!-- bukti foto -->
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" name="foto" accept="image/*">
                        </div>

                        <!-- Jumlah (Dengan Format Rupiah) -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="jumlah" name="jumlah"
                                    value="{{ old('jumlah') }}" required oninput="formatRupiah(this)">
                            </div>
                        </div>

                        <!-- Tombol Simpan & Batal -->
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">Batal</a>
                    </form>

                    <!-- Akhir Dari Input Form -->

                </div>
            </div>
        </div>

        <script>
            function formatRupiah(input) {
                let value = input.value.replace(/\D/g, "");
                input.value = new Intl.NumberFormat("id-ID").format(value);
            }
        </script>
    @endsection
