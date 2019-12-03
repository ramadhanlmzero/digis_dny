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
        $distributors = Distributor::all();
        Mapper::location('Jawa Timur')->map(
        [
            'zoom' => 8, 
            'center' => true, 
            'marker' => false
        ]);
        return view('place.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'city' => 'required'
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!'
        ];

        $this->validate($request, $rules, $rulesMessages);

        $data = [
            'id' => (string) Str::uuid(),
            'city' => $request->city
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
        $distributors = Distributor::where('place_id', $place->id)->get();
        Mapper::location($place->city)->map(
        [
            'zoom' => 11, 
            'center' => true, 
            'marker' => false
        ]);
        foreach ($distributors as $index => $distributor) {
            $content = "<br>Nama Distributor: " . $distributor->user->name . "<br>Alamat: " . $distributor->address . "<br><br><a href='/dashboard/user/" . $distributor->id . "' class='btn btn-primary px-2 py-1'>Lihat Detail</a>";
            Mapper::informationWindow($distributor->coordinate->getLat(), $distributor->coordinate->getLng(), $content, 
            [ 
                'maxWidth' => 600,
            ]);
        }
        return view('place.show', compact('place', 'distributors'));
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
            'city' => 'required'
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!'
        ];

        $this->validate($request, $rules, $rulesMessages);

        $place = Place::find($id);

        $data = [
            'city' => $request->city
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
