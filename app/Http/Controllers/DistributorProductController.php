<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Model\Product;
use App\Model\Distributor;

class DistributorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'DESC')->get();
        $distributors = Distributor::whereHas('user', function ($query) {
            $query->orderBy('name', 'DESC');
        })->get();

        return view('distributorproduct.index', compact('products', 'distributors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $products = Product::orderBy('title', 'DESC')->get();
        $distributor = Distributor::whereHas('user', function ($query) {
            $query->orderBy('name', 'DESC');
        })->find($id);
        return view('distributorproduct.edit', compact('products', 'distributor'));
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
        $distributor = Distributor::find($id);

        $stock = 0;
        foreach ($request->stock as $value) {
            $stock += $value;
        }
        if($distributor->capacity < $stock) {
            return redirect()->back()->withErrors(['Produk yang ingin direstock melebihi kapasitas gudang!', 'msg']);
        }
        else {
            for ($i=0; $i < count($request->product_id); $i++) { 
                $data[$request->product_id[$i]] = ['stock' => $request->stock[$i]];
            }
            $distributor->product()->sync($data);
            Alert::success('Data berhasil disimpan!', 'Sukses');
            return redirect()->route('distributorproduct.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
