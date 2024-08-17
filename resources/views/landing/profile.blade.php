<div class="modal-header">
    <h5 class="modal-title" id="profileModalLabel">Profil</h5>
    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ url('profile') }}" method="post" class="needs-validation" novalidate>
    @method('put')
    @csrf
    <div class="modal-body">
        <div class="mb-2">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" id="name" autocomplete="name" autofocus
                required maxlength="100" max="100" value="{{ $user->name }}">
        </div>
        <div class="mb-2">
            <label for="phone">No HP</label>
            <input type="number" class="form-control" name="phone" id="phone" autocomplete="phone" required
                maxlength="15" max="15" value="{{ $user->phone }}" inputmode="numeric">
        </div>
        <div class="mb-2">
            <label for="address">Alamat Lengkap</label>
            <input type="text" class="form-control" name="address" id="address" autocomplete="address" required
                maxlength="150" max="150" value="{{ $user->address }}">
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-danger">Simpan</button>
    </div>
</form>

<script>
    $(function() {
        $(".needs-validation").on("submit", function(e) {
            e.preventDefault()

            $.ajax({
                url: $(this).attr("action"),
                type: "post",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.ResponseCode == 200) {
                        $(".btn-cancel").click()
                        Toastify({
                            position: "center",
                            text: `${response.Messages}`,
                            duration: 1000,
                        }).showToast();
                        return;
                    } else {
                        Toastify({
                            position: "center",
                            text: `${response.Messages}`,
                            duration: 1000,
                            style: {
                                background: "#dc3545",
                            },
                        }).showToast();
                        return;
                    }
                },
                error: function(error) {
                    Toastify({
                        position: "center",
                        text: `Gagal, Kirim data.`,
                        duration: 1000,
                        style: {
                            background: "#dc3545",
                        },
                    }).showToast();
                    return;
                }
            })
        })
    })
</script>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
