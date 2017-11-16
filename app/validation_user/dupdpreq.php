<?php
namespace App\validation_user;

use App\Model\Masterdata\approve_func;


class dupdpreq{
  public function checkdupdp($attr,$value,$para,$validator){
    $darw=$validator->getData();
    $data=approve_func::where(['function_id'=>$darw[strval($para[0])],'party_id'=>$value,'department_id'=>$darw[strval($para[1])]])->first();
    return $data==null;
  }
}
