<ul class="_sidebar bg-light" id="_sidebar">
    <li class="">
        <a href="javascript:void(0)" title="Home" class="text-dark text-uppercase" id="search-category" data-id="0">
            <i class="fas fa-bullseye"></i>
            <span>Home</span>
        </a>
    </li>
    @foreach ($category as $c)
        <li class="">
            <a href="javascript:void(0)" title="{{ $c->name }}" class="text-dark text-uppercase"
                id="search-category" data-id="{{ $c->id }}">
                <i class="fas fa-bullseye"></i>
                <span>{{ $c->name }}</span>
            </a>
        </li>
    @endforeach
</ul>
