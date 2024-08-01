@extends('template.admin')

@section('title', $app_title)

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalKeseluruhan = 0;
                        @endphp
                        @foreach ($rekap as $r)
                            @php
                                $totalKeseluruhan += $r->total;
                            @endphp
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $r->user->name }}</td>
                                <td>{{ $r->user->phone }}</td>
                                <td>{{ $r->user->address }}</td>
                                <td>Rp. {{ number_format($r->total, 0, '', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total</th>
                            <th>Rp. {{ number_format($totalKeseluruhan, 0, '', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('css-content')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('script-content')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#dataTable").DataTable({
                // scrollX: true
            })
        })
    </script>
@endsection
