<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function form()
    {
        return view('site.booking');
    }

    public function send(Request $r)
    {
        $data = $r->validate(array(
            'name'        => array('required','string','max:100'),
            'phone'       => array('required','string','max:30'),
            'email'       => array('required','email'),
            'pickup'      => array('required','string','max:200'),
            'dropoff'     => array('required','string','max:200'),
            'date'        => array('required','date'),
            'time'        => array('required'),
            'passengers'  => array('required','integer','min:1','max:20'),
            'luggage'     => array('nullable','integer','min:0','max:20'),
            'vip'         => array('nullable','boolean'),
            'child_seat'  => array('nullable','boolean'),
            'notes'       => array('nullable','string','max:2000'),
            'privacy'     => array('accepted'),
            'website'     => array('nullable','size:0'),
        ), array(
            'privacy.accepted' => 'Zgoda na przetwarzanie danych jest wymagana.',
        ));

        $payload = array_merge($data, array('ip'=>$r->ip(), 'ts'=>date('c')));
        $path = 'bookings/'.date('Y-m').'.log';
        Storage::append($path, json_encode($payload, JSON_UNESCAPED_UNICODE));

        try {
            Mail::raw("Rezerwacja:\n".print_r($payload,true), function($m) {
                $m->to(config('mail.from.address'))->subject('Nowa rezerwacja przejazdu');
            });
        } catch (\Exception $e) {
            // Brak konfiguracji maila - ignorujemy w dev
        }

        return redirect()->route('booking.form')
            ->with('ok','Dziękujemy! Potwierdzimy rezerwację telefonicznie.');
    }
}
