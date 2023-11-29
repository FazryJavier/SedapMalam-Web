@extends('Admin.Layouts.master')

@section('title')
    Halaman Timbang Anak
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
                <a class="btn btn-success" href="/Timbang-Anak/create"> Create </a>
            </div>
        </div>
    </div>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-2">No</th>
                <th class="col-sm-3">Nama Anak</th>
                <th class="col-sm-3">Nama Orangtua</th>
                <th class="col-sm-1">Tinggi Badan</th>
                <th class="col-sm-1">Berat Badan</th>
                <th class="col-sm-2">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @forelse ($product as $product => $item) --}}
                <tr>
                    {{-- <td>{{ $product + 1 }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->subTitle }}</td>
                    <td>{{ $item->description }}</td>
                    <td><img src="{{ asset('storage/' . $item->image) }}" alt="Image" class="img-fluid mt-3"></td>
                    <td>
                        <form action="/Product/{{ $item->id }}" method="POST">
                            @if (Auth::user()->level == 'Admin')
                                <a href="/Product/{{ $item->id }}/update" type="button" class="btn btn-warning"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            @endif
                            @if (Auth::user()->level == 'Editor')
                                <a href="/Product/{{ $item->id }}/update" type="button" class="btn btn-warning"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            @endif
                            @csrf
                            @method('delete')
                            @if (Auth::user()->level == 'Admin')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure want to delete this data?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            @endif
                        </form>
                    </td> --}}
                </tr>
            {{-- @empty
                <h1>Data is Empty</h1>
            @endforelse --}}
        </tbody>
    </table>
@endsection
