<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Orders extends Model
{
    protected $collection = 'orders';
    protected $primaryKey = '_id';
}
