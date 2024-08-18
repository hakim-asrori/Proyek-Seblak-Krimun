<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                    onclick="$('#buyModal').modal('hide')"></button>
            </div>
            <div class="modal-body">
                <p class="m-0 p-0">Silahkan periksa lagi, sebelum Checkout</p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="$('#buyModal').modal('hide')">Kembali</button>
                <button type="button" class="btn btn-danger" id="kirim-data">Checkout</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signInModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                    onclick="$('#signInModal').modal('hide')"></button>
            </div>
            <form action="{{ url('api/sign/in') }}" method="post" id="signIn" novalidate class="needs-validation">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="account">No HP</label>
                        <input type="text" class="form-control" name="account" id="account" autocomplete="account"
                            autofocus required>
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-2">
                        Jika belum punya akun silahkan <a href="" class="btn-register">Sign Up</a>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="$('#signInModal').modal('hide')">Tutup</button>
                    <button type="submit" class="btn btn-danger">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="signUpModel" tabindex="-1" aria-labelledby="signUpModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signUpModelLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                    onclick="$('#signUpModel').modal('hide')"></button>
            </div>
            <form action="{{ url('api/sign/up') }}" method="post" id="signUp" novalidate class="needs-validation">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="name"
                            autofocus required maxlength="100" max="100">
                    </div>
                    <div class="mb-2">
                        <label for="phone">No HP</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                            autocomplete="phone" required maxlength="15" max="15">
                    </div>
                    <div class="mb-2">
                        <label for="address">Alamat Lengkap</label>
                        <input type="text" class="form-control" name="address" id="address"
                            autocomplete="address" required maxlength="150" max="150">
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required
                            maxlength="100" max="100" minlength="8">
                    </div>
                    <div class="mb-2">
                        Jika sudah punya akun silahkan <a href="" class="btn-login">Sign In</a>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="$('#signUpModel').modal('hide')">Tutup</button>
                    <button type="submit" class="btn btn-danger">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>
