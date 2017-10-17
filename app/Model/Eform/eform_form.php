<?php

namespace App\Model\Eform;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class eform_form extends Model
{
  use SoftDeletes;
  protected $fillable=[
  "etc_posit",
  "titlename",
  "name",
  "nameeng",
  "weight",
  "height",
  "address_mas",
  "address",
  "telephone",
  "mobile",
  "email",
  "provb_id",
  "birthdate",
  "natc_id",
  "race_id",
  "reli_id",
  "code_card",
  "issued_at",
  "issuedate",
  "status",
  "married",
  "fam_name",
  "fam_age",
  "fam_posit",
  "f_name",
  "f_age",
  "f_posit",
  "f_address",
  "f_phone",
  "m_name",
  "m_age",
  "m_posit",
  "m_address",
  "m_phone",
  "national_format",
  "national_format_due",
  "national_format_ref",
  "lang_etc",
  "abi_com",
  "abi_any",
  "drivli",
  "moto",
  "caru",
  "motou",
  "freetm",
  "frncm",
  "contagious_format",
  "contagious_format_explain",
  "law_format",
  "law_format_explain",
  "law2_format",
  "law2_format_explain",
  "agb",
  "intv_format",
  "intv_format_when",
  "emrcon_name",
  "emrcon_address",
  "emrcon_tel",
  "emrcon_rel",
  "friends_format",
  "fcn",
  "fcn2",
  "startwk",
  "intf",
  "agg_data",
  "job_status",
  "age","eq","iq","mbti",
    ];

    protected $dates=['deleted_at'];

    public function getposition()
    {
      return $this->hasMany(eform_positsl::class,'form_id');
    }

    public function getbrosis()
    {
      return $this->hasMany(eform_bro_sis::class,'form_id');
    }

    public function getedu()
    {
      return $this->hasMany(eform_edu::class,'form_id');
    }

    public function getfam()
    {
      return $this->hasMany(eform_fam::class,'form_id');
    }

    public function gethisjob()
    {
      return $this->hasMany(eform_his_job::class,'form_id');
    }

    public function getlang()
    {
      return $this->hasMany(eform_lang::class,'form_id');
    }

    public function gettrn()
    {
      return $this->hasMany(eform_trn::class,'form_id');
    }

    public function getfile()
    {
      return $this->hasMany(eform_file::class,'form_id');
    }
}
