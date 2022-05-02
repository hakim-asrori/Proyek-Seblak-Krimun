
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEBLAK KRIMUN</title>
    <link rel="stylesheet" href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/user.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <div class="navbar-name">
                <button id="btn-toggle" class="navbar-toggle text-danger"><i class="fas fa-fw fa-bars" style="font-size: 1.4em"></i></button>
            </div>
            <button class="btn btn-danger position-relative" id="cart-icon">
                <i class="fas fa-cart-arrow-down"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="count-order">0
                </span>
            </button>
        </div>
    </nav>
    <div class="cart">
        <h2 class="cart-title">Order You</h2>
        <div class="cart-content">
        </div>
        <hr class="mb-0">
        <div class="d-flex justify-content-end">
            <div class="me-1">Total</div>
            <div class="total-price"></div>
        </div>
        <div class="form-group">
            <label for="level">Level Pedas</label>
            <input type="number" id="level" class="form-control" value="0">
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-danger" style="width: 100%" data-bs-toggle="modal" data-bs-target="#buyModal">Buy Now</button>
        </div>

        <div id="close-cart">
            <i class="fas fa-times fa-1x fa-fw"></i>
        </div>
    </div>

    <div class="wrapper">

        <ul class="_sidebar bg-light" id="_sidebar">
            @foreach ($category as $c)
            <li class="">
                <a href="javascript:void(0)" title="{{ $c->name }}" class="text-dark" id="search-category" data-id="{{ $c->id }}">
                    <i class="fas fa-bullseye"></i>
                    <span>{{ $c->name }}</span>
                </a>
            </li>
            @endforeach
        </ul>

        <div class="content" id="content">
            <div class="container">
                <div id="base-url" data-url="{{ url('') }}/"></div>
                <div class="container">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 text-uppercase">Seblak</h1>
                        <input class="form-control me-2" style="width: 250px" type="search" id="search-food" onkeyup="searchFood()" placeholder="Cari..." aria-label="Search">
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ url('assets/img/banner/1.png') }}" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ url('assets/img/banner/2.png') }}" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ url('assets/img/banner/3.png') }}" class="d-block w-100">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div id="food-data"></div>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel">Masukan Data Diri Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nama Pemesan</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="phone">No Wa</label>
                    <input type="text" class="form-control" name="phone" id="phone">
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-danger" id="kirim-data">Kirim</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('assets') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ url('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="{{ url('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets') }}/js/sb-admin-2.min.js"></script>

<script src="{{ url('/assets/sweetalert2/dist/sweetalert2.all.js') }}"></script>
<script src="{{ url('js/user.js') }}"></script>
<script>
    var cart = JSON.parse(localStorage.getItem('cart'));
    if (cart == null) {
        cart = [];
        localStorage.setItem("cart", JSON.stringify(cart));
    }
    var totalCount = JSON.parse(localStorage.getItem('totalCount'));
    if (totalCount == null) {
        totalCount = 0;
        localStorage.setItem("totalCount", JSON.stringify(totalCount));
    }
    var countOrder = JSON.parse(localStorage.getItem('countOrder'));
    if (countOrder == null) {
        countOrder = 0;
        localStorage.setItem("countOrder", JSON.stringify(countOrder));
    }
    var levelSpicy = JSON.parse(localStorage.getItem('levelSpicy'));
    if (levelSpicy == null) {
        levelSpicy = 0;
        localStorage.setItem("levelSpicy", JSON.stringify(levelSpicy));
    }
    readyFood();
    cartPrint();

    function readyFood() {

        $.ajax({
            url: '{{ url("api/food/all") }}',
            type: 'get',
            success: function (response) {
                $("#food-data").html(response);
            }
        });

    }


    $(document).ready(function () {
        $("body").on('click', '#cart-icon',function () {
            $('.cart').addClass('active');
        })

        $("body").on('click', '#close-cart',function () {
            $('.cart').removeClass('active');
        })

        $("#level").change(function () {
            let value = $(this).val();
            if (value < 0) {
                $(this).val(0);
            }

            localStorage.setItem("levelSpicy", JSON.stringify($(this).val()));
        })
    })

    function addItemToCart(foodId, title, price, productImg) {
        let cartStorage =JSON.parse(localStorage.getItem('cart'));
        let checkCart=0;
        let quantity = 1;
        if(cartStorage.length > 0){
            for(let i = 0; i < cartStorage.length; i++) {
                if (foodId == cartStorage[i].foodId) {
                    cartStorage[i].quantity++;
                    localStorage.setItem("cart", JSON.stringify(cartStorage));
                    document.getElementsByClassName('cart-content')[0].innerHTML = '';
                    cartPrint();
                    checkCart=1;
                    break;
                }else {
                    checkCart=0;
                }
            }
        }else {
            checkCart=0;
        }

        if(checkCart == 0){
            let addToCart = {foodId, title, price, productImg, quantity};
            cartStorage.push(addToCart);
            localStorage.setItem("cart", JSON.stringify(cartStorage));
            document.getElementsByClassName('cart-content')[0].innerHTML = '';
            cartPrint();
        }
    }

    function cartPrint(){
        let cartShopBox = document.getElementsByClassName('cart-content')[0];
        var countOrder = 0;
        var totalPrinf = 0;
        let cartStorage = JSON.parse(localStorage.getItem('cart'));
        cartStorage.forEach(store => {
            countOrder++;
            let cartBoxContent = `
            <div class="cart-box">
                <img src="${store.productImg}" alt="" class="cart-img">
                <div class="detail-box">
                    <div class="cart-product-title">${store.title}</div>
                    <div class="cart-price">${formatRupiah(store.price, 'Rp. ')}</div>
                    <div class="cart-quantity d-flex">
                        <button class="btn btn-sm btn-warning text-white" onclick="downQuantity(${store.foodId})"><i class="fas fa-minus"></i></button>
                        <input type="text" class="form-control cart-quantity" readonly style="width: 35px; padding-left: 5px" value="${store.quantity}">
                        <button class="btn btn-sm btn-success text-white" onclick="upQuantity(${store.foodId})"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <i class="fas fa-trash fa-fw fa-1x cart-remove text-danger" onclick="cartDelete(${store.foodId})"></i>
            </div>
            `;
            totalPrinf += store.price * store.quantity;
            cartShopBox.innerHTML += cartBoxContent;
        });
        localStorage.setItem("totalCount", JSON.stringify(totalPrinf));
        localStorage.setItem("countOrder", JSON.stringify(countOrder));
        document.getElementById("count-order").innerText = countOrder;
        document.getElementsByClassName('total-price')[0].innerText = formatRupiah(totalPrinf, 'Rp. ');
    }

    function cartDelete(foodId){
        let cartStorage = JSON.parse(localStorage.getItem('cart'));
        for(let i = 0; i < cartStorage.length; i++) {
            if (foodId == cartStorage[i].foodId) {
                cartStorage.splice(i, 1);
                localStorage.setItem("cart", JSON.stringify(cartStorage));
                document.getElementsByClassName('cart-content')[0].innerHTML = '';
                cartPrint();
                break;
            }
        }
    }

    function upQuantity(foodId){
        let cartStorage =JSON.parse(localStorage.getItem('cart'));
        for(let i = 0; i < cartStorage.length; i++) {
            if (foodId == cartStorage[i].foodId) {
                cartStorage[i].quantity++;
                localStorage.setItem("cart", JSON.stringify(cartStorage));
                document.getElementsByClassName('cart-content')[0].innerHTML = '';
                cartPrint();
                break;
            }
        }
    }

    function downQuantity(foodId){
        let cartStorage =JSON.parse(localStorage.getItem('cart'));
        for(let i = 0; i < cartStorage.length; i++) {
            if (foodId == cartStorage[i].foodId) {
                cartStorage[i].quantity--;
                if (cartStorage[i].quantity > 0) {
                    localStorage.setItem("cart", JSON.stringify(cartStorage));
                    document.getElementsByClassName('cart-content')[0].innerHTML = '';
                    cartPrint();
                } else {
                    cartDelete(cartStorage[i].foodId);
                }
                break;
            }
        }
    }

    function formatRupiah(angka, prefix){
        let number_string = angka.toString(),
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
<script src="{{ url('js') }}/main.js"></script>
</body>
</html>
