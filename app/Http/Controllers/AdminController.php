<?php

namespace App\Http\Controllers;

use App\Models\Features;
use App\Models\Property;

class AdminController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
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
            'count' => [
                'total_place' => Features::all()->count(),
                'official' => Property::whereStatusResmi('Resmi')->count(),
                'unofficial' => Property::whereStatusResmi('Tidak Resmi')->count()
            ]
        ];

        return view('admin/home', $data);
    }

    public function list_place()
    {
        $data = [
            'title' => 'List Of Place',
            'list' => Features::paginate(10)
        ];

        return view('admin/list_place', $data);
    }

    public function maps()
    {
        $data = [
            'title' => 'Maps',
            'geojson' => [
                'type' => 'FeatureCollection',
                'crs' => [
                    'type' => 'name',
                    'properties' => [
                        'name' => 'ESPG:4326'
                    ]
                ],
                'features' => Features::with(['geometry', 'property'])->get()->toArray()
            ]
        ];

        return view('admin.maps', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Data',
            'feature' => Features::find($id)
        ];

        return view('admin.detail_place', $data);
    }

}
