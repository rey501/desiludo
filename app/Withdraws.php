<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Withdraws extends Model
{
   	protected $collection = 'Withdraws';
    protected $primaryKey = '_id';
}
