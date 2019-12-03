<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use App\User;
use App\Model\Place;
use App\Model\Transaction;
use App\Model\Product;

/**
 * @property \Grimzy\LaravelMysqlSpatial\Types\Point   $location
 * @property \Grimzy\LaravelMysqlSpatial\Types\Polygon $area
 */

class Distributor extends Model
{
    use SpatialTrait;

    protected $table = 'distributor';
    protected $guarded = [];

    protected $spatialFields = [
        'coordinate'
    ];

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
        return $this->belongsToMany(Product::class)->withPivot('stock')->withTimestamps();
    }
}
