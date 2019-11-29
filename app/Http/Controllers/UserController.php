<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Alert;
use Mapper;
use Carbon\Carbon;
use App\User;
use App\Model\Distributor;
use App\Model\Place;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'Admin')->orderBy('updated_at', 'DESC')->get();
        $distributors = User::where('role', 'Distributor')->orderBy('updated_at', 'DESC')->get();
        return view('user.index', compact('users', 'distributors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required',
            'photo' => 'max:3000|mimes:jpg,jpeg,png'
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!',
            'email.unique' => 'Email sudah pernah dipakai!',
            'max' => 'Maksimal file 3MB!',
            'mimes' => 'Format harus jpg, jpeg, png!'
        ];

        $this->validate($request, $rules, $rulesMessages);
        
        $data = [
            'id' => (string) Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ];

        if ($request->hasFile("photo")) {
            $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
            $photo = $request->photo;
            $photo_name = "user_" . $name . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/user/', $photo_name);
            $data['photo'] = (string) $photo_name;
        }
        else {
            $data['photo'] = null;
        }
        User::create($data);


        if ($request->role == 'Distributor') {
            $data2 = [
                'id' => (string) Str::uuid(),
                'user_id' => $data['id']
            ];
            Distributor::create($data2);
        }

        Alert::success('Data berhasil disimpan!', 'Sukses');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $places = Place::all();
        if($user->role == 'Distributor') {
            if($user->distributor->coordinate == null) {
                $lat = -7.2754438;
                $long = 112.6426426;
            }
            else {
                $lat = $user->distributor->coordinate->getLat();
                $long = $user->distributor->coordinate->getLng();
            }
            if($user->distributor->place_id == null) {
                $city = 'Surabaya';
            }
            else {
                $city = $user->distributor->place->city;
            }
            Mapper::location($city)->map(
            [
                'zoom' => 8,
                'center' => true,
                'marker' => false
            ]);
        }
        return view('user.edit', compact('user', 'places', 'lat', 'long'));
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
        if($request->role == 'Admin') {
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',
                'photo' => 'max:3000|mimes:jpg,jpeg,png'
            ];
        }
        if($request->role == 'Distributor') {
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
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $photo_path = public_path("storage/user/" . $user->photo);
        if (is_file($photo_path)) {
            unlink($photo_path);
        }
        $user->delete();

        Alert::success('Data berhasil dihapus!', 'Sukses');
        return redirect()->route('user.index');
    }

    public function reset($id)
    {
        $user = User::find($id);
        return view('user.reset', compact('user'));
    }

    public function resetpassword(Request $request, $id)
    {
        $user = User::find($id);
        if (Hash::check($request->oldpassword, $user->password)) {
            $user->password = bcrypt($request->newpassword);
            $user->update();
            Alert::success('Password berhasil diubah!', 'Sukses');
            return redirect()->route('user.index');
        }
        else {
            return redirect()->route('user.reset', $id)->with('error', 'Password lama anda salah!');
        }
    }
}
