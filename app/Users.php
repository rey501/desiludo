<?php
namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class Users extends Model
{
    protected $collection = 'user_data';
    protected $primaryKey = '_id';
}
?>