checkDatabase();
var baseUrl = $("#base-url").data("url");
var cartStorage;
var total;
var level;
var cart = JSON.parse(localStorage.getItem("cart"));
if (cart == null) {
    cart = [];
    localStorage.setItem("cart", JSON.stringify(cart));
}
var totalCount = JSON.parse(localStorage.getItem("totalCount"));
if (totalCount == null) {
    totalCount = 0;
    localStorage.setItem("totalCount", JSON.stringify(totalCount));
}
var countOrder = JSON.parse(localStorage.getItem("countOrder"));
if (countOrder == null) {
    countOrder = 0;
    localStorage.setItem("countOrder", JSON.stringify(countOrder));
}
var levelSpicy = JSON.parse(localStorage.getItem("levelSpicy"));
if (levelSpicy == null) {
    levelSpicy = 0;
    localStorage.setItem("levelSpicy", JSON.stringify(levelSpicy));
}

readyFood();
cartPrint();

function checkDatabase() {
    var cartLocalStorage = JSON.parse(localStorage.getItem("cart"));

    var levelPedas = JSON.parse(localStorage.getItem("levelSpicy"));
    level = levelPedas;
    total = 0;
    cartStorage = cartLocalStorage;
    if (cartLocalStorage != null) {
        for (let i = 0; i < cartLocalStorage.length; i++) {
            total += cartLocalStorage[i].price * cartLocalStorage[i].quantity;
        }
    }
}

function searchFood() {
    let food = $("#search-food").val().trim();

    $.ajax({
        url: baseUrl + "api/food/search",
        type: "POST",
        data: { term: food },
        success: function (response) {
            $("#carouselExampleIndicators").css("display", "none");
            $("#food-data").empty();
            $("#food-data").html(response);
        },
    });
}

function readyFood() {
    $.ajax({
        url: `${baseUrl}api/food/all`,
        type: "get",
        success: function (response) {
            $("#food-data").html(response);
        },
    });
}

function addItemToCart(foodId, title, price, productImg) {
    Toastify({
        position: "center",
        text: `${title} berhasil disimpan!`,
        duration: 1000,
    }).showToast();

    let cartStorage = JSON.parse(localStorage.getItem("cart"));
    let checkCart = 0;
    let quantity = 1;

    $(".btn-order").prop("disabled", false);
    $(".services input").each((index, elm) => {
        $(elm).prop("disabled", false);
    });

    if (cartStorage.length > 0) {
        for (let i = 0; i < cartStorage.length; i++) {
            if (foodId == cartStorage[i].foodId) {
                cartStorage[i].quantity++;
                localStorage.setItem("cart", JSON.stringify(cartStorage));
                document.getElementsByClassName("cart-content")[0].innerHTML =
                    "";
                cartPrint();
                checkCart = 1;
                break;
            } else {
                checkCart = 0;
            }
        }
    } else {
        $(".cart").addClass("active");
        checkCart = 0;
    }

    if (checkCart == 0) {
        let addToCart = {
            foodId,
            title,
            price,
            productImg,
            quantity,
        };
        cartStorage.push(addToCart);
        localStorage.setItem("cart", JSON.stringify(cartStorage));
        document.getElementsByClassName("cart-content")[0].innerHTML = "";
        cartPrint();
    }
}

function cartPrint() {
    let cartShopBox = document.getElementsByClassName("cart-content")[0];
    var countOrder = 0;
    var totalPrinf = 0;
    let cartStorage = JSON.parse(localStorage.getItem("cart"));
    if (cartStorage.length < 1) {
        $(".btn-order").prop("disabled", true);
        $(".services input").each((index, elm) => {
            $(elm).prop("disabled", true);
        });
    }

    cartStorage.forEach((store) => {
        countOrder++;
        let cartBoxContent = `
            <div class="cart-box">
                <img src="${store.productImg}" alt="" class="cart-img">
                <div class="detail-box">
                    <div class="cart-product-title">${store.title}</div>
                    <div class="cart-price">${formatRupiah(
                        store.price,
                        "Rp. "
                    )}</div>
                    <div class="cart-quantity d-flex">
                        <button class="btn btn-sm btn-warning text-white" onclick="downQuantity(${
                            store.foodId
                        })"><i class="fas fa-minus"></i></button>
                        <input type="text" class="form-control cart-quantity" readonly style="width: 35px; padding-left: 5px" value="${
                            store.quantity
                        }">
                        <button class="btn btn-sm btn-success text-white" onclick="upQuantity(${
                            store.foodId
                        })"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <i class="fas fa-trash fa-fw fa-1x cart-remove text-danger" onclick="cartDelete(${
                    store.foodId
                })"></i>
            </div>
            `;
        totalPrinf += store.price * store.quantity;
        cartShopBox.innerHTML += cartBoxContent;
    });
    localStorage.setItem("totalCount", JSON.stringify(totalPrinf));
    localStorage.setItem("countOrder", JSON.stringify(countOrder));
    document.getElementById("count-order").innerText = countOrder;
    document.getElementsByClassName("total-price")[0].innerText = formatRupiah(
        totalPrinf,
        "Rp. "
    );
}

function cartDelete(foodId) {
    Toastify({
        position: "center",
        text: `Produk berhasil dihapus!`,
        duration: 1000,
    }).showToast();

    let cartStorage = JSON.parse(localStorage.getItem("cart"));
    for (let i = 0; i < cartStorage.length; i++) {
        if (foodId == cartStorage[i].foodId) {
            cartStorage.splice(i, 1);
            localStorage.setItem("cart", JSON.stringify(cartStorage));
            document.getElementsByClassName("cart-content")[0].innerHTML = "";
            cartPrint();
            break;
        }
    }
}

function upQuantity(foodId) {
    let cartStorage = JSON.parse(localStorage.getItem("cart"));
    for (let i = 0; i < cartStorage.length; i++) {
        if (foodId == cartStorage[i].foodId) {
            cartStorage[i].quantity++;
            localStorage.setItem("cart", JSON.stringify(cartStorage));
            document.getElementsByClassName("cart-content")[0].innerHTML = "";
            cartPrint();
            break;
        }
    }
}

function downQuantity(foodId) {
    let cartStorage = JSON.parse(localStorage.getItem("cart"));
    for (let i = 0; i < cartStorage.length; i++) {
        if (foodId == cartStorage[i].foodId) {
            cartStorage[i].quantity--;
            if (cartStorage[i].quantity > 0) {
                localStorage.setItem("cart", JSON.stringify(cartStorage));
                document.getElementsByClassName("cart-content")[0].innerHTML =
                    "";
                cartPrint();
            } else {
                cartDelete(cartStorage[i].foodId);
            }
            break;
        }
    }
}

function formatRupiah(angka, prefix) {
    let number_string = angka.toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            Authorization: "Bearer " + localStorage.getItem("xAuth"),
        },
    });

    $("body").on("click", "#search-category", function () {
        let categoryId = $(this).data("id");

        if (categoryId == 0) {
            $("#titlePage").text("E-Klontong");
            $.ajax({
                url: `${baseUrl}api/food/all`,
                type: "get",
                success: function (response) {
                    $("#carouselExampleIndicators").css("display", "block");
                    $("#food-data").html(response);
                },
            });
            return;
        }

        $("#titlePage").text($(this).attr("title"));
        $.ajax({
            url: baseUrl + "api/category/search",
            type: "POST",
            data: { term: categoryId },
            success: function (response) {
                $("#carouselExampleIndicators").css("display", "none");
                $("#food-data").empty();
                $("#food-data").html(response);
            },
        });
        return;
    });

    $("#kirim-data").click(function () {
        checkDatabase();
        let data = {
            service: $("[name='service']").val(),
            cart: cartStorage,
            totalCount: total,
            levelSpicy: level,
        };

        $.ajax({
            url: baseUrl + "api/checkout",
            type: "post",
            data: data,
            success: function (response) {
                console.log(response);
                if (response.ResponseCode == 201) {
                    document.getElementsByClassName(
                        "total-price"
                    )[0].innerText = "Rp. 0";
                    document.getElementsByClassName(
                        "cart-content"
                    )[0].innerHTML = "";
                    cart = [];
                    localStorage.setItem("cart", JSON.stringify(cart));
                    totalCount = 0;
                    localStorage.setItem(
                        "totalCount",
                        JSON.stringify(totalCount)
                    );
                    countOrder = 0;
                    localStorage.setItem(
                        "countOrder",
                        JSON.stringify(countOrder)
                    );
                    document.getElementById("count-order").innerText = 0;
                    $(".cart").removeClass("active");
                    $("#buyModal").modal("hide");
                    $("#carouselExampleIndicators").css("display", "block");
                    let timerInterval;
                    Swal.fire({
                        imageUrl: baseUrl + "assets/img/terima-kasih.png",
                        imageWidth: 400,
                        imageHeight: 200,
                        text: "Terima kasih sudah memesan. Harap Tunggu!",
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        },
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.open(response.Data, "blank");
                        }
                    });
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
            error: function (error) {
                Toastify({
                    position: "center",
                    text: `Gagal, Kirim data.`,
                    duration: 1000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
                return;
            },
        });
    });

    $("body").on("click", "#cart-icon", function () {
        $(".cart").addClass("active");
    });

    $("body").on("click", "#close-cart", function () {
        $(".cart").removeClass("active");
    });

    $(".btn-order").on("click", function () {
        if ($(".cart-content .cart-box").length < 1) {
            Toastify({
                position: "center",
                text: `Harap pilih produk terlebih dahulu!`,
                duration: 1000,
                style: {
                    background: "#dc3545",
                },
            }).showToast();
            return;
        }

        if (!$("[name='service']").is(":checked")) {
            Toastify({
                position: "center",
                text: `Harap pilih layanan terlebih dahulu!`,
                duration: 1000,
                style: {
                    background: "#dc3545",
                },
            }).showToast();
            return;
        }

        if (localStorage.getItem("xAuth") != null) {
            $("#buyModal").modal("show");
        } else {
            $("#signInModal").modal("show");
        }
    });

    $(".btn-register").on("click", function (e) {
        e.preventDefault();

        $("#signUpModel").modal("show");

        $("#signInModal").modal("hide");
    });

    $(".btn-login").on("click", function (e) {
        e.preventDefault();

        $("#signUpModel").modal("hide");

        $("#signInModal").modal("show");
    });

    $("body").on("submit", "#signIn", function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            method: "post",
            data: $(this).serialize(),
            success: function (response) {
                if (response.ResponseCode == 200) {
                    Toastify({
                        position: "center",
                        text: `${response.Messages}`,
                        duration: 1000,
                        style: {
                            background: "#28a745",
                        },
                    }).showToast();
                    localStorage.setItem("xAuth", response.Data.x_auth);
                    $("#signInModal").modal("hide");
                    window.location.reload();
                    return;
                }

                Toastify({
                    position: "center",
                    text: `${response.Messages}`,
                    duration: 1000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
                return;
            },
            error: function (error) {
                Toastify({
                    position: "center",
                    text: `Server Internal Error!`,
                    duration: 1000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
                return;
            },
        });
    });

    $("body").on("submit", "#signUp", function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            method: "post",
            data: $(this).serialize(),
            success: function (response) {
                if (response.ResponseCode == 200) {
                    Toastify({
                        position: "center",
                        text: `${response.Messages}`,
                        duration: 1000,
                        style: {
                            background: "#28a745",
                        },
                    }).showToast();
                    $("#signUpModel").modal("hide");
                    $("#signInModal").modal("show");

                    return;
                }

                Toastify({
                    position: "center",
                    text: `${response.Messages}`,
                    duration: 1000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
                return;
            },
            error: function (error) {
                Toastify({
                    position: "center",
                    text: `Server Internal Error!`,
                    duration: 1000,
                    style: {
                        background: "#dc3545",
                    },
                }).showToast();
                return;
            },
        });
    });
});
