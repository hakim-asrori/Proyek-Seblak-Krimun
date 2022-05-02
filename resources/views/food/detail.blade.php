@extends('food.index')

@section('food-content')
<div class="row">
    @foreach ($product as $p)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card">
            <img src="{{ url('storage/'.$p->image) }}" height="100" class="card-img-top" alt="{{ $p->name }}">
            <div class="card-body" style="padding: 1rem .5rem">
                <div class="d-flex align-items-center">
                    <div class="col-lg-8">
                        <p class="card-title">{{ $p->name }}</p>
                        <p class="card-text">{{ $p->price }}</p>
                    </div>
                    <div class="col-lg-4 d-flex flex-column">
                        <a href="#" class="btn btn-warning btn-sm mb-2" onclick="editProduct({{ $p->id }})" data-toggle="modal" data-target="#kategoriEditModal"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete btn-sm" data-id="{{ $p->id }}"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
