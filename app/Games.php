<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Games extends Model
{
    protected $collection = 'games';
    protected $primaryKey = '_id';
}
