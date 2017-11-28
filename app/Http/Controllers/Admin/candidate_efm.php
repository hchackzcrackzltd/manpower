<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Eform\eform_form;
use App\Model\Eform\tagcandidate;
use Chumper\Zipper\Facades\Zipper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
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
use App\Model\User\authorize;
use Illuminate\Support\Facades\Auth;

class candidate_efm extends Controller
{

    public function index()
    {
      $this->authorize("accanad",authorize::getau(4)->first());
      return view('admin.candidate.index_list',['data'=>eform_form::with('getposition')->status('OP')->get()]);
    }

    public function detail(eform_form $id)
    {
      $this->authorize("accanad",authorize::getau(4)->first());
      return view('admin.candidate.candidate_detail',[
        'data'=>$id->load(['getposition','getbrosis','getedu','getfam','gethisjob','getlang',
        'gettrn','getfile']),
        'master_titlename'=>['นาย','นาง','นางสาว'],
        'master_titlenameeng'=>['Mr.','Mrs.','Miss.'],
        'master_mlitary'=>[1=>'เกณฑ์แล้ว Yes',2=>'ยังไม่เกณฑ์ No',3=>'ได้รับการยกเว้นเพราะ If exempted specify reason'],
        'master_lang'=>['ไม่ได้ Poor','พอใช้  Fair','ดี  Good','ดีมาก Excellent']
        ]);
    }

    public function destroy(eform_form $id)
    {
      $this->authorize("accanad",authorize::getau(4)->first());
      tagcandidate::where('form_id',$id->id)->delete();
      $id->update(['status_can'=>'CN']);
      return redirect()->route('cannidate_new.index')->with('success', 'Resume Close');
    }

    public function history()
    {
      $this->authorize("accanad",authorize::getau(4)->first());
      return view('admin.candidate.list_history',['data'=>eform_form::with('getposition')->status('CN')->get()]);
    }

    public function destroy_his(eform_form $id)
    {
      $this->authorize("accanad",authorize::getau(4)->first());
      tagcandidate::where('form_id',$id->id)->delete();
      $id->delete();
      return redirect()->route('cannidate_new.history')->with('success', 'Resume has deleted');
    }

    public function recover(eform_form $id)
    {
      $this->authorize("accanad",authorize::getau(4)->first());
      tagcandidate::onlyTrashed()->where('form_id',$id->id)->restore();
      $id->update(['status_can'=>'OP']);
      return redirect()->route('cannidate_new.index')->with('success', 'Resume has restore');
    }

    public function create(Request $request)
    {
      $this->authorize("accanad",authorize::getau(4)->first());
      $this->validate($request,['file_im'=>'required|file|mimes:zip'],['file_im.required'=>'Plase Insert File'
      ,'file_im.mimes'=>'Support Only ZIP',]);
      $folder=Carbon::now()->format('ymdhis');
      $request->file_im->storeAs('exports',$request->file_im->getClientOriginalName(),'local');
      Zipper::make(storage_path('app/exports/'.$request->file_im->getClientOriginalName()))->extractTo(storage_path("app/exports/{$folder}/"));
      //Storage::disk('local')->delete('exports/'.$request->file_im->getClientOriginalName());
      $getdata=Excel::selectSheets('main','childens','positions','brosis','edu','hisjob','lang','trn','file','posit_master','educat_master','lang_master','religion_master','race_master','provin_master','nation_master')->load(storage_path("app/exports/{$folder}/export.xlsx"))->get();
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
          'interest'=>0,
          'status_can'=>'OP'
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
            "temp"=>$folder."/".$file->temp,
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
      foreach ($getdata[9] as $pomt) {
        if(form_posit::where('id',intval($pomt->id))->count()===0){
          form_posit::create(['name'=>$pomt->name]);
        }
      }
      foreach ($getdata[10] as $pomt) {
        if(master_edu::where('id',intval($pomt->id))->count()===0){
          master_edu::create(['name'=>$pomt->name]);
        }
      }
      foreach ($getdata[11] as $pomt) {
        if(master_lang::where('id',intval($pomt->id))->count()===0){
          master_lang::create(['name'=>$pomt->name]);
        }
      }
      foreach ($getdata[12] as $pomt) {
        if(form_relig::where('id',intval($pomt->id))->count()===0){
          form_relig::create(['name'=>$pomt->name]);
        }
      }
      foreach ($getdata[13] as $pomt) {
        if(form_race::where('id',intval($pomt->id))->count()===0){
          form_race::create(['name'=>$pomt->name]);
        }
      }
      foreach ($getdata[14] as $pomt) {
        if(form_provin::where('id',intval($pomt->id))->count()===0){
          form_provin::create(['name'=>$pomt->name]);
        }
      }
      foreach ($getdata[15] as $pomt) {
        if(form_nation::where('id',intval($pomt->id))->count()===0){
          form_nation::create(['name'=>$pomt->name]);
        }
      }
      return redirect()->route('cannidate_new.index')->with('success', 'Import Resume Success');
    }

    public function getattech(eform_form $id,$no)
    {
      $this->authorize("accanad",authorize::getau(4)->first());
      $fm=$id->load('getfile');
      $ext=$fm->getfile->where('no',$no)->first();
      return response()->file(storage_path('app/exports/'.$ext->temp),["Content-Disposition"=>"inline; filename='{$ext->name}'"]);
    }

    public function updateiqeqmbti(Request $req)
    {
      $this->validate($req, [
        'id'=>'required|exists:eform_forms,id',
        'iq'=>'nullable|numeric|max:200|min:0',
        'eq'=>'nullable|numeric|max:200|min:0',
        'mbti'=>'nullable|string']);
        eform_form::find($req->id)->update(['iq'=>$req->iq,'eq'=>$req->eq,'mbti'=>$req->mbti]);
        return redirect()->route('cannidate_new.index')->with('success', 'Update Resume Success');
    }
}
