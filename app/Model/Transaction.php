<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Distributor;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $guarded = [];

    public $incrementing = false;
    
    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'distributor_id', 'id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
