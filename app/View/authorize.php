<?php
namespace App\View;

use Illuminate\View\View;
use App\Model\User\authorize as audb;

/**
 *
 */
class authorize
{
  public $auman;
  public $aursg;
  public $auapp;
  function __construct()
  {
    $this->auman=audb::getau(1)->first();
    $this->aursg=audb::getau(2)->first();
    $this->auapp=audb::getau(3)->first();
  }

  public function compose(View $value)
  {
    $value->with([
      'auman'=>$this->auman,
      'aursg'=>$this->aursg,
      'auapp'=>$this->auapp
    ]);
  }
}
