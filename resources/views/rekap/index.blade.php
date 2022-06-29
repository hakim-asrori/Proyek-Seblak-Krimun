@extends('template.admin')

@section('title', $app_title)

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    <div class="form-group">
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="width:100%">Cari</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
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
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->phone }}</td>
                                <td>{{ $r->address }}</td>
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
