<?php

namespace App\Model\Misticket;

use Illuminate\Database\Eloquent\Model;

class logprob extends Model
{
  protected $connection='misticket';
  protected $table='logprob';
  protected $fillable=['idjob','type','prob'];
public $timestamps=false;
}
