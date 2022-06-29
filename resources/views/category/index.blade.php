@extends('template.admin')

@section('title', $app_title)

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
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
        <div class="col-md-4">
            <div class="card mb-4" id="tambah-category">
                <div class="card-header">
                    Tambah Kategori
                </div>
                <form action="{{ url('category') }}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button type="reset" class="btn btn-secondary btn-icon-split btn-sm">
                            <span class="text">Reset</span>
                            <span class="icon text-white-50">
                                <i class="fas fa-redo"></i>
                            </span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="text">Tambah</span>
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card mb-4" id="edit-category">
                <div class="card-header">
                    Edit Kategori
                </div>
                <form action="" method="post" id="form-edit">
                    <div class="card-body">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="hidden" name="id" id="id" class="form-control">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button type="reset" class="btn btn-danger btn-icon-split btn-sm btn-batal">
                            <span class="text">Batal</span>
                            <span class="icon text-white-50">
                                <i class="fas fa-times"></i>
                            </span>
                        </button>
                        <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                            <span class="text">Simpan</span>
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Daftar Kategori
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $c->name }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-icon-split btn-sm"
                                                data-id="{{ $c->id }}" data-name="{{ $c->name }}" id="btn-edit">
                                                <span class="text">Edit</span>
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                            </button>
                                            <button class="btn btn-danger btn-icon-split btn-sm btn-delete"
                                                data-id="{{ $c->id }}">
                                                <span class="text">Hapus</span>
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal-content')

@endsection

@section('script-content')
    <script>
        function editCategory(params) {
            $.ajax({
                url: '{{ url('category') }}/' + params,
                type: 'get',
                success: function(response) {
                    $("#form-edit").html(response);
                }
            })
        }

        $(document).ready(function() {
            $('#edit-category').hide();

            $('body').on('click', '#btn-edit', function() {
                $('#edit-category').show();
                $('#tambah-category').hide();

                $('#form-edit').attr('action', '{{ url('category') }}/' + $(this).data('id'));

                $('#id').val($(this).data('id'));
                $('#name').val($(this).data('name'));
            });

            $(".btn-batal").click(function() {
                $('#edit-category').hide();
                $('#tambah-category').show();
            })

            $(".btn-delete").click(function() {
                let data = $(this).data('id');

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
                            url: '{{ url('category') }}/' + data,
                            type: 'post',
                            data: {
                                _method: 'delete'
                            },
                            success: function(response) {
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
