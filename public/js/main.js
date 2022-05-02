checkDatabase();
var baseUrl = $("#base-url").data('url');
var cartStorage;
var total;
var level;
function checkDatabase() {
    var cart = JSON.parse(localStorage.getItem('cart'));
    var levelPedas = JSON.parse(localStorage.getItem('levelSpicy'));
    level=levelPedas;
    total=0;
    cartStorage=cart;
    for(let i = 0; i < cart.length; i++) {
        total += cart[i].price*cart[i].quantity;
    }
}

function searchFood() {
    let food = $("#search-food").val().trim();

    $.ajax({
        url:baseUrl+'api/food/search',
        type:'POST',
        data: {term: food},
        success: function(response){

            $("#carouselExampleIndicators").css('display', 'none')
            $("#food-data").empty();
            $("#food-data").html(response);

        }
    });
}


$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $("body").on('click', '#search-category', function () {
        let categoryId = $(this).data('id');
        $.ajax({
            url:baseUrl+'api/category/search',
            type:'POST',
            data: {term: categoryId},
            success: function(response){
                $("#carouselExampleIndicators").css('display', 'none')
                $("#food-data").empty();
                $("#food-data").html(response);

            }
        });
    })

    $("#kirim-data").click(function () {
        checkDatabase();
        let data = {
            name: $("#name").val(),
            phone: $("#phone").val(),
            address: $("#address").val(),
            cart: cartStorage,
            totalCount: total,
            levelSpicy: level
        };

        $.ajax({
            url: baseUrl + 'api/checkout',
            type: 'post',
            data: data,
            success: function (response) {
                if (response == 1) {
                    document.getElementsByClassName('total-price')[0].innerText = "Rp. 0";
                    document.getElementsByClassName('cart-content')[0].innerHTML = '';
                    cart = [];
                    localStorage.setItem("cart", JSON.stringify(cart));
                    totalCount = 0;
                    localStorage.setItem("totalCount", JSON.stringify(totalCount));
                    countOrder = 0;
                    localStorage.setItem("countOrder", JSON.stringify(countOrder));
                    document.getElementById("count-order").innerText = 0;
                    $(".cart").removeClass('active');
                    $("#buyModal").modal('hide')
                    $("#name").val('');
                    $("#phone").val('');
                    $("#address").val('');
                    $("#level").val('');
                    $("#carouselExampleIndicators").css('display', 'block');
                    let timerInterval
                    Swal.fire({
                        imageUrl: baseUrl + 'assets/img/terima-kasih.png',
                        imageWidth: 400,
                        imageHeight: 200,
                        text: "Terima kasih sudah memesan. Harap Tunggu!",
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                        }
                    })
                }
            }
        })
    })
})
