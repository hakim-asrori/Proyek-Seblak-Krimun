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

<div class="row">
    @foreach ($customer as $c)
    <div class="col-lg-4 mb-2">
        <div class="card">
            <div class="card-body">
                <table>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td>{{ $c->name }}</td>
                    </tr>
                    <tr>
                        <th>No. WA</th>
                        <td>:</td>
                        <td>{{ $c->phone }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td>{{ $c->address }}</td>
                    </tr>
                    <tr>
                        <th>Total Pembayaran</th>
                        <td>:</td>
                        <td>Rp. {{ number_format($c->total, 0, '', '.') }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <form action="{{ url('order/'.$c->id) }}" method="post">
                    @csrf
                    <button class="btn btn-primary">Selesai</button>
                    <a href="{{ url('faktur/'.$c->id) }}" class="btn btn-info" target="_blank">Cetak Bill</a>
                    <a href="https://api.whatsapp.com/send?phone=6289674614096&text=Pesan dari Seblak Krimun %0A%0ANama Pemesan : {{ $c->name }}%0ANo. WA : {{ $c->phone }}%0AAlamat : {{ $c->address }}%0ATotal Pembayaran : Rp. {{ number_format($c->total, 0, '', '.') }}" class="btn btn-success" target="_blank">Whatsapp</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pesanan <span class="badge bg-success text-white">Pedas Level {{ $c->level }}</span></h5>
                <div class="row">
                    @foreach ($c->purchase as $p)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-2 mb-3">
                        <div class="card">
                            <img src="{{ url('storage/'.$p->food->image) }}" height="100" class="card-img-top">
                            <div class="card-body p-2">
                                <p class="card-title product-title mb-0 text-uppercase"><strong>{{ $p->food->name }}</strong></p>
                                <p class="card-text mb-1">Rp. {{ number_format($p->food->price, 0, '', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
