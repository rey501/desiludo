<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Trans extends Model
{
    protected $collection = 'trans';
    protected $primaryKey = '_id';
}
