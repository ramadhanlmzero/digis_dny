<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Place;
use App\User;
use App\Model\Transaction;
use App\Model\Product;

class Distributor extends Model
{
    protected $table = 'distributor';
    protected $guarded = [];

    public $incrementing = false;

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'id', 'transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
