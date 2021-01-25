<?php

namespace App\Http\Controllers;

use App\Models\Features;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return view('user/home');
    }

    public function showAbout()
    {
        return view('user.about');
    }

    public function showMaps()
    {
        $data = [
            'geojson' => [
                'type' => 'FeatureCollection',
                'crs' => [
                    'type' => 'name',
                    'properties' => [
                        'name' => 'ESPG:4326'
                    ]
                ],
                'features' => Features::with(['geometry', 'property'])->get()->toArray()
            ],
        ];

        return view('user.maps', $data);
    }
}
