@extends('template.admin')

@section('title', $app_title)

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#produkModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk
    </a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-lg-2 mb-3">
        <div class="card">
            <a href="#collapseCardExample" class="card-header text-gray-800" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseCardExample">Kategori</a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        @foreach ($category as $c)
                        <a href="{{ url('food/detail/'.$c->id) }}" class="btn btn-info mb-3">{{ $c->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-10">
        @if (Request::segment(2) == 'detail')
        @yield('food-content')
        @else
        <div class="row">
            @foreach ($product as $p)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <img src="{{ url('storage/'.$p->image) }}" height="100" class="card-img-top" alt="{{ $p->name }}">
                    <div class="card-body" style="padding: 1rem .5rem">
                        <div class="d-flex align-items-center">
                            <div class="col-lg-8">
                                <p class="card-title">{{ $p->name }}</p>
                                <p class="card-text">Rp. {{ number_format($p->price, 0, '', '.') }}</p>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <a href="#" class="btn btn-warning btn-sm mb-2" onclick="editProduct({{ $p->id }})" data-toggle="modal" data-target="#kategoriEditModal"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-delete btn-sm" data-id="{{ $p->id }}"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection

@section('modal-content')
<div class="modal fade" id="produkModal" tabindex="-1" aria-labelledby="produkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produkModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('food') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Makanan</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="text" name="price" id="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($category as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="kategoriEditModal" tabindex="-1" aria-labelledby="kategoriEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriEditModalLabel">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="form-edit"></div>
        </div>
    </div>
</div>
@endsection

@section('script-content')
<script>
    if ($(window).width() < 960) {
        $("#collapseCardExample").removeClass('show')
    } else {
        $("#collapseCardExample").addClass('show')
    }

    function editProduct(params) {
        $.ajax({
            url: '{{ url("food") }}/'+params,
            type: 'get',
            success: function (response) {
                $("#form-edit").html(response);
            }
        })
    }

    $(document).ready(function () {
        $(".btn-delete").click(function () {
            let data = $(this).data('id');
            console.log(data);
            Swal.fire({
                title: 'Apakah anda yakin?',
                icon: 'warning',
                showDenyButton: true,
                confirmButtonText: 'Batal',
                denyButtonText: `Hapus`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('', 'Data tidak jadi dihapus', 'success')
                } else if (result.isDenied) {
                    $.ajax({
                        url: '{{ url("food") }}/' + data,
                        type: 'post',
                        data: {_method: 'delete'},
                        success: function (response) {
                            if (response == 1) {
                                Swal.fire({
                                    title: 'Selamat',
                                    text: 'Data Berhasil Dihapus',
                                    icon: 'success'
                                }).then((result) => {
                                    location.reload()
                                })
                            } else {
                                Swal.fire('Ooops', 'Data Gagal Dihapus', 'error')
                            }
                        }
                    })
                }
            })
        })
    })

    var rupiah = document.getElementById('price');
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

</script>
@endsection
