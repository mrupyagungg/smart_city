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
                <h5 class="card-title fw-semibold mb-4">Data Staff</h5>

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
                <form action="{{ route('staff.store') }}" method="post">
                    @csrf
                    <fieldset disabled>
                        <div class="mb-3"><label for="kodestafflabel">ID</label>
                            <input class="form-control form-control-solid" id="kode_staff_tampil"
                                name="kode_staff_tampil" type="text" placeholder="Contoh: AG-1" value="{{$kode_staff}}"
                                readonly>
                        </div>
                    </fieldset>
                    <input type="hidden" id="kode_staff" name="kode_staff" value="{{$kode_staff}}">

                    <div class="mb-3"><label for="namastafflabel">Nama Staff</label>
                        <input class="form-control form-control-solid" id="nama_staff" name="nama_staff" type="text"
                            placeholder="Cth: Elouis Rosliana Balqis" value="{{old('nama_staff')}}">
                    </div>

                    <div class="mb-3">
                        <label for="kategoristafflabel">Jenis Kelamin</label>
                        <select class="form-control form-control-solid" id="jenis_kelamin" name="jenis_kelamin"
                            required>
                            <option value="" disabled selected>-- Choose an option --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3"><label for="namastafflabel">Alamat</label>
                        <input class="form-control form-control-solid" id="alamat" name="alamat" type="text"
                            placeholder="Cth: Elouis Rosliana Balqis" value="{{old('alamat')}}">
                    </div>

                    <div class="mb-0"><label for="emailstafflabel">Nomor Telepon</label>
                        <input class="form-control form-control-solid" id="no_telepon" name="no_telepon" type="number"
                            placeholder="Cth: darderdor@gmail.com">{{old('email_staff')}}</input>
                    </div>

                    <div class="mb-0"><label for="emailstafflabel">Email</label>
                        <input class="form-control form-control-solid" id="email_staff" name="email_staff" type="email"
                            placeholder="Cth: darderdor@gmail.com">{{old('email_staff')}}</input>
                    </div>

                    <div class="mb-3">
                        <label for="kategoristafflabel">Kategori</label>
                        <select class="form-control form-control-solid" id="kategori_staff" name="kategori_staff"
                            required>
                            <option value="" disabled selected>-- Choose an option --</option>
                            <option value="Ketua CoE">Ketua Coe</option>
                            <option value="Staff Finance">Staff Finance</option>
                        </select>
                    </div>

                    <br>
                    <!-- untuk tombol simpan -->

                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-success  btn-sm" href="{{ url('/staff') }}" role="button">Batal</a>

                </form>
                <!-- Akhir Dari Input Form -->

            </div>
        </div>
    </div>




    @endsection