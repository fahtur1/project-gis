<?php

namespace App\Http\Controllers;

use App\Models\Features;
use App\Models\Geometry;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{

    public function show()
    {
        $title = 'Create Place';
        return view('admin/create_place', ['title' => $title]);
    }

    public function showUpdate($id)
    {
        $feature = Features::find($id);

        $data = [
            'title' => 'Update Place',
            'list' => $feature
        ];

        return view('admin/update_place', $data);
    }

    public function create(Request $request)
    {
        $file = $request->file('gambar');
        $fileName = uniqid('upload-') . '.' . $file->extension();
        $file->storeAs('places/', $fileName, 'images');

        $property = Property::create([
            'nama_toko' => $request->post('nama_toko'),
            'latitude' => $request->post('latitude'),
            'longitude' => $request->post('longitude'),
            'status_resmi' => $request->post('status_resmi'),
            'alamat' => $request->post('alamat'),
            'gambar' => $fileName
        ]);

        $geometry = Geometry::create([
            'coordinates' => [
                $request->post('longitude'),
                $request->post('latitude')
            ]
        ]);

        $features = Features::create([
            'id_geometry' => $geometry->id_geometry,
            'id_property' => $property->id_property
        ]);

        if ($features) {
            return redirect()->route('list_place')
                ->with('status', 'Data Added Successfully!')
                ->with('class', 'success');
        } else {
            return redirect()->route('list_place')
                ->with('status', 'Failed to add data!')
                ->with('class', 'danger');
        }
    }

    public function update(Request $request)
    {
        $id = $request->post('id_feature');
        $feature = Features::find($id);

        $property = Property::find($feature->id_property);
        $geometry = Geometry::find($feature->id_geometry);

        $gambar = $property->gambar;

        if ($request->file('gambar')) {
            $gambar = $request->file('gambar')->get();
        }

        $property->update([
            'nama_toko' => $request->post('nama_toko'),
            'latitude' => $request->post('latitude'),
            'longitude' => $request->post('longitude'),
            'status_resmi' => $request->post('status_resmi'),
            'alamat' => $request->post('alamat'),
            'gambar' => $gambar
        ]);

    }

    public function uploadJson(Request $request)
    {
        $file = $request->file('json');

        $ext = $file->extension();
        $json = json_decode($file->get(), true);
        $mime = $file->getClientMimeType();

        if ($ext == 'json' && $json && $mime == 'application/json') {
            $status = false;
            foreach ($json['features'] as $item) {
                $properties = $item['properties'];
                $geometries = $item['geometry'];

                $property = Property::create([
                    'nama_toko' => $properties['Nama Toko'],
                    'longitude' => $properties['Longitude'],
                    'latitude' => $properties['Latitude'],
                    'status_resmi' => $properties['Status resmi'],
                    'alamat' => $properties['Alamat'],
                    'gambar' => $properties['Gambar'],
                ]);

                $geometry = Geometry::create([
                    'type' => $geometries['type'],
                    'coordinates' => [
                        $geometries['coordinates'][0],
                        $geometries['coordinates'][1]
                    ]
                ]);

                $features = Features::create([
                    'id_geometry' => $geometry->id_geometry,
                    'id_property' => $property->id_property
                ]);

                if ($features) {
                    $status = true;
                }
            }

            if ($status) {
                return redirect()->back()
                    ->with('status', 'Success to add Data !')
                    ->with('class', 'success');
            }
        } else {
            return redirect()->back()
                ->with('status', 'Please insert JSON file !')
                ->with('class', 'danger');
        }

    }

    public function delete($id)
    {
        $feature = Features::find($id);
        $delete = Storage::disk('images')->delete('places/' . $feature->property->gambar);

        if ($delete) {
            if ($feature->delete()) {
                return redirect()->back()
                    ->with('status', 'Data & File has been deleted!')
                    ->with('class', 'success');
            } else {
                return redirect()->back()
                    ->with('status', 'Failed to delete file!')
                    ->with('class', 'danger');
            }
        } else {
            return redirect()->back()
                ->with('status', 'Failed to delete data!')
                ->with('class', 'danger');
        }
    }

    public function deleteAllData()
    {
        $status = false;

        $features = Features::all();

        foreach ($features as $item) {
            $status = $item->delete();
        }

        if ($status) {
            return redirect()->back()
                ->with('status', 'All Data & File has been deleted!')
                ->with('class', 'success');

        } else {
            return redirect()->back()
                ->with('status', 'Failed to delete data!')
                ->with('class', 'danger');
        }
    }

    public function printToGeoJson()
    {
        $data = [
            'type' => 'FeatureCollection',
            'crs' => [
                'type' => 'name',
                'properties' => [
                    'name' => 'ESPG:4326'
                ]
            ],
            'features' => Features::with(['geometry', 'property'])->get()->toArray()
        ];

        $file = 'export/toko-komputer.json';

        Storage::put($file, json_encode($data));

        return response()->download(storage_path('app/' . $file));
    }

}
