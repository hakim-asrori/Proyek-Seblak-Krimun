@extends('template.admin')

@section('title', $app_title)

@section('content')

    <style>
        @media (max-width: 576px) {
            .col-xs-2 {
                width: 50%;
            }
        }

        @media (max-width: 300px) {
            .col-xs-2 {
                width: 100%;
            }
        }
    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    </div>

    <div id="cetak" style="display: none"></div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Tgl Masuk</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Total Pembayaran</th>
                            <th>Produk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer as $c)
                            <tr>
                                <th>{{ date('d F Y', strtotime($c->created_at)) }}</th>
                                <td>
                                    {{ $c->user->name }} <br>
                                    <a href="https://api.whatsapp.com/send?phone={{ $c->user->phone }}&text=" target="_blank"
                                        rel="noopener noreferrer" class="btn btn-sm btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fab fa-whatsapp"></i>
                                        </span>
                                        <span class="text">{{ $c->user->phone }}</span>
                                    </a>
                                </td>
                                <td>{{ $c->user->address }}</td>
                                <td>Rp {{ number_format($c->total, 0, '', '.') }}</td>
                                <td>
                                    <ul>
                                        @foreach ($c->purchase as $p)
                                            <li>{{ $p->food->name }}: {{ $p->quantity }} x Rp
                                                {{ number_format($p->food->price, 0, '', '.') }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <select name="" id="changeStatus" class="form-control"
                                        data-id="{{ $c->id }}">
                                        <option value="" selected disabled>{{ $c->status == 1 ? 'Dipesan' : '' }}
                                        </option>
                                        <option value="2" @selected($c->status == 2)>Dikemas</option>
                                        <option value="3" @selected($c->status == 3)>Dikirim</option>
                                        <option value="4" @selected($c->status == 4)>Diterima</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
                scrollX: true
            })

            $("body").on("change", "#changeStatus", function() {
                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Data akan diubah statusnya!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('order') }}/" + $(this).data('id'),
                            type: "post",
                            data: {
                                status: $(this).val()
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Selamat",
                                    text: "Data berhasil diperbaharui.",
                                    icon: "success"
                                }).then((result) => {
                                    window.location.reload()
                                });
                            },
                            error: function(error) {
                                Swal.fire({
                                    title: "Ooops!",
                                    text: "Gagal ubah status.",
                                    icon: "error"
                                });
                            }
                        })
                    }
                });
            })
        })
    </script>
@endsection
