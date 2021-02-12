<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Brokerages extends Model
{
    protected $collection = 'brokerages';
    protected $primaryKey = '_id';
}
