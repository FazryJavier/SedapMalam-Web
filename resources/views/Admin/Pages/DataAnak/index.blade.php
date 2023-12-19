@extends('Admin.Layouts.master')

@section('title')
    Halaman Data Anak
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
                <th class="col-sm-2">NIK</th>
                <th class="col-sm-2">Nama</th>
                <th class="col-sm-2">Umur</th>
                <th class="col-sm-1">Berat Badan</th>
                <th class="col-sm-1">Tinggi Badan</th>
                <th class="col-sm-1">BMI</th>
                <th class="col-sm-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataanak as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nik_anak }}</td>
                    <td>{{ $item->nama_anak }}</td>
                    <td>{{ $item->umur }}</td>
                    <td>{{ $item->berat_badan }}</td>
                    <td>{{ $item->tinggi_badan }}</td>
                    <td>{{ $item->bmi }}</td>
                    <td>
                        <form id="delete-form-{{ $item->id }}" action="/data-anak/{{ $item->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="#" type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#modal-edit-{{ $item->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $item->id }}">
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
                    <h4 class="modal-title">Tambah Data Anak</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/data-anak" method="POST" enctype="multipart/form-data" id="quickForm">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="nik_anak" class="form-label">NIK</label>
                            <input type="text" name="nik_anak" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="nik_anak_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="nama_anak" class="form-label">Nama</label>
                            <input type="text" name="nama_anak" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="nama_anak_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="text" name="umur" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="umur_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="berat_badan" class="form-label">Berat Badan</label>
                            <input type="text" name="berat_badan" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="berat_badan_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="tinggi_badan" class="form-label">Tinggi Badan</label>
                            <input type="text" name="tinggi_badan" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="tinggi_badan_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="bmi" class="form-label">Hasil BMI</label>
                            <input type="text" name="bmi" class="form-control" id="formGroupExampleInput">
                            <span class="text-danger" id="bmi_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="IdOrangtua" class="form-label">Nama Ibu</label>
                            <select name="IdOrangtua" class="custom-select rounded-0" id="IdOrangtua">
                                <option value="">Pilih Orang tua</option>
                                @foreach ($dataorangtuas as $dataorangtua)
                                    <option value="{{ $dataorangtua->id }}">{{ $dataorangtua->nama_ibu }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="IdOrangtua_error"></span>
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
    @foreach ($dataanak as $item)
        <div class="modal fade" id="modal-edit-{{ $item->id }}" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Data Anak</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/data-anak/{{ $item->id }}" method="POST" enctype="multipart/form-data"
                            id="updateForm-{{ $item->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="nik_anak" class="form-label">NIK</label>
                                <input type="text" name="nik_anak" class="form-control"
                                    value="{{ $item->nik_anak }}">
                                <span class="text-danger" id="nik_anak_error_{{ $item->id }}"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_anak" class="form-label">Nama</label>
                                <input type="text" name="nama_anak" class="form-control"
                                    value="{{ $item->nama_anak }}">
                                <span class="text-danger" id="nama_anak_error_{{ $item->id }}"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="text" name="umur" class="form-control" value="{{ $item->umur }}">
                                <span class="text-danger" id="umur_error_{{ $item->id }}"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="berat_badan" class="form-label">Berat Badan</label>
                                <input type="text" name="berat_badan" class="form-control"
                                    value="{{ $item->berat_badan }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tinggi_badan" class="form-label">Tinggi Badan</label>
                                <input type="text" name="tinggi_badan" class="form-control"
                                    value="{{ $item->tinggi_badan }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="bmi" class="form-label">Hasil BMI</label>
                                <input type="text" name="bmi" class="form-control" value="{{ $item->bmi }}">
                            </div>
                            <div class="mb-3">
                                <label for="IdOrangtua" class="form-label">Nama Ibu</label>
                                <select name="IdOrangtua" class="custom-select rounded-0" id="IdOrangtua">
                                    <option value="">Pilih Orang tua</option>
                                    @foreach ($dataorangtuas as $dataorangtua)
                                        <option value="{{ $dataorangtua->id }}"
                                            @if ($dataorangtua->id == $item->IdOrangtua) selected @endif>
                                            {{ $dataorangtua->nama_ibu }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="IdOrangtua_error_{{ $item->id }}"></span>
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
        // Tambah Data
        function validateForm() {
            var nikAnak = document.forms["quickForm"]["nik_anak"].value;
            var namaAnak = document.forms["quickForm"]["nama_anak"].value;
            var umur = document.forms["quickForm"]["umur"].value;
            var IdOrangtua = document.forms["quickForm"]["IdOrangtua"].value;

            document.getElementById('nik_anak_error').innerHTML = "";
            document.getElementById('nama_anak_error').innerHTML = "";
            document.getElementById('umur_error').innerHTML = "";
            document.getElementById('IdOrangtua_error').innerHTML = "";

            if (nikAnak == "") {
                document.getElementById('nik_anak_error').innerHTML = "NIK Anak harus diisi";
            }
            if (namaAnak == "") {
                document.getElementById('nama_anak_error').innerHTML = "Nama Anak harus diisi";
            }
            if (umur == "") {
                document.getElementById('umur_error').innerHTML = "Umur harus diisi";
            }
            if (IdOrangtua == "") {
                document.getElementById('IdOrangtua_error').innerHTML = "Nama Ibu harus diisi";
            }

            if (nikAnak != "" && namaAnak != "" && umur != "" && IdOrangtua != "") {
                $('#quickForm').submit();
            }
        }

        // Ubah Data
        function validateUpdateForm(itemId) {
            var nikAnak = document.forms["updateForm-" + itemId]["nik_anak"].value;
            var namaAnak = document.forms["updateForm-" + itemId]["nama_anak"].value;
            var umur = document.forms["updateForm-" + itemId]["umur"].value;

            document.getElementById('nik_anak_error_' + itemId).innerHTML = "";
            document.getElementById('nama_anak_error_' + itemId).innerHTML = "";
            document.getElementById('umur_error_' + itemId).innerHTML = "";

            if (nikAnak == "") {
                document.getElementById('nik_anak_error_' + itemId).innerHTML = "NIK Anak harus diisi";
            }
            if (namaAnak == "") {
                document.getElementById('nama_anak_error_' + itemId).innerHTML = "Nama Anak harus diisi";
            }
            if (umur == "") {
                document.getElementById('umur_error_' + itemId).innerHTML = "Umur harus diisi";
            }
            if (IdOrangtua == "") {
                document.getElementById('IdOrangtua_error' + itemId).innerHTML = "Nama Ibu harus diisi";
            }

            if (nikAnak != "" && namaAnak != "" && alamat != "" && IdOrangtua != "") {
                $('#updateForm-' + itemId).submit();
            }
        }

        // Hapus Data
        document.addEventListener('DOMContentLoaded', function() {
            $('.delete-btn').on('click', function() {
                var itemId = $(this).data('id');

                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + itemId).submit();
                    }
                });
            });
        });
    </script>
@endsection
