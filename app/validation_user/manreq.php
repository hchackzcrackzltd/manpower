<?php
namespace App\validation_user;

use App\Model\Masterdata\employee_resign_use;


class manreq{
  public function checkresignemp($attr,$value,$para,$validator){
    $data=employee_resign_use::onlyTrashed()->where([['code',$value],['replace',1]])->first();
    return $data!==null;
  }
}
