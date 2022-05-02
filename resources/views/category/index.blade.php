@extends('template.admin')

@section('title', $app_title)

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#kategoriModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori
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

<div class="row mt-4">
    @foreach ($category as $c)
    <div class="col-lg-2">
        <div class="card">
            <img src="{{ url('storage/'.$c->image) }}" height="100" class="card-img-top" alt="{{ $c->name }}">
            <div class="card-body">
                <p class="card-title">{{ $c->name }}</p>
                <a href="#" class="btn btn-warning" onclick="editCategory({{ $c->id }})" data-toggle="modal" data-target="#kategoriEditModal"><i class="fas fa-edit"></i></a>
                <button class="btn btn-danger btn-delete" data-id="{{ $c->id }}"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@section('modal-content')
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('category') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-control">
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
                <h5 class="modal-title" id="kategoriEditModalLabel">Edit Kategori</h5>
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
    function editCategory(params) {
        $.ajax({
            url: '{{ url("category") }}/'+params,
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
                        url: '{{ url("category") }}/' + data,
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

</script>
@endsection
