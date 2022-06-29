<div class="row">
    @foreach ($product as $p)
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-2 mb-3">
            <div class="card">
                <img src="{{ url('storage/' . $p->image) }}" height="100" class="card-img-top">
                <div class="card-body p-2">
                    <p class="card-title product-title mb-0 text-uppercase"><strong>{{ $p->name }}</strong></p>
                    <p class="card-text mb-1">Rp. {{ number_format($p->price, 0, '', '.') }}</p>
                    <button class="btn btn-danger" style="width: 100%"
                        onclick="addItemToCart({{ $p->id }}, '{{ $p->name }}', '{{ $p->price }}', '{{ url('storage/' . $p->image) }}')"><i
                            class="fas fa-cart-plus"></i></button>
                </div>
            </div>
        </div>
    @endforeach
</div>
