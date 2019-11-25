<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use App\Model\Distributor;

/**
 * @property \Grimzy\LaravelMysqlSpatial\Types\Point   $location
 * @property \Grimzy\LaravelMysqlSpatial\Types\Polygon $area
 */

class Place extends Model
{
    use SpatialTrait;

    protected $table = 'place';
    protected $fillable = [
        'id', 'city', 'coordinate'
    ];

    protected $spatialFields = [
        'coordinate'
    ];

    public $incrementing = false;

    public function distributor()
    {
        return $this->hasMany(Distributor::class, 'id', 'user_id');
    }
}
