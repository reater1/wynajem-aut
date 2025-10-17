<?php

namespace App\Http\Controllers;

use App\Support\ContentStore;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /** @var ContentStore */
    private $content;

    public function __construct(ContentStore $content)
    {
        $this->content = $content;
    }

    public function home()
    {
        $home = $this->content->pageMarkdown('home');
        $fleet = $this->content->fleet();
        return view('site.home', array('home' => $home, 'fleet' => $fleet));
    }

    public function services()
    {
        $page = $this->content->pageMarkdown('services');
        return view('site.page', $page);
    }

    public function fleet()
    {
        $fleet = $this->content->fleet();
        return view('site.fleet', array('fleet' => $fleet));
    }

    public function pricing(Request $r)
    {
        $pricing = $this->content->yaml('pages/pricing.yml');

        $quote = null;
        $km = null;
        $time = null;
        $chosenExtras = array();

        if ($r->has('km')) {
            $validated = $r->validate(array(
                'km' => array('required','numeric','min:0'),
                'time' => array('required','date_format:H:i'),
                'extras' => array('array'),
                'extras.*' => array('string'),
            ));

            $km = (float) $validated['km'];
            $time = $validated['time'];
            $extras = isset($validated['extras']) ? $validated['extras'] : array();

            $base  = (float) (isset($pricing['base_fee']) ? $pricing['base_fee'] : 0);
            $perKm = (float) (isset($pricing['per_km']) ? $pricing['per_km'] : 0);
            $night = (float) (isset($pricing['night_multiplier']) ? $pricing['night_multiplier'] : 1);

            $hh = (int) explode(':', $time)[0];
            $isNight = ($hh >= 22 || $hh < 6);

            $total = $base + $km * $perKm;
            if ($isNight) $total *= $night;

            $chosenExtras = array_values($extras);
            foreach ($chosenExtras as $k) {
                if (isset($pricing['extras'][$k])) {
                    $total += (float) $pricing['extras'][$k];
                }
            }

            $quote = round($total, 2);
        }

        return view('site.pricing', compact('pricing','quote','km','time','chosenExtras'));
    }

    public function faq()
    {
        $faq = $this->content->yaml('pages/faq.yml');
        return view('site.faq', compact('faq'));
    }

    public function contact()
    {
        return view('site.contact');
    }
}
