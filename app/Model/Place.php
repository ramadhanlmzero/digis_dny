<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Distributor;

class Place extends Model
{
    protected $table = 'place';
    protected $guarded = [];

    public $incrementing = false;

    public function distributor()
    {
        return $this->hasMany(Distributor::class, 'place_id', 'id')->with('transaction');
    }
}
