<?php

namespace App\Model\Masterdata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class offac extends Model
{
  use SoftDeletes;
    protected $fillable=['itemdesc'];
    protected $dates=['deleted_at'];

    public function scopeGetname($value,array $data)
    {
      return $value->whereIn('id',$data);
    }
}
