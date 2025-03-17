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
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title fw-semibold mb-4">pengeluaran Awal</h5>
                                <div class="card">

                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary" id="headermaster">Transaksi
                                            pengeluaran Awal
                                        </h6>

                                        <!-- Tombol Tambah Data -->
                                        <a href="{{ url('/pengeluaran/create') }}"
                                            class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="ti ti-plus"></i>
                                            </span>
                                            <span class="text">Tambah Data</span>
                                        </a>
                                        <!-- Akhir Tombol Tambah Data -->

                                    </div>

                                    <div class="card-body">
                                        <!-- Awal Dari Tabel -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Kode pengeluaran</th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Akun</th>
                                                        <th>Deskripsi</th>
                                                        <th>Jumlah</th>
                                                        <th>Posisi (DB/CR)</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot class="thead-dark">
                                                    <tr>
                                                        <th>Kode pengeluaran</th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Akun</th>
                                                        <th>Deskripsi</th>
                                                        <th>Jumlah</th>
                                                        <th>Posisi (DB/CR)</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    @foreach ($pengeluaran as $a)
                                                        <tr>
                                                            <td>{{ $a->kode_pengeluaran }}</td>
                                                            <td>{{ $a->tanggal }}</td>
                                                            <td>{{ $a->akun->nama_akun }}</td>
                                                            <td>{{ $a->deskripsi }}</td>
                                                            <td>{{ number_format($a->jumlah, 2, ',', '.') }}</td>
                                                            <td>{{ $a->kredit }}</td>

                                                            <td>
                                                                <a href="{{ route('pengeluaran.edit', $a->id) }}"
                                                                    class="btn btn-success btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-check"></i>
                                                                    </span>
                                                                    <span class="text">Ubah</span>
                                                                </a>

                                                                <a href="#"
                                                                    onclick="deleteConfirm(this); return false;"
                                                                    data-id="{{ $a->id }}"
                                                                    class="btn btn-danger btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-minus"></i>
                                                                    </span>
                                                                    <span class="text">Hapus</span>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Akhir Dari Tabel -->
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <script>
                function deleteConfirm(e) {
                    var id = e.getAttribute('data-id');

                    // Set the form action dynamically
                    document.getElementById('deleteForm').setAttribute('action', "{{ url('pengeluaran') }}/" + id);

                    // Tampilkan pesan konfirmasi
                    document.getElementById("xid").innerHTML = `Data dengan ID <b>${id}</b> akan dihapus`;

                    // Tampilkan modal
                    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                        keyboard: false
                    });
                    myModal.show();
                }
            </script>


            <!-- Modal Delete Confirmation-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Apakah Anda Yakin?</h5>
                            <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">x</button>
                        </div>
                        <div class="modal-body" id="xid"></div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <!-- Form untuk DELETE -->
                            <form id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
