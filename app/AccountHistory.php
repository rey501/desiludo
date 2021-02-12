<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class AccountHistory extends Model
{
    protected $collection = 'account_history';
    protected $primaryKey = '_id';
}
