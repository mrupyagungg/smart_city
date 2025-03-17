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
                                    <a href="./authentication-login.html"
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
            <div class="container">
                <h2 class="mb-2">Laporan Pengeluaran Kas</h2>
                <!-- Form Filter -->
                <style>
                    .filter-container {
                        display: flex;
                        align-items: center;
                        gap: 15px;
                        flex-wrap: wrap;
                        background: #f8f9fa;
                        padding: 15px;
                        border-radius: 8px;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    }

                    .filter-container label {
                        font-weight: bold;
                        margin-right: 5px;
                    }

                    .filter-container select,
                    .filter-container input {
                        padding: 8px;
                        border: 1px solid #ced4da;
                        border-radius: 5px;
                        font-size: 16px;
                        width: auto;
                        min-width: 150px;
                    }

                    .filter-container button {
                        background: #007bff;
                        color: white;
                        border: none;
                        padding: 8px 15px;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: 0.3s;
                    }

                    .filter-container button:hover {
                        background: #0056b3;
                    }
                </style>

                <!-- Form Filter -->
                <form action="{{ route('laporan.index') }}" method="GET" class="filter-container">
                    <label for="bulan">Bulan:</label>
                    <select id="bulan" name="bulan" required>
                        @foreach ([
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ] as $key => $value)
                            <option value="{{ $key }}" {{ request('bulan', date('m')) == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>

                    <label for="tahun">Tahun:</label>
                    <input type="number" id="tahun" name="tahun" min="2000" required
                        value="{{ request('tahun', date('Y')) }}">

                    <button type="submit">Filter</button>

                </form>

                <!-- Tombol Cetak -->
                <div class="mt-3 mb-3">
                    <a href="{{ route('laporan.cetak.pdf', ['bulan' => request('bulan'), 'dari_tahun' => request('dari_tahun'), 'sampai_tahun' => request('sampai_tahun')]) }}"
                        class="btn btn-danger">Cetak PDF</a>
                    <a href="{{ route('laporan.cetak.excel', ['bulan' => request('bulan'), 'dari_tahun' => request('dari_tahun'), 'sampai_tahun' => request('sampai_tahun')]) }}"
                        class="btn btn-success">Cetak Excel</a>
                </div>

                <!-- Keterangan Laporan -->
                @if (request('bulan') && request('tahun'))
                    <center>
                        <h5>Laporan Pengeluaran Kas</h5>
                        <h5> Smart City</h5>
                        <h5>Periode {{ \Carbon\Carbon::create()->month(request('bulan'))->translatedFormat('F') }}
                            {{ request('tahun') }}</h5><br>
                        <h5></h5>
                    </center>
                @endif
                <!-- Tabel Laporan -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TANGGAL</th>
                            <th>Akun</th>
                            <th>KETERANGAN</th>
                            <th>DEBIT</th>
                            <th>KREDIT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($saldo_awal as $saldo)
                            <tr>
                                <td>{{ $saldo->kode_saldo }}</td>
                                <td>{{ \Carbon\Carbon::parse($saldo->tanggal)->format('d M Y') }}</td>
                                <td>Saldo Awal</td>
                                <td>{{ $saldo->deskripsi }}</td>
                                <td>Rp {{ number_format($saldo->jumlah, 0, ',', '.') }}</td>
                                <td>-</td>
                            </tr>
                        @endforeach

                        @foreach ($pengeluaran as $item)
                            <tr>
                                <td>{{ $item->kode_pengeluaran }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                <td>{{ $item->akun->nama_akun }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>-</td>
                                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><b>Total:</b></td>
                            <td><b>Rp {{ number_format($total_debit, 0, ',', '.') }}</b></td>
                            <td><b>Rp {{ number_format($total_kredit, 0, ',', '.') }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end"><b>Sisa Saldo:</b></td>
                            <td colspan="2"><b>Rp {{ number_format($sisa_saldo, 0, ',', '.') }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endsection
