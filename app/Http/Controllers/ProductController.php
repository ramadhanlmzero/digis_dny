<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Alert;
use Carbon\Carbon;
use App\Model\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'DESC')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
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
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'max:3000|mimes:jpg,jpeg,png'
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!',
            'max' => 'Maksimal file 3MB!',
            'mimes' => 'Format harus jpg, jpeg, png!'
        ];

        $this->validate($request, $rules, $rulesMessages);

        $data = [
            'id' => (string) Str::uuid(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price
        ];

        if ($request->hasFile("image")) {
            $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
            $image = $request->image;
            $image_name = "product_" . $name . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/product/', $image_name);
            $data['image'] = (string) $image_name;
        } 
        else {
            $data['image'] = null;
        }
        Product::create($data);

        Alert::success('Data berhasil disimpan!', 'Sukses');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
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
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'max:3000|mimes:jpg,jpeg,png'
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!',
            'max' => 'Maksimal file 3MB!',
            'mimes' => 'Format harus jpg, jpeg, png!'
        ];

        $this->validate($request, $rules, $rulesMessages);

        $product = Product::find($id);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price
        ];

        if ($request->hasFile("image")) {
            $image_path = public_path("storage/product/" . $product->image);
            if (is_file($image_path)) {
                unlink($image_path);
            }
            $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
            $image = $request->image;
            $image_name = "product_" . $name . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/product/', $image_name);
            $data['image'] = (string) $image_name;
        }
        $product->update($data);

        Alert::success('Data berhasil diubah!', 'Sukses');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        Alert::success('Data berhasil dihapus!', 'Sukses');
        return redirect()->route('product.index');
    }
}
