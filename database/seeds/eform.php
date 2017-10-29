<?php

use Illuminate\Database\Seeder;
use App\Model\Eform\eform_form;
use App\Model\Eform\eform_bro_sis;
use App\Model\Eform\eform_edu;
use App\Model\Eform\eform_his_job;
use App\Model\Eform\eform_lang;
use App\Model\Eform\eform_positsl;
use App\Model\Eform\eform_trn;
use App\Model\Eform\eform_file;
use App\Model\Eform\eform_fam;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\Eform_ref\form_race;
use App\Model\Eform_ref\form_posit;
use App\Model\Eform_ref\form_relig;
use App\Model\Eform_ref\master_edu;
use App\Model\Eform_ref\form_nation;
use App\Model\Eform_ref\form_provin;
use App\Model\Eform_ref\master_lang;
use App\Model\Eform_ref\master_mstatuse;
use App\Model\Eform\tagcandidate;
use Carbon\Carbon;


class eform extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getdata=Excel::selectSheets('main','childens','positions','brosis','edu','hisjob','lang','trn','file')->load(storage_path('app/exports/export.xlsx'))->get();
        foreach ($getdata[0] as $data) {
          $positcl=[];$educl=[];$exp=0;
          $id=eform_form::create([
            "etc_posit"=>$data->etc_posit,
            "titlename"=>(empty($data->titlename))?0:$data->titlename,
            "name"=>$data->name,
            "nameeng"=>$data->nameeng,
            "weight"=>$data->weight,
            "height"=>$data->height,
            "address_mas"=>$data->address_mas,
            "address"=>$data->address,
            "telephone"=>$data->telephone,
            "mobile"=>$data->mobile,
            "email"=>$data->email,
            "provb_id"=>$data->provb_id,
            "birthdate"=>$data->birthdate,
            "natc_id"=>$data->natc_id,
            "race_id"=>$data->race_id,
            "reli_id"=>$data->reli_id,
            "code_card"=>$data->code_card,
            "issued_at"=>$data->issued_at,
            "issuedate"=>$data->issuedate,
            "status"=>$data->status,
            "married"=>$data->married,
            "fam_name"=>$data->fam_name,
            "fam_age"=>$data->fam_age,
            "fam_posit"=>$data->fam_posit,
            "f_name"=>$data->f_name,
            "f_age"=>$data->f_age,
            "f_posit"=>$data->f_posit,
            "f_address"=>$data->f_address,
            "f_phone"=>$data->f_phone,
            "m_name"=>$data->m_name,
            "m_age"=>$data->m_age,
            "m_posit"=>$data->m_posit,
            "m_address"=>$data->m_address,
            "m_phone"=>$data->m_phone,
            "national_format"=>$data->national_format,
            "national_format_due"=>$data->national_format_due,
            "national_format_ref"=>$data->national_format_ref,
            "lang_etc"=>$data->lang_etc,
            "abi_com"=>$data->abi_com,
            "abi_any"=>$data->abi_any,
            "drivli"=>$data->drivli,
            "moto"=>$data->moto,
            "caru"=>$data->caru,
            "motou"=>$data->motou,
            "freetm"=>$data->freetm,
            "frncm"=>$data->frncm,
            "contagious_format"=>$data->contagious_format,
            "contagious_format_explain"=>$data->contagious_format_explain,
            "law_format"=>$data->law_format,
            "law_format_explain"=>$data->law_format_explain,
            "law2_format"=>$data->law2_format,
            "law2_format_explain"=>$data->law2_format_explain,
            "agb"=>$data->agb,
            "intv_format"=>$data->intv_format,
            "intv_format_when"=>$data->intv_format_when,
            "emrcon_name"=>$data->emrcon_name,
            "emrcon_address"=>$data->emrcon_address,
            "emrcon_tel"=>$data->emrcon_tel,
            "emrcon_rel"=>$data->emrcon_rel,
            "friends_format"=>$data->friends_format,
            "fcn"=>$data->fcn,
            "fcn2"=>$data->fcn2,
            "startwk"=>$data->startwk,
            "intf"=>$data->intf,
            "agg_data"=>$data->agg_data,
            "job_status"=>$data->job_status,
            "age"=>$data->age,
            "eq"=>$data->eq,
            "iq"=>$data->iq,
            "mbti"=>$data->mbti,
          ]);
          foreach ($getdata[1]->where('form_id',$data->id_form) as $childen) {
            eform_fam::create([
              "form_id"=>$id->id,
              "no"=>(empty($childen->no))?0:$childen->no,
              "name"=>$childen->name,
              "age"=>$childen->age,
              "op"=>$childen->op,
            ]);
          }
          foreach ($getdata[2]->where('form_id',$data->id_form) as $position) {
            eform_positsl::create([
              "form_id"=>$id->id,
              "no"=>(empty($position->no))?0:$position->no,
              "posit_id"=>$position->posit_id,
            ]);
            $positcl[]=$position->posit_id;
          }
          foreach ($getdata[3]->where('form_id',$data->id_form) as $brosis) {
            eform_bro_sis::create([
              "form_id"=>$id->id,
              "no"=>(empty($brosis->no))?0:$brosis->no,
              "name"=>$brosis->name,
              "age"=>$brosis->age,
              "op"=>$brosis->op,
              "ao"=>$brosis->ao,
              "tel"=>$brosis->tel,
            ]);
          }
          foreach ($getdata[4]->where('form_id',$data->id_form) as $edu) {
            eform_edu::create([
              "form_id"=>$id->id,
              "no"=>(empty($edu->no))?0:$edu->no,
              "edu_id"=>$edu->edu_id,
              "name"=>$edu->name,
              "locat"=>$edu->locat,
              "startdate"=>$edu->startdate,
              "enddate"=>$edu->enddate,
              "ccd"=>$edu->ccd,
              "gpa"=>$edu->gpa,
              "ms"=>$edu->ms,
            ]);
            $educl[]=$edu->edu_id;
          }
          foreach ($getdata[5]->where('form_id',$data->id_form) as $hisjob) {
            eform_his_job::create([
              "form_id"=>$id->id,
              "no"=>(empty($hisjob->no))?0:$hisjob->no,
              "name"=>$hisjob->name,
              "type"=>$hisjob->type,
              "address"=>$hisjob->address,
              "strdate"=>$hisjob->strdate,
              "enddate"=>$hisjob->enddate,
              "posit"=>$hisjob->posit,
              "respon"=>$hisjob->respon,
              "ref"=>$hisjob->ref,
              "rel"=>$hisjob->rel,
              "tel"=>$hisjob->tel,
              "resign"=>$hisjob->resign,
            ]);
            $dt=Carbon::parse($hisjob->strdate);
            $exp+=Carbon::parse($hisjob->enddate)->diffInYears($dt);
          }
          foreach ($getdata[6]->where('form_id',$data->id_form) as $lang) {
            eform_lang::create([
              "form_id"=>$id->id,
              "lang_id"=>$lang->lang_id,
              "type"=>$lang->type,
              "score"=>(empty($lang->score))?0:$lang->score,
            ]);
          }
          foreach ($getdata[7]->where('form_id',$data->id_form) as $trn) {
            eform_trn::create([
              "form_id"=>$id->id,
              "no"=>(empty($trn->no))?0:$trn->no,
              "name"=>$trn->name,
              "ins"=>$trn->ins,
              "cr"=>$trn->cr,
              "dr"=>$trn->dr,
            ]);
          }
          foreach ($getdata[8]->where('form_id',$data->id_form) as $file) {
            eform_file::create([
              "form_id"=>$id->id,
              "type"=>$file->type,
              "no"=>(empty($file->no))?0:$file->no,
              "name"=>$file->name,
              "temp"=>$file->temp,
            ]);
          }
          tagcandidate::create([
            'posit'=>implode(',',$positcl),'exp'=>$exp,
            'edu'=>implode(',',$educl),
            'sex'=>(empty($data->titlename))?0:$data->titlename,
            'eq'=>(empty($data->eq))?0:$data->eq,'iq'=>(empty($data->iq))?0:$data->iq,
            'form_id'=>$id->id,
            'age'=>$data->age
          ]);
        }
    }
}
