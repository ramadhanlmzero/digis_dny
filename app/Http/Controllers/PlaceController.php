<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Str;
use Alert;
use Mapper;
use App\Model\Place;
use App\Model\Distributor;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::orderBy('updated_at', 'DESC')->get();
        return view('place.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Mapper::location('Jawa Timur')->map(
        [
            'zoom' => 8, 
            'center' => true, 
            'marker' => false
        ]);
        Mapper::marker(-7.2754438, 112.6426426, 
        [
            'draggable' => true, 
            'eventDrag' => 'document.getElementById("lat").value = event.latLng.lat();document.getElementById("long").value = event.latLng.lng();'
        ]);
        return view('place.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'city' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!'
        ];

        $this->validate($request, $rules, $rulesMessages);

        $data = [
            'id' => (string) Str::uuid(),
            'city' => $request->city,
            'coordinate' => new Point($request->lat, $request->long)
        ];
        Place::create($data);

        Alert::success('Data berhasil disimpan!', 'Sukses');
        return redirect()->route('place.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::find($id);
        $distributor = Distributor::where('place_id', $place->id)->first();
        Mapper::map($place->coordinate->getLat(), $place->coordinate->getLng(),
        [
            'zoom' => 8, 
            'center' => true, 
            'marker' => false
        ]);
        Mapper::marker($place->coordinate->getLat(), $place->coordinate->getLng());
        return view('place.show', compact('place', 'distributor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);
        Mapper::map($place->coordinate->getLat(), $place->coordinate->getLng(),
        [
            'zoom' => 8,
            'center' => true,
            'marker' => false
        ]
        );
        Mapper::marker(
            -7.2754438,
            112.6426426,
            [
                'draggable' => true,
                'eventDrag' => 'document.getElementById("lat").value = event.latLng.lat();document.getElementById("long").value = event.latLng.lng();'
            ]
        );
        return view('place.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'city' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!'
        ];

        $this->validate($request, $rules, $rulesMessages);

        $place = Place::find($id);

        $data = [
            'city' => $request->city,
            'coordinate' => new Point($request->lat, $request->long)
        ];
        $place->update($data);

        Alert::success('Data berhasil diubah!', 'Sukses');
        return redirect()->route('place.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::find($id);
        $place->delete();

        Alert::success('Data berhasil dihapus!', 'Sukses');
        return redirect()->route('place.index');
    }
}
