@extends('layouts.app')
@section('title','FAQ')
@section('content')
<h1 class="h3 mb-3">Najczęstsze pytania</h1>
<div class="accordion" id="faq">
    @foreach($faq as $i=>$row)
    <div class="accordion-item">
        <h2 class="accordion-header" id="h{{ $i }}">
            <button class="accordion-button {{ $i? 'collapsed':'' }}" type="button" data-bs-toggle="collapse" data-bs-target="#c{{ $i }}">
                {{ $row['q'] }}
            </button>
        </h2>
        <div id="c{{ $i }}" class="accordion-collapse collapse {{ $i? '':'show' }}" data-bs-parent="#faq">
            <div class="accordion-body">{{ $row['a'] }}</div>
        </div>
    </div>
    @endforeach
</div>
@endsection
