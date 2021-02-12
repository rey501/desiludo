<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Issues extends Model
{
    protected $collection = 'issues';
    protected $primaryKey = '_id';
}
