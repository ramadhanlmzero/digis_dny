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
    {   //cari id distributor
        if(Auth()->user()->role=="Distributor"){
            $distributor = Distributor::where('user_id',Auth()->user()->id)->first();
            $transaction = Transaction::where('distributor_id', $distributor->id)->orderBy('created_at', 'DESC')->get();
        }else{
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
        $distributor = Distributor::where('user_id',Auth()->user()->id)->first();
        $products = Product::orderBy('title', 'DESC')->get();
        return view('transaction.create', ['distributor' => $distributor,'products' =>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $warning='';
        $distributor = Distributor::where('user_id',Auth()->user()->id)->first();
        $product_id = $request->product_id;
        $qty = $request->qty;
        // $product = Product::first();
        //foreach untuk cek stok level 1 
        foreach($distributor->product as $stock){
            // $s[]=($stock->pivot->product_id).':'.$product_id[$arraynum].':'.$qty[$arraynum];
            //foreach data checkout level 2
            foreach($product_id as $arraynum=>$p_id){
                //if product_id(post) = product_id(pivot) level 3
                if($p_id==$stock->pivot->product_id){
                    //if jika qty(post) lebih besar dari stock level 4
                    if($stock->pivot->stock<$qty[$arraynum]){
                        $warning.='stok ' . $stock->title . ' hanya berjumlah : '.$stock->pivot->stock.' buah saja!';
                    }else{
                        $pr_id[]=$p_id;
                        $title[]=$stock->title;
                        $price[]=$stock->price;
                        $qty[]=$qty[$arraynum];
                        $total[]=$stock->price*$qty[$arraynum];
                        $stok[]=$stock->pivot->stock-$qty[$arraynum];
                    }
                    //end level4
                }//end level 3
            }//end foreach level 2
        }//end foreach level 1
        if($warning!=''){
            return redirect()->back()->withErrors([$warning, 'msg']);
        }else{
        return view('transaction.checkout',['product_id'=>$pr_id,'p_id'=>$pr_id,'title'=>$title,'price'=>$price,'qty'=>$qty,'total'=>$total,'stock'=>$stok]);
        }
    }
    public function store(Request $request)
    {
        $distributor = Distributor::where('user_id',Auth()->user()->id)->first();
        //buat transaksi
        Transaction::create([
            'id' => (string) Str::uuid(),
            'total_price' => $request->total,
            'total_paid' => $request->bayar,
            'total_change' => $request->bayar-$request->total,
            'distributor_id' => $distributor->id
        ]);
        //cari transaksi terakhir
        $lastransaction = Transaction::where('distributor_id', $distributor->id)->orderBy('created_at', 'DESC')->first();
        foreach($request->product_id as $arraynum=>$p_id){
                $datadistri[$request->product_id[$arraynum]] = ['stock' => $request->stock[$arraynum]];
                $datatrans[$request->product_id[$arraynum]] = ['qta' => $request->qty[$arraynum]];
        }
        $distributor->product()->sync($datadistri);
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
