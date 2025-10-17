@extends('layouts.app')
@section('title','Rezerwacja')
@section('content')
<h1 class="h3 mb-3">Rezerwacja przejazdu</h1>
<form method="post" action="{{ route('booking.send') }}" class="row g-3">
    @csrf
    <div class="col-md-6"><label class="form-label">Imię i nazwisko</label><input class="form-control" name="name" value="{{ old('name') }}"></div>
    <div class="col-md-3"><label class="form-label">Telefon</label><input class="form-control" name="phone" value="{{ old('phone') }}"></div>
    <div class="col-md-3"><label class="form-label">E-mail</label><input type="email" class="form-control" name="email" value="{{ old('email') }}"></div>
    <div class="col-md-6"><label class="form-label">Miejsce startu</label><input class="form-control" name="pickup" value="{{ old('pickup') }}"></div>
    <div class="col-md-6"><label class="form-label">Cel podróży</label><input class="form-control" name="dropoff" value="{{ old('dropoff') }}"></div>
    <div class="col-md-3"><label class="form-label">Data</label><input type="date" class="form-control" name="date" value="{{ old('date') }}"></div>
    <div class="col-md-3"><label class="form-label">Godzina</label><input type="time" class="form-control" name="time" value="{{ old('time') }}"></div>
    <div class="col-md-3"><label class="form-label">Pasażerowie</label><input type="number" min="1" max="20" class="form-control" name="passengers" value="{{ old('passengers',1) }}"></div>
    <div class="col-md-3"><label class="form-label">Bagaże</label><input type="number" min="0" max="20" class="form-control" name="luggage" value="{{ old('luggage',0) }}"></div>
    <div class="col-12 form-check"><input class="form-check-input" type="checkbox" name="vip" value="1" id="vip" {{ old('vip')?'checked':'' }}><label for="vip" class="form-check-label">Pojazd VIP</label></div>
    <div class="col-12 form-check"><input class="form-check-input" type="checkbox" name="child_seat" value="1" id="child" {{ old('child_seat')?'checked':'' }}><label for="child" class="form-check-label">Fotelik dla dziecka</label></div>
    <div class="col-12"><label class="form-label">Uwagi</label><textarea class="form-control" rows="4" name="notes">{{ old('notes') }}</textarea></div>
    <input type="text" name="website" value="" class="d-none" tabindex="-1" autocomplete="off">
    <div class="col-12 form-check">
        <input type="checkbox" class="form-check-input" name="privacy" id="privacy" {{ old('privacy')?'checked':'' }}>
        <label for="privacy" class="form-check-label">Wyrażam zgodę na przetwarzanie danych w celu realizacji rezerwacji.</label>
    </div>
    <div class="col-12"><button class="btn btn-brand">Wyślij rezerwację</button></div>
</form>
@endsection
