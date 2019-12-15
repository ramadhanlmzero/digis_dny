<?php

namespace App\Http\Controllers;

use Mapper;
use App\Model\Place;
use App\Model\Distributor;
use App\Model\Product;
use App\Model\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDistributors = Distributor::count();
        $totalPlaces = Place::count();
        $totalTransactions = Transaction::count();
        $totalProducts = Product::count();

        $your = Distributor::where('user_id', Auth()->user()->id)->first();

        $places = Place::with('distributor')->orderBy('updated_at', 'DESC')->get();
        $distributors = Distributor::all();
        Mapper::location('Jawa Timur')->map(
            [
                'zoom' => 8,
                'center' => true,
                'marker' => false
            ]
        );
        return view('dashboard', compact('places', 'distributors', 'totalDistributors', 'totalPlaces', 'totalTransactions', 'totalProducts', 'your'));
    }
}
