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
  public $aucandi;
  function __construct()
  {
    $this->auman=audb::getau(1)->first();
    $this->aursg=audb::getau(2)->first();
    $this->auapp=audb::getau(3)->first();
    $this->aucandi=audb::getau(4)->first();
  }

  public function compose(View $value)
  {
    $value->with([
      'auman'=>$this->auman,
      'aursg'=>$this->aursg,
      'auapp'=>$this->auapp,
      'aucandi'=>$this->aucandi,
    ]);
  }
}
