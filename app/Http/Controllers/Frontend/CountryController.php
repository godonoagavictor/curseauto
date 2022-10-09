<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function countries()
    {
        $countries = Country::where('status', true)->orderBy('sort_order')->whereHas('itineraries')->with('itineraries')->get();
        return view('frontend.countries', compact('countries'));
    }
}
