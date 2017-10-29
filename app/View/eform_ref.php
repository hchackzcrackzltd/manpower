<?php
namespace App\View;

use Illuminate\View\View;
use App\Model\Eform_ref\form_nation;
use App\Model\Eform_ref\form_posit;
use App\Model\Eform_ref\form_provin;
use App\Model\Eform_ref\form_race;
use App\Model\Eform_ref\form_relig;
use App\Model\Eform_ref\master_edu;
use App\Model\Eform_ref\master_lang;
use App\Model\Eform_ref\master_mstatuse;

/**
 *
 */
class eform_ref
{
  public $ref_nation;
  public $ref_posit;
  public $ref_provin;
  public $ref_race;
  public $ref_relig;
  public $ref_edu;
  public $ref_lang;
  public $ref_mstatuse;
  function __construct()
  {
    $this->ref_nation=form_nation::all();
    $this->ref_posit=form_posit::all();
    $this->ref_provin=form_provin::all();
    $this->ref_race=form_race::all();
    $this->ref_relig=form_relig::all();
    $this->ref_edu=master_edu::all();
    $this->ref_lang=master_lang::all();
    $this->ref_mstatuse=master_mstatuse::all();
  }

  public function compose(View $value)
  {
    $value->with([
      'ref_nation'=>$this->ref_nation,
      'ref_posit'=>$this->ref_posit,
      'ref_provin'=>$this->ref_provin,
      'ref_race'=>$this->ref_race,
      'ref_relig'=>$this->ref_relig,
      'ref_edu'=>$this->ref_edu,
      'ref_lang'=>$this->ref_lang,
      'ref_mstatuse'=>$this->ref_mstatuse
    ]);
  }
}
