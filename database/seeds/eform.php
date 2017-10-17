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


class eform extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::selectSheets('main')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_form::create([
              "etc_posit"=>$data->etc_posit,
              "titlename"=>$data->titlename,
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
              "status_req"=>$data->status_req,
              "job_status"=>$data->job_status,
              "age"=>$data->age,
            ]);
          });
        });

        Excel::selectSheets('childens')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_fam::create([
              "form_id"=>$data->form_id,
              "no"=>$data->no,
              "name"=>$data->name,
              "age"=>$data->age,
              "op"=>$data->op,
            ]);
          });
        });

        Excel::selectSheets('positions')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_positsl::create([
              "form_id"=>$data->form_id,
              "posit_id"=>$data->posit_id,
              "no"=>$data->no,
            ]);
          });
        });

        Excel::selectSheets('brosis')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_bro_sis::create([
              "form_id"=>$data->form_id,
              "no"=>$data->no,
              "name"=>$data->name,
              "age"=>$data->age,
              "op"=>$data->op,
              "ao"=>$data->ao,
              "tel"=>$data->tel,
            ]);
          });
        });

        Excel::selectSheets('edu')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_edu::create([
              "form_id"=>$data->form_id,
              "no"=>$data->no,
              "edu_id"=>$data->edu_id,
              "name"=>$data->name,
              "locat"=>$data->locat,
              "startdate"=>$data->startdate,
              "enddate"=>$data->enddate,
              "ccd"=>$data->ccd,
              "gpa"=>$data->gpa,
              "ms"=>$data->ms,
            ]);
          });
        });

        Excel::selectSheets('hisjob')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_his_job::create([
              "form_id"=>$data->form_id,
              "no"=>$data->no,
              "name"=>$data->name,
              "type"=>$data->type,
              "address"=>$data->address,
              "strdate"=>$data->strdate,
              "enddate"=>$data->enddate,
              "posit"=>$data->posit,
              "ref"=>$data->ref,
              "rel"=>$data->rel,
              "tel"=>$data->tel,
              "resign"=>$data->resign,
            ]);
          });
        });

        Excel::selectSheets('lang')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_lang::create([
              "form_id"=>$data->form_id,
              "lang_id"=>$data->lang_id,
              "type"=>$data->type,
              "score"=>$data->score,
            ]);
          });
        });

        Excel::selectSheets('trn')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_trn::create([
              "form_id"=>$data->form_id,
              "no"=>$data->no,
              "name"=>$data->name,
              "ins"=>$data->ins,
              "cr"=>$data->cr,
              "dr"=>$data->dr,
            ]);
          });
        });

        Excel::selectSheets('file')->load(storage_path('app/exports/export.xlsx'),function($value)
        {
          $value->each(function ($data)
          {
            eform_file::create([
              "form_id"=>$data->form_id,
              "type"=>$data->type,
              "no"=>$data->no,
              "name"=>$data->name,
              "temp"=>$data->temp,
            ]);
          });
        });
    }
}
