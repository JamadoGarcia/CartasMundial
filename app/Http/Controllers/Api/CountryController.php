<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return response()->json(
            Country::with('stickers')->get()
        );
    }

    public function show($code)
    {
        $country = Country::with('stickers')
            ->where('code', $code)
            ->firstOrFail();

        return response()->json($country);
    }
}