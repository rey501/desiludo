<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Commission extends Model
{
    protected $collection = 'Commission';
    protected $primaryKey = '_id';
}
