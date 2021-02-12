<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Tournament extends Model
{
    protected $collection = 'tournaments';
    protected $primaryKey = '_id';
}
