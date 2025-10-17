@extends('layouts.app')
@section('title', $home['meta']['title'] ?? 'WynajemAut')
@section('content')
<section class="hero p-5 mb-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <h1 class="display-6 fw-bold">{{ $home['meta']['title'] ?? 'WynajemAut' }}</h1>
            <p class="lead">{{ $home['meta']['subtitle'] ?? '' }}</p>
            <a href="{{ route('booking.form') }}" class="btn btn-brand btn-lg">{{ $home['meta']['cta'] ?? 'Rezerwuj' }}</a>
        </div>
        <div class="col-lg-6 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="WynajemAut" class="img-fluid" style="max-height: 200px;">
        </div>

    </div>
    </div>
</section>

<h2 class="h4 mb-3">Nasza flota</h2>
<div class="row g-3">
    @foreach($fleet as $car)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100">
            <img src="{{ $car['image'] ?? '/images/placeholder.jpg' }}" class="card-img-top" alt="{{ $car['name'] ?? 'Auto' }}">
            <div class="card-body">
                <h3 class="h5 card-title mb-1">{{ $car['name'] }}</h3>
                <p class="text-muted small mb-2">{{ $car['seats'] ?? '?' }} miejsc</p>
                <ul class="small mb-0">
                    @foreach($car['features'] ?? [] as $f)<li>{{ $f }}</li>@endforeach
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
