<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Transaction;
use App\Model\Distributor;

class Product extends Model
{
    protected $table = 'product';
    protected $guarded = [];

    public $incrementing = false;
    
    public function transaction()
    {
        return $this->belongsToMany(Transaction::class)->withTimestamps();
    }

    public function distributor()
    {
        return $this->belongsToMany(Distributor::class)->withPivot('stock')->withTimestamps();
    }
}
