<?php

namespace App\Http\Controllers;

class ThemeController extends Controller
{
    public function toggle()
    {
        $current = request()->cookie('theme', 'light');
        $next = $current === 'dark' ? 'light' : 'dark';
        return back()->cookie('theme', $next, 60*24*365);
    }
}
