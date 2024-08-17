<div class="modal-header">
    <h5 class="modal-title" id="changePasswordModallLabel">Ubah Password</h5>
    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ url('change-password') }}" method="post" class="needs-validation" novalidate>
    @csrf
    @method('put')
    <div class="modal-body">
        <div class="mb-2">
            <label for="current_password">Password Lama</label>
            <input type="password" class="form-control" name="current_password" id="current_password" autofocus required
                maxlength="100" max="100">
        </div>
        <div class="mb-2">
            <label for="new_password">Password Baru</label>
            <input type="password" class="form-control" name="new_password" id="new_password" required maxlength="100"
                max="100">
        </div>
        <div class="mb-2">
            <label for="confirm_password">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required
                maxlength="100" max="100">
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
