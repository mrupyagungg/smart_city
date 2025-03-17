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
                    <h5 class="card-title fw-semibold mb-4">Saldo Awal</h5>

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
                    <form action="{{ route('saldo_awal.update', ['saldo_awal' => $saldo_awal->id]) }}" method="post">
                        @csrf
                        @method('PUT')

                        <fieldset disabled>
                            <div class="mb-3">
                                <label for="kode_saldo_tampil">ID</label>
                                <input class="form-control form-control-solid" id="kode_saldo_tampil"
                                    name="kode_saldo_tampil" type="text" placeholder="Contoh: S-1"
                                    value="{{ $saldo_awal->kode_saldo }}" readonly>
                            </div>
                        </fieldset>

                        <input type="hidden" id="kode_saldo" name="kode_saldo" value="{{ $saldo_awal->kode_saldo }}">

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ old('tanggal', $saldo_awal->tanggal) }}" required>
                        </div>

                        <!-- Pilihan akun tidak bisa diubah -->
                        <div class="mb-3">
                            <label for="akun_id" class="form-label">Pilih Akun</label>
                            <select id="akun_id" class="form-control" disabled>
                                <option value="">Pilih Akun</option>
                                @foreach ($akun as $a)
                                    <option value="{{ $a->id }}"
                                        {{ $saldo_awal->akun_id == $a->id ? 'selected' : '' }}>
                                        {{ $a->nama_akun }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- Input hidden untuk tetap mengirim akun_id -->
                            <input type="hidden" name="akun_id" value="{{ $saldo_awal->akun_id }}">
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $saldo_awal->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="jumlah" name="jumlah"
                                    value="{{ number_format(old('jumlah', $saldo_awal->jumlah), 0, ',', '.') }}" required
                                    oninput="formatRupiah(this)">
                            </div>
                        </div>

                        <script>
                            function formatRupiah(input) {
                                let value = input.value.replace(/\D/g, ""); // Hapus semua karakter non-numeric
                                let formattedValue = new Intl.NumberFormat("id-ID").format(value); // Format angka
                                input.value = formattedValue;

                                // Simpan nilai asli tanpa format ke input hidden
                                document.getElementById('jumlah_hidden').value = value;
                            }
                        </script>

                        <input type="hidden" id="jumlah_hidden" name="jumlah"
                            value="{{ old('jumlah', $saldo_awal->jumlah) }}">

                        <br>

                        <!-- Tombol Simpan -->
                        <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Ubah">

                        <!-- Tombol Batal -->
                        <a class="col-sm-1 btn btn-danger btn-sm" href="{{ url('/saldo_awal') }}"
                            role="button">Batal</a>
                    </form>

                    <!-- Akhir Dari Input Form -->

                </div>
            </div>
        </div>




    @endsection
