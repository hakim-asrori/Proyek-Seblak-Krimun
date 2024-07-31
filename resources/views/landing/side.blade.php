<ul class="_sidebar bg-light" id="_sidebar">
    @foreach ($category as $c)
        <li class="">
            <a href="javascript:void(0)" title="{{ $c->name }}" class="text-dark" id="search-category"
                data-id="{{ $c->id }}">
                <i class="fas fa-bullseye"></i>
                <span>{{ $c->name }}</span>
            </a>
        </li>
    @endforeach
</ul>
