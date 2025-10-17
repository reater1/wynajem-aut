@extends('layouts.app')
@section('title','Cennik')
@section('content')
<h1 class="h3 mb-3">Cennik</h1>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card"><div class="card-body">
                <h2 class="h5">Stawki</h2>
                <ul class="mb-3">
                    <li>Opłata startowa: <strong>{{ $pricing['base_fee'] }} {{ $pricing['currency'] }}</strong></li>
                    <li>Za km: <strong>{{ $pricing['per_km'] }} {{ $pricing['currency'] }}</strong></li>
                    <li>Noc (22:00–06:00): ×{{ $pricing['night_multiplier'] }}</li>
                </ul>
                <h3 class="h6">Dodatki</h3>
                <ul class="mb-0">
                    @foreach(($pricing['extras'] ?? []) as $k=>$v)
                    <li>{{ str_replace('_',' ',$k) }}: {{ $v }} {{ $pricing['currency'] }}</li>
                    @endforeach
                </ul>
            </div></div>
    </div>

    <div class="col-lg-6">
        <div class="card"><div class="card-body">
                <h2 class="h5">Kalkulator (PHP)</h2>
                <form class="row g-2" method="get" action="{{ route('pricing') }}">
                    <div class="col-6">
                        <label class="form-label">Dystans (km)</label>
                        <input type="number" step="0.1" class="form-control" name="km" value="{{ old('km',$km ?? 10) }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Godzina</label>
                        <input type="time" class="form-control" name="time" value="{{ old('time',$time ?? '12:00') }}">
                    </div>
                    @foreach(($pricing['extras'] ?? []) as $k=>$v)
                    @php $checked = in_array($k, $chosenExtras ?? []); @endphp
                    <div class="col-6 form-check ms-2">
                        <input class="form-check-input" type="checkbox" name="extras[]" id="x_{{ $k }}" value="{{ $k }}" {{ $checked ? 'checked' : '' }}>
                        <label class="form-check-label" for="x_{{ $k }}">{{ str_replace('_',' ',$k) }} (+{{ $v }} {{ $pricing['currency'] }})</label>
                    </div>
                    @endforeach
                    <div class="col-12"><button class="btn btn-brand">Przelicz</button></div>
                </form>
                <hr>
                <div>Szacunkowo:
                    <strong>
                        @if(!is_null($quote))
                        {{ number_format($quote,2,'.',' ') }} {{ $pricing['currency'] }}
                        @else
                        {{ $pricing['base_fee'] }} {{ $pricing['currency'] }}
                        @endif
                    </strong>
                </div>
            </div></div>
    </div>
</div>
@endsection
