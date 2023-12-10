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
                <a class="btn btn-success" href="/Data-Anak/create"> Create </a>
            </div>
        </div>
    </div>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">No</th>
                <th class="col-sm-2">NIK</th>
                <th class="col-sm-2">Nama</th>
                <th class="col-sm-2">Nama Ibu</th>
                <th class="col-sm-1">Berat Badan</th>
                <th class="col-sm-1">Tinggi Badan</th>
                <th class="col-sm-1">Berat Ideal</th>
                <th class="col-sm-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_anak as $data_anak => $item)
                <tr>
                    <td>{{ $data_anak + 1 }}</td>
                    <td>{{ $item->nik_anak }}</td>
                    <td>{{ $item->nama_anak }}</td>
                    <td>{{ $item->nama_ibu }}</td>
                    <td>{{ $item->berat_badan }}</td>
                    <td>{{ $item->tinggi_badan }}</td>
                    <td>{{ $item->bmi }}</td>
                    <td>
                        <form action="/Data-Anak/{{ $item->id }}" method="POST">
                            <a href="/Data-Anak/{{ $item->id }}/update" type="button" class="btn btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
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
                <h1>Data is Empty</h1>
            @endforelse
        </tbody>
    </table>
@endsection
