<?php
namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class game_commission extends Model
{
    protected $collection = 'game_commission';
    protected $primaryKey = '_id';
}
?>