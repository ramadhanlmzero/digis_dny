<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Alert;
use Mapper;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Model\Distributor;
use App\Model\Place;

class ProfileController extends Controller
{
    public function index($id)
    {
        if (Auth::user()->id == $id || Auth::user()->role == 'Admin') {
            $user = User::find($id);
            $distributor = Distributor::where('user_id', $user->id)->with(['transaction' => function($query) {
                $query->orderBy('created_at', 'DESC');
            }])->first();
            return view('user.show', compact('user', 'distributor'));
        }
        else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id == $id || Auth::user()->role == 'Admin') {
            $user = User::find($id);
            $places = Place::all();
            if ($user->role == 'Distributor') {
                if ($user->distributor->coordinate == null) {
                    $lat = -7.2754438;
                    $long = 112.6426426;
                } else {
                    $lat = $user->distributor->coordinate->getLat();
                    $long = $user->distributor->coordinate->getLng();
                }
                if ($user->distributor->place_id == null) {
                    $city = 'Surabaya';
                } else {
                    $city = $user->distributor->place->city;
                }
                Mapper::location($city)->map(
                    [
                        'zoom' => 8,
                        'center' => true,
                        'marker' => false
                    ]
                );
            }
            return view('user.edit', compact('user', 'places', 'lat', 'long'));
        } 
        else {
            return redirect()->route('dashboard');
        }
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
        if (Auth::user()->id == $id || Auth::user()->role == 'Admin') {
            if ($request->role == 'Distributor') {
                $rules = [
                    'name' => 'required',
                    'email' => 'required',
                    'role' => 'required',
                    'photo' => 'max:3000|mimes:jpg,jpeg,png',
                    'lat' => 'required',
                    'long' => 'required'
                ];
            }

            $rulesMessages = [
                'required' => 'Wajib diisi!',
                'max' => 'Maksimal file 3MB!',
                'mimes' => 'Format harus jpg, jpeg, png!'
            ];

            $this->validate($request, $rules, $rulesMessages);

            $user = User::find($id);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ];

            if ($request->hasFile("photo")) {
                $photo_path = public_path("storage/user/" . $user->photo);
                if (is_file($photo_path)) {
                    unlink($photo_path);
                }
                $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
                $photo = $request->photo;
                $photo_name = "user_" . $name . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('public/user/', $photo_name);
                $data['photo'] = (string) $photo_name;
            }
            $user->update($data);

            if ($request->role == 'Distributor') {
                $distributor_get = Distributor::where('user_id', $user->id)->first();
                $distributor = Distributor::find($distributor_get->id);
                $data2 = [
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'place_id' => $request->place_id,
                    'capacity' => $request->capacity,
                    'coordinate' => new Point($request->lat, $request->long)
                ];
                $distributor->update($data2);
            }

            Alert::success('Data berhasil diubah!', 'Sukses');
            return redirect()->route('profile.index', $id);
        } 
        else {
            return redirect()->route('dashboard');
        }
    }

    public function reset($id)
    {
        if (Auth::user()->id == $id || Auth::user()->role == 'Admin') {
            $user = User::find($id);
            return view('user.reset', compact('user'));
        }
        else {
            return redirect()->route('dashboard');
        }
    }

    public function resetpassword(Request $request, $id)
    {
        if (Auth::user()->id == $id || Auth::user()->role == 'Admin') {
            $user = User::find($id);
            if (Hash::check($request->oldpassword, $user->password)) {
                $user->password = bcrypt($request->newpassword);
                $user->update();
                Alert::success('Password berhasil diubah!', 'Sukses');
                return redirect()->route('profile.index', $id);
            } 
            else {
                return redirect()->route('profile.reset', $id)->with('error', 'Password lama anda salah!');
            }
        }
        else {
            return redirect()->route('dashboard');
        }
    }
}
