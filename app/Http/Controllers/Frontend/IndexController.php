<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Itinerary;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->orderBy('sort_order')->get();
        $features = Feature::where('status', true)->orderBy('sort_order')->get();
        $itineraries = Itinerary::where('status', true)->orderBy('sort_order')->get();
        return view('frontend.homepage', compact('sliders', 'features', 'itineraries'));
    }
}
