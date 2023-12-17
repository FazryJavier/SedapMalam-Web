@extends('Admin.Layouts.master')

@section('title')
    Halaman Data Orangtua
@endsection

@push('script')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
@endpush

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                    Create
                </button>
            </div>
        </div>
    </div>

    {{-- Tabel Data --}}
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">No</th>
                <th class="col-sm-2">Nama Ayah</th>
                <th class="col-sm-2">Nama Ibu</th>
                <th class="col-sm-3">Alamat</th>
                <th class="col-sm-2">Nomor Telpon</th>
                <th class="col-sm-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataorangtua as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama_ayah }}</td>
                    <td>{{ $item->nama_ibu }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telpon }}</td>
                    <td>
                        <form action="/data-orangtua/{{ $item->id }}" method="POST">
                            <a href="#" type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#modal-edit-{{ $item->id }}"> <i class="fa-solid fa-pen-to-square"></i></a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure want to delete this data?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">Data is Empty</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tambah Data --}}
    <div class="modal fade" id="modal-lg" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Orangtua</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/data-orangtua" method="POST" enctype="multipart/form-data" id="quickForm">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="nama_ayah_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="nama_ibu_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Rumah</label>
                            <textarea name="alamat" class="form-control" rows="2"></textarea>
                            <span class="text-danger" id="alamat_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="no_telpon" class="form-label">Nomor Telpon</label>
                            <input type="text" name="no_telpon" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="no_telpon_error"></span>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="validateForm()">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Ubah Data --}}
    @foreach ($dataorangtua as $item)
        <div class="modal fade" id="modal-edit-{{ $item->id }}" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Data Orangtua</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/data-orangtua/{{ $item->id }}" method="POST" enctype="multipart/form-data"
                            id="updateForm-{{ $item->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control"
                                    value="{{ $item->nama_ayah }}">
                                <span class="text-danger" id="nama_ayah_error_{{ $item->id }}"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control"
                                    value="{{ $item->nama_ibu }}">
                                <span class="text-danger" id="nama_ibu_error_{{ $item->id }}"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2">{{ $item->alamat }}"</textarea>
                                <span class="text-danger" id="alamat_error_{{ $item->id }}"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_telpon" class="form-label">Nomor Telpon</label>
                                <input type="text" name="no_telpon" class="form-control"
                                    value="{{ $item->no_telpon }}">
                                <span class="text-danger" id="no_telpon_error_{{ $item->id }}"></span>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success"
                                    onclick="validateUpdateForm('{{ $item->id }}')">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function validateForm() {
            var namaAyah = document.forms["quickForm"]["nama_ayah"].value;
            var namaIbu = document.forms["quickForm"]["nama_ibu"].value;
            var alamat = document.forms["quickForm"]["alamat"].value;
            var noTelpon = document.forms["quickForm"]["no_telpon"].value;

            document.getElementById('nama_ayah_error').innerHTML = "";
            document.getElementById('nama_ibu_error').innerHTML = "";
            document.getElementById('alamat_error').innerHTML = "";
            document.getElementById('no_telpon_error').innerHTML = "";

            if (namaAyah == "") {
                document.getElementById('nama_ayah_error').innerHTML = "Nama Ayah harus diisi";
            }
            if (namaIbu == "") {
                document.getElementById('nama_ibu_error').innerHTML = "Nama Ibu harus diisi";
            }
            if (alamat == "") {
                document.getElementById('alamat_error').innerHTML = "Alamat harus diisi";
            }
            if (noTelpon == "") {
                document.getElementById('no_telpon_error').innerHTML = "Nomor Telpon harus diisi";
            }

            if (namaAyah != "" && namaIbu != "" && alamat != "" && noTelpon != "") {
                $('#quickForm').submit();
            }
        }

        function validateUpdateForm(itemId) {
            var namaAyah = document.forms["updateForm-" + itemId]["nama_ayah"].value;
            var namaIbu = document.forms["updateForm-" + itemId]["nama_ibu"].value;
            var alamat = document.forms["updateForm-" + itemId]["alamat"].value;
            var noTelpon = document.forms["updateForm-" + itemId]["no_telpon"].value;

            document.getElementById('nama_ayah_error_' + itemId).innerHTML = "";
            document.getElementById('nama_ibu_error_' + itemId).innerHTML = "";
            document.getElementById('alamat_error_' + itemId).innerHTML = "";
            document.getElementById('no_telpon_error_' + itemId).innerHTML = "";

            if (namaAyah == "") {
                document.getElementById('nama_ayah_error_' + itemId).innerHTML = "Nama Ayah harus diisi";
            }
            if (namaIbu == "") {
                document.getElementById('nama_ibu_error_' + itemId).innerHTML = "Nama Ibu harus diisi";
            }
            if (alamat == "") {
                document.getElementById('alamat_error_' + itemId).innerHTML = "Alamat harus diisi";
            }
            if (noTelpon == "") {
                document.getElementById('no_telpon_error_' + itemId).innerHTML = "Nomor Telpon harus diisi";
            }

            if (namaAyah != "" && namaIbu != "" && alamat != "" && noTelpon != "") {
                $('#updateForm-' + itemId).submit();
            }
        }
    </script>
@endsection
