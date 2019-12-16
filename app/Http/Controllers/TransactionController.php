<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Distributor;
use App\Model\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth()->user()->role == "Distributor"){
            $distributor = Distributor::where('user_id',Auth()->user()->id)->first();
            $transaction = Transaction::where('distributor_id', $distributor->id)->orderBy('created_at', 'DESC')->get();
        }
        else {
            $transaction = Transaction::orderBy('created_at', 'DESC')->get();
        }
        
        return view('transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distributor = Distributor::with('product')->where('user_id',Auth()->user()->id)->first();
        $products = Product::orderBy('title', 'DESC')->get();
        return view('transaction.create', compact('distributor', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
        ], [
            'required' => 'Pilih produk terlebih dahulu!',
        ]);

        $warning='';
        $product_id = $request->product_id;
        $distributor = Distributor::where('user_id',Auth()->user()->id)->first();
        $qty = $request->qty;

        foreach ($distributor->product as $product) {
            foreach ($product_id as $key => $value) {
                if ($value == $product->pivot->product_id) {
                    if ($product->pivot->stock < $qty[$key]) {
                        $warning .= 'Stok ' . $product->title . ' hanya berjumlah ' . $product->pivot->stock . ' buah saja!';
                    }
                    else {
                        if (count($product_id)) {
                            $products = Product::whereIn('id', $product_id)->get();
                        } else {
                            $products = Product::where('id', $product_id)->first();
                        }
                    }
                }
            }
        }

        if ($warning != '') {
            return redirect()->back()->withErrors([$warning, 'msg']);
        } 
        else {
            return view('transaction.checkout', compact('distributor', 'products', 'product_id', 'qty'));
        }
    }

    public function store(Request $request)
    {
        $distributor = Distributor::where('user_id',Auth()->user()->id)->first();

        Transaction::create([
            'id' => (string) Str::uuid(),
            'total_price' => $request->total,
            'total_paid' => $request->bayar,
            'total_change' => $request->bayar-$request->total,
            'distributor_id' => $distributor->id
        ]);
        
        $lastransaction = Transaction::where('distributor_id', $distributor->id)->orderBy('created_at', 'DESC')->first();

        for ($i = 0; $i < count($request->product_id); $i++) {
            $datadistri[$request->product_id[$i]] = ['stock' => $request->stock[$i]-$request->qty[$i]];
            $datatrans[$request->product_id[$i]] = ['qta' => $request->qty[$i]];
        }
        $distributor->product()->syncWithoutDetaching($datadistri);
        $lastransaction->product()->sync($datatrans);
        Alert::success('Transaksi Berhasil', 'Sukses');
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions = Transaction::find($id);
        return view('transaction.show', compact('transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
