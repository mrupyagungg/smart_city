@extends('layoutbootstrap')

@section('konten')
    <!--  Main wrapper -->
    <div class="body-wrapper">

        <!--  Header End -->
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title fw-semibold mb-4">Akun</h5>
                                <div class="card">

                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary" id="headermaster">Master Data Akun
                                        </h6>

                                        <!-- Tombol Tambah Data -->
                                        <a href="{{ url('/akun/create') }}" class="btn btn-primary btn-icon-split btn-sm">
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
                                                        <th>ID</th>
                                                        <th>Nama Akun</th>
                                                        <th>Header Akun</th>
                                                        <th>Posisi db_cr</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tfoot class="thead-dark">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nama Akun</th>
                                                        <th>Header Akun</th>
                                                        <th>Posisi db_cr</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    @foreach ($akun as $k)
                                                        <tr>
                                                            <td>{{ $k->kode_akun }}</td>
                                                            <td>{{ $k->nama_akun }}</td>
                                                            <td>{{ $k->header_akun }}</td>
                                                            <td>{{ $k->db_cr }}</td>
                                                            <td>
                                                                <a href="{{ route('akun.edit', $k->id) }}"
                                                                    class="btn btn-success btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-check"></i>
                                                                    </span>
                                                                    <span class="text">Ubah</span>
                                                                </a>

                                                                <!-- <a href="#" onclick="deleteConfirm(this); return false;"
                                                                    data-id="{{ $k->id }}"
                                                                    class="btn btn-danger btn-icon-split btn-sm">
                                                                    <span class="icon text-white-50">
                                                                        <i class="ti ti-minus"></i>
                                                                    </span>
                                                                    <span class="text">Hapus</span>
                                                                </a> -->

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
                    document.getElementById('deleteForm').setAttribute('action', "{{ url('akun') }}/" + id);

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
