<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Bots extends Model
{
    protected $collection = 'bots';
    protected $primaryKey = '_id';
}
