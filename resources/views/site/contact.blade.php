@extends('layouts.app')
@section('title','Kontakt')
@section('content')
<h1 class="h3 mb-3">Kontakt</h1>
<p class="mb-4">Telefon: <strong>+48 600 000 000</strong> • E-mail: <strong>kontakt@wynajemaut.pl</strong></p>
<p class="mb-4">Możesz też od razu przejść do <a href="{{ route('booking.form') }}">rezerwacji przejazdu</a>.</p>
@endsection
