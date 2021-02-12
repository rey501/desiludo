<?php
namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class User_Data extends Model
{
    protected $collection = 'User_Data';
    protected $primaryKey = '_id';
}
?>