<?php
namespace App\validation_user;

use Illuminate\Support\Collection;


class memreq extends Collection{
  public function checkmemdup($attr,$value,$para,$validator){
    $collect=collect($value);
    return count($value)==count($collect->unique()->values()->all());
  }
}
