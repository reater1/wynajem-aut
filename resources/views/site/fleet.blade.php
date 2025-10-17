@extends('layouts.app')
@section('title','Flota')
@section('content')
<h1 class="h3 mb-4">Flota</h1>
<div class="row g-3">
    @foreach($fleet as $car)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100">
            <img src="{{ $car['image'] ?? '/images/placeholder.jpg' }}" class="card-img-top" alt="{{ $car['name'] ?? 'Auto' }}">
            <div class="card-body">
                <h2 class="h5 card-title">{{ $car['name'] }}</h2>
                <p class="text-muted small">{{ $car['seats'] ?? '?' }} miejsc</p>
                <ul class="small mb-0">
                    @foreach(($car['features'] ?? []) as $f)<li>{{ $f }}</li>@endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
