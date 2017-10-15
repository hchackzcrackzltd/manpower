<?php

namespace App\Model\Misticket;

use Illuminate\Database\Eloquent\Model;

class logform extends Model
{
    protected $connection='misticket';
    protected $table='logform';
    protected $primaryKey='idjob';
    public $incrementing=false;
    protected $fillable=['idjob','time','timestr','timeend','iduser','iduserse',
  'status','location','problem','solve','cause','comment','score','commenten'];
  public $timestamps=false;
}
