<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <div class="navbar-name">
            <button id="btn-toggle" class="navbar-toggle text-danger"><i class="fas fa-fw fa-bars"
                    style="font-size: 1.4em"></i></button>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-danger position-relative" id="cart-icon">
                <i class="fas fa-cart-arrow-down"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    id="count-order">0
                </span>
            </button>
            <div id="users" class="dropdown">
                <a href="javascript:void()" class="btn btn-outline-danger dropdown-toggle" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('profile') }}" data-toggle="modal"
                            data-target="#profileModal">Profil Saya</a></li>
                    <li><a class="dropdown-item" href="{{ url('change-password') }}" data-toggle="modal"
                            data-target="#changePasswordModal">Ubah
                            Password</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#" id="logoutBtn"><i class="fas fa-sign-out-alt"></i>
                            Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
