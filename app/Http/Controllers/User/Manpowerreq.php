<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Requests\manpowerform;
use App\Model\Masterdata\position;
use App\Model\Masterdata\education;
use App\Model\Masterdata\faculty;
use App\Model\Form\request as reqfm;
use App\Model\Masterdata\softreq;
use App\Model\Masterdata\comreq;
use App\Model\Masterdata\acereq;
use Illuminate\Support\Facades\Mail;
use App\Model\Masterdata\mail_group;
use Illuminate\Support\Facades\DB;
use App\Model\User\user_dashboard_detail;
use App\Model\Masterdata\location;
use App\Model\Masterdata\offac;
use App\Model\Masterdata\employee_resign_use;
use App\Model\Masterdata\employee_resign;
use App\Model\Masterdata\company;
use App\Model\Masterdata\employee;
use App\Mail\notihr;
use App\Mail\prenotiac;
use App\Mail\prenotiad;
use App\Mail\prenotimis;
use App\Model\Masterdata\approve;
use App\Model\Masterdata\approve_func;
use App\Mail\notiapprove;
use App\Model\Masterdata\functionmaster;

class Manpowerreq extends Controller
{
  protected function getidman(){
    $id=reqfm::withTrashed()->where('id', 'LIKE', Carbon::now()->format('ymd').'%')->max('id');
    return (isset($id))?$id+1:Carbon::now()->format('ymd').'001';
  }
  protected function makeapprove(reqfm $data,int $fid)
  {
    $appraw=approve_func::getmydep($fid)->first();
    if ($appraw) {
      if ($appraw->getappmem()->first()) {
      $lv=$appraw->getappmem()->getlv()->first();
      $lv=(isset($lv->level))?$lv->level:0;
      if ($appraw->getappmem()->max('level')==$lv) {
        $data->update([
          'approve'=>2
        ]);
        return true;
      }
      foreach ($appraw->getappmem()->notapp($lv)->orderBy('level','asc')->get() as $value) {
        approve::create([
          'request_id'=>$data->id,
          'type'=>$fid,
          'user_id'=>$value->employee_id,
          'level'=>$value->level,
          'status'=>0
        ]);
      }
      $this->checknextapp($data->id,$fid);
      return false;
    }
    return true;
    }else {
      $data->update([
        'approve'=>2
      ]);
      return true;
    }
  }
  protected function checknextapp($id,$type=1){
    $getminlv=approve::where(['request_id'=>$id,'type'=>$type,'status'=>0])
    ->min('level');
    approve::where(['request_id'=>$id,'type'=>$type,'status'=>0,'level'=>$getminlv])
    ->tap(function($values) use ($id){
      foreach ($values->get() as $value) {
        Mail::to($value->getemployee()->first())
        ->send(new notiapprove(user_dashboard_detail::find($id)));
      }
    })->update(['status'=>1]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pos=position::getpositdep()->get();
        $applist=approve_func::getmydep(1)->first();
        return view('user.formreq.manf', [
          'pos'=>$pos,
          'edu'=>education::all(),
          'fac'=>faculty::all(),
          'sw'=>softreq::all(),
          'as'=>acereq::all(),
          'offac'=>offac::all(),
          'location'=>location::all(),
          'resign'=>employee_resign_use::onlyTrashed()->checkuse()->get(),
          'company'=>company::all(),
          'applist'=>($applist)?$applist->getappmem()->OrderBy('level','ASC')->get():[]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('user_dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(manpowerform $request)
    {
        $id=$this->getidman();
        $data=reqfm::create([
        'id'=>$id,'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eed,'position_id'=>$request->posit,
        'rfm_id'=>$request->rfm,'ren_name'=>(isset($request->ren_name))?$request->ren_name:'',
        'jt_id'=>$request->jt,'tw_lead'=>(isset($request->tw_lead))?$request->tw_lead:0,
        'tw_lead_type'=>(isset($request->tw_lead_type))?$request->tw_lead_type:0,
        'jd'=>$request->jd,'sex'=>$request->sex,'count'=>$request->js1_count,
        'age'=>$request->age,'edu_id'=>implode(',',$request->deg),'fac_id'=>implode(',',$request->fac),
        'exp'=>$request->exp,
        'exp_year'=>(isset($request->exp_year))?$request->exp_year:0,'qua'=>$request->qua,
        'com_id'=>$request->com_id,'sw'=>(isset($request->sw))?implode(',',$request->sw):'',
        'sw_etc_spc'=>(isset($request->sw_etc_spc))?$request->sw_etc_spc:'',
        'ac'=>(isset($request->ac))?implode(',',$request->ac):'',
        'ac_etc_spc'=>(isset($request->ac_etc_spc))?$request->ac_etc_spc:'',
        'fedc'=>(isset($request->fedc))?$request->fedc:'',
        'car'=>(isset($request->car))?$request->car:0,'car_lp'=>(isset($request->car_lp))?$request->car_lp:'',
        'nmc'=>(isset($request->nmc))?implode(',',$request->nmc):'','ofa'=>(isset($request->ofa))?$request->ofa:'',
        'user_id'=>$request->user()->username,'status'=>'NJ','remark'=>$request->remark,'em_type'=>$request->type_em,
        'location'=>$request->locat,'company'=>$request->compa,'rfm_nfb'=>$request->rfm_nfb,'approve'=>0,
        'imd_id'=>$request->imr,'rfm_emp_id'=>$request->rfm_trans
      ]);
      if (isset($request->ren_name)) {
        employee_resign::onlyTrashed()->where('id', $request->ren_name)
        ->update(['replace'=>2]);
      }
      if ($data->rfm_id==2) {
        $statapp=$this->makeapprove($data,3);
      }else {
        $statapp=$this->makeapprove($data,1);
      }
      if ($statapp) {
          Mail::to(mail_group::find(1))->send(new notihr(user_dashboard_detail::find($data->id)));
          if ($data->com_id>0) {
            Mail::to(mail_group::find(2))->send(new prenotimis(user_dashboard_detail::find($data->id)));
          }
          if ($data->fedc>0) {
            Mail::to(mail_group::find(3))->send(new prenotiac(user_dashboard_detail::find($data->id)));
          }
          if (strlen($data->nmc)>0||strlen($data->ofa)>0) {
            Mail::to(mail_group::find(4))->send(new prenotiad(user_dashboard_detail::find($data->id)));
          }
      }
        return redirect()->route('user_dashboard')->with('success', 'Request has been send');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $manpowerreq
     * @return \Illuminate\Http\Response
     */
    public function show(reqfm $manpowerreq)
    {
        $this->authorize('view', $manpowerreq);
        $pos=position::getpositdep()->get();
        $applist=approve_func::getmydep(($manpowerreq->rfm_id==2)?3:1)->first();
        return view('user.formreq.duplicatemanf', [
          'pos'=>$pos,
          'edu'=>education::all(),
          'fac'=>faculty::all(),
          'sw'=>softreq::all(),
          'as'=>acereq::all(),
          'data'=>$manpowerreq,
          'offac'=>offac::all(),
          'location'=>location::all(),
          'resign'=>employee_resign_use::onlyTrashed()->checkuse()->get(),
          'company'=>company::all(),
          'applist'=>($applist)?$applist->getappmem()->OrderBy('level','ASC')->get():[]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $manpowerreq
     * @return \Illuminate\Http\Response
     */
    public function edit(reqfm $manpowerreq)
    {
        $this->authorize('edit', $manpowerreq);
        $pos=position::getpositdep()->get();
        $applist=approve_func::getmydep(($manpowerreq->rfm_id==2)?3:1)->first();
        return view('user.formreq.editmanf', [
          'pos'=>$pos,
          'edu'=>education::all(),
          'fac'=>faculty::all(),
          'sw'=>softreq::all(),
          'as'=>acereq::all(),
          'data'=>$manpowerreq,
          'offac'=>offac::all(),
          'location'=>location::all(),
          'resign'=>employee_resign_use::onlyTrashed()->checkuse()->get(),
          'company'=>company::all(),
          'applist'=>($applist)?$applist->getappmem()->OrderBy('level','ASC')->get():[]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(manpowerform $request, reqfm $manpowerreq)
    {
        $this->authorize('update', $manpowerreq);
        $manpowerreq->update([
        'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eed,'position_id'=>$request->posit,
        'rfm_id'=>$request->rfm,'ren_name'=>(isset($request->ren_name))?$request->ren_name:'',
        'jt_id'=>$request->jt,'tw_lead'=>(isset($request->tw_lead))?$request->tw_lead:0,
        'tw_lead_type'=>(isset($request->tw_lead_type))?$request->tw_lead_type:0,
        'jd'=>$request->jd,'sex'=>$request->sex,'count'=>$request->js1_count,
        'age'=>$request->age,'edu_id'=>implode(',',$request->deg),'fac_id'=>implode(',',$request->fac),
        'exp'=>$request->exp,
        'exp_year'=>(isset($request->exp_year))?$request->exp_year:0,'qua'=>$request->qua,
        'com_id'=>$request->com_id,'sw'=>(isset($request->sw))?implode(',',$request->sw):'',
        'sw_etc_spc'=>(isset($request->sw_etc_spc))?$request->sw_etc_spc:'',
        'ac'=>(isset($request->ac))?implode(',',$request->ac):'',
        'ac_etc_spc'=>(isset($request->ac_etc_spc))?$request->ac_etc_spc:'',
        'fedc'=>(isset($request->fedc))?$request->fedc:'',
        'car'=>(isset($request->car))?$request->car:0,'car_lp'=>(isset($request->car_lp))?$request->car_lp:'',
        'nmc'=>(isset($request->nmc))?implode(',',$request->nmc):'','ofa'=>(isset($request->ofa))?$request->ofa:'',
        'status'=>'NJ','remark'=>$request->remark,'em_type'=>$request->type_em,
        'location'=>$request->locat,'company'=>$request->compa,'rfm_nfb'=>$request->rfm_nfb,'approve'=>0,
        'imd_id'=>$request->imr,'rfm_emp_id'=>$request->rfm_trans
      ]);
      if (isset($request->ren_name)) {
        employee_resign::onlyTrashed()->where('id', $request->ren_name)
        ->update(['replace'=>2]);
      }
      if ($request->rfm_id==2) {
        $statapp=$this->makeapprove($request,3);
      }else {
        $statapp=$this->makeapprove($request,1);
      }
      if ($statapp) {
          Mail::to(mail_group::find(1))->send(new notihr(user_dashboard_detail::find($manpowerreq->id)));
          if ($request->com_id>0) {
          Mail::to(mail_group::find(2))->send(new prenotimis(user_dashboard_detail::find($manpowerreq->id)));
        }
        if ($request->fedc>0) {
          Mail::to(mail_group::find(3))->send(new prenotiac(user_dashboard_detail::find($manpowerreq->id)));
        }
        if (strlen($request->nmc)>0||strlen($manpowerreq->ofa)>0) {
          Mail::to(mail_group::find(4))->send(new prenotiad(user_dashboard_detail::find($manpowerreq->id)));
        }
      }
        return redirect()->route('user_dashboard')->with('success', 'Request has been send');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(reqfm $manpowerreq)
    {
        $this->authorize('delete', $manpowerreq);
        $manpowerreq->update(['status'=>'CN']);
        return redirect()->route('user_dashboard')->with('success', 'Request has been cancle');
    }

    public function getacc(position $manpowerreq)
    {
        return (string) DB::table('acereqs')->where('grade', '<=', $manpowerreq->grade)->get();
        /*return (string) acereq::selectac($manpowerreq->grade)->get();*/
    }

    public function getcomdesc($manpowerreq)
    {
        $data=DB::table('comreqs')->where('barcode', $manpowerreq)->first();
        return json_encode(['barcode'=>$data->barcode,'grade'=>$data->grade,
      'item_desc'=>$data->item_desc,'detail'=>$data->detail]);
    }

    public function getcom(position $manpowerreq)
    {
        return (string) DB::table('comreqs')->where('grade','<=',$manpowerreq->grade)->get();
        /*return (string) comreq::selectcom($manpowerreq->grade)->get();*/
    }

    public function save(manpowerform $request)
    {
        $id=$this->getidman();
        reqfm::create([
        'id'=>$id,'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eed,'position_id'=>$request->posit,
        'rfm_id'=>$request->rfm,'ren_name'=>(isset($request->ren_name))?$request->ren_name:'',
        'jt_id'=>$request->jt,'tw_lead'=>(isset($request->tw_lead))?$request->tw_lead:0,
        'tw_lead_type'=>(isset($request->tw_lead_type))?$request->tw_lead_type:0,
        'jd'=>$request->jd,'sex'=>$request->sex,'count'=>$request->js1_count,
        'age'=>$request->age,'edu_id'=>implode(',',$request->deg),'fac_id'=>implode(',',$request->fac),
        'exp'=>$request->exp,
        'exp_year'=>(isset($request->exp_year))?$request->exp_year:0,'qua'=>$request->qua,
        'com_id'=>$request->com_id,'sw'=>(isset($request->sw))?implode(',',$request->sw):'',
        'sw_etc_spc'=>(isset($request->sw_etc_spc))?$request->sw_etc_spc:'',
        'ac'=>(isset($request->ac))?implode(',',$request->ac):'',
        'ac_etc_spc'=>(isset($request->ac_etc_spc))?$request->ac_etc_spc:'',
        'fedc'=>(isset($request->fedc))?$request->fedc:'',
        'car'=>(isset($request->car))?$request->car:0,'car_lp'=>(isset($request->car_lp))?$request->car_lp:'',
        'nmc'=>(isset($request->nmc))?implode(',',$request->nmc):'','ofa'=>(isset($request->ofa))?$request->ofa:'',
        'user_id'=>$request->user()->username,'status'=>'NP','remark'=>$request->remark,'em_type'=>$request->type_em,
        'location'=>$request->locat,'company'=>$request->compa,'rfm_nfb'=>$request->rfm_nfb,'approve'=>0,
        'imd_id'=>$request->imr,'rfm_emp_id'=>$request->rfm_trans
      ]);
        return redirect()->route('user_dashboard')->with('success', 'Request has been saved');
    }

    public function updatesave(manpowerform $request, reqfm $manpowerreq)
    {
        $this->authorize('updatesave', $manpowerreq);
        $manpowerreq->update([
        'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eed,'position_id'=>$request->posit,
        'rfm_id'=>$request->rfm,'ren_name'=>(isset($request->ren_name))?$request->ren_name:'',
        'jt_id'=>$request->jt,'tw_lead'=>(isset($request->tw_lead))?$request->tw_lead:0,
        'tw_lead_type'=>(isset($request->tw_lead_type))?$request->tw_lead_type:0,
        'jd'=>$request->jd,'sex'=>$request->sex,'count'=>$request->js1_count,
        'age'=>$request->age,'edu_id'=>implode(',',$request->deg),'fac_id'=>implode(',',$request->fac),
        'exp'=>$request->exp,
        'exp_year'=>(isset($request->exp_year))?$request->exp_year:0,'qua'=>$request->qua,
        'com_id'=>$request->com_id,'sw'=>(isset($request->sw))?implode(',',$request->sw):'',
        'sw_etc_spc'=>(isset($request->sw_etc_spc))?$request->sw_etc_spc:'',
        'ac'=>(isset($request->ac))?implode(',',$request->ac):'',
        'ac_etc_spc'=>(isset($request->ac_etc_spc))?$request->ac_etc_spc:'',
        'fedc'=>(isset($request->fedc))?$request->fedc:'',
        'car'=>(isset($request->car))?$request->car:0,'car_lp'=>(isset($request->car_lp))?$request->car_lp:'',
        'nmc'=>(isset($request->nmc))?implode(',',$request->nmc):'','ofa'=>(isset($request->ofa))?$request->ofa:'',
        'status'=>'NP','remark'=>$request->remark,'em_type'=>$request->type_em,
        'location'=>$request->locat,'company'=>$request->compa,'rfm_nfb'=>$request->rfm_nfb,'approve'=>0,
        'imd_id'=>$request->imr,'rfm_emp_id'=>$request->rfm_trans
      ]);
        return redirect()->route('user_dashboard')->with('success', 'Request has been saved');
    }

    public function restore(manpowerform $request, reqfm $manpowerreq)
    {
        $id=$this->getidman();
        $data=reqfm::create([
        'id'=>$id,'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eed,'position_id'=>$request->posit,
        'rfm_id'=>$request->rfm,'ren_name'=>(isset($request->ren_name))?$request->ren_name:'',
        'jt_id'=>$request->jt,'tw_lead'=>(isset($request->tw_lead))?$request->tw_lead:0,
        'tw_lead_type'=>(isset($request->tw_lead_type))?$request->tw_lead_type:0,
        'jd'=>$request->jd,'sex'=>$request->sex,'count'=>$request->js1_count,
        'age'=>$request->age,'edu_id'=>implode(',',$request->deg),'fac_id'=>implode(',',$request->fac),
        'exp'=>$request->exp,
        'exp_year'=>(isset($request->exp_year))?$request->exp_year:0,'qua'=>$request->qua,
        'com_id'=>$request->com_id,'sw'=>(isset($request->sw))?implode(',',$request->sw):'',
        'sw_etc_spc'=>(isset($request->sw_etc_spc))?$request->sw_etc_spc:'',
        'ac'=>(isset($request->ac))?implode(',',$request->ac):'',
        'ac_etc_spc'=>(isset($request->ac_etc_spc))?$request->ac_etc_spc:'',
        'fedc'=>(isset($request->fedc))?$request->fedc:'',
        'car'=>(isset($request->car))?$request->car:0,'car_lp'=>(isset($request->car_lp))?$request->car_lp:'',
        'nmc'=>(isset($request->nmc))?implode(',',$request->nmc):'','ofa'=>(isset($request->ofa))?$request->ofa:'',
        'user_id'=>$request->user()->username,'status'=>'NJ','remark'=>$request->remark,'em_type'=>$request->type_em,
        'location'=>$request->locat,'company'=>$request->compa,'rfm_nfb'=>$request->rfm_nfb,'approve'=>0,
        'imd_id'=>$request->imr,'rfm_emp_id'=>$request->rfm_trans
      ]);
        $manpowerreq->delete();
        if (isset($request->ren_name)) {
          employee_resign::onlyTrashed()->where('id', $request->ren_name)
          ->update(['replace'=>2]);
        }
        if ($data->rfm_id==2) {
          $statapp=$this->makeapprove($data,3);
        }else {
          $statapp=$this->makeapprove($data,1);
        }
        if ($statapp) {
          Mail::to(mail_group::find(1))->send(new notihr(user_dashboard_detail::find($data->id)));
        if ($data->com_id>0) {
          Mail::to(mail_group::find(2))->send(new prenotimis(user_dashboard_detail::find($data->id)));
        }
        if ($data->fedc>0) {
          Mail::to(mail_group::find(3))->send(new prenotiac(user_dashboard_detail::find($data->id)));
        }
        if (strlen($data->nmc)>0||strlen($data->ofa)>0) {
          Mail::to(mail_group::find(4))->send(new prenotiad(user_dashboard_detail::find($data->id)));
        }
        }
        return redirect()->route('user_dashboard')->with('success', 'Request has been send');
    }

    public function resave(manpowerform $request, reqfm $manpowerreq)
    {
        $id=$this->getidman();
        reqfm::create([
        'id'=>$id,'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eed,'position_id'=>$request->posit,
        'rfm_id'=>$request->rfm,'ren_name'=>(isset($request->ren_name))?$request->ren_name:'',
        'jt_id'=>$request->jt,'tw_lead'=>(isset($request->tw_lead))?$request->tw_lead:0,
        'tw_lead_type'=>(isset($request->tw_lead_type))?$request->tw_lead_type:0,
        'jd'=>$request->jd,'sex'=>$request->sex,'count'=>$request->js1_count,
        'age'=>$request->age,'edu_id'=>implode(',',$request->deg),'fac_id'=>implode(',',$request->fac),
        'exp'=>$request->exp,
        'exp_year'=>(isset($request->exp_year))?$request->exp_year:0,'qua'=>$request->qua,
        'com_id'=>$request->com_id,'sw'=>(isset($request->sw))?implode(',',$request->sw):'',
        'sw_etc_spc'=>(isset($request->sw_etc_spc))?$request->sw_etc_spc:'',
        'ac'=>(isset($request->ac))?implode(',',$request->ac):'',
        'ac_etc_spc'=>(isset($request->ac_etc_spc))?$request->ac_etc_spc:'',
        'fedc'=>(isset($request->fedc))?$request->fedc:'',
        'car'=>(isset($request->car))?$request->car:0,'car_lp'=>(isset($request->car_lp))?$request->car_lp:'',
        'nmc'=>(isset($request->nmc))?implode(',',$request->nmc):'','ofa'=>(isset($request->ofa))?$request->ofa:'',
        'user_id'=>$request->user()->username,'status'=>'NP','remark'=>$request->remark,'em_type'=>$request->type_em,
        'location'=>$request->locat,'company'=>$request->compa,'rfm_nfb'=>$request->rfm_nfb,'approve'=>0,
        'imd_id'=>$request->imr,'rfm_emp_id'=>$request->rfm_trans
      ]);
        $manpowerreq->delete();
        return redirect()->route('user_dashboard')->with('success', 'Request has been send');
    }

    public function rating(Request $request, reqfm $manpowerreq)
    {
        $this->validate($request, [
        'ratingval'=>'required|numeric',
        'comment'=>'nullable|string'
      ], ['ratingval.required'=>'Please Select Rating']);
        $manpowerreq->update(['rate'=>$request->ratingval,
      'comment'=>$request->comment,'status'=>'SC']);
        return redirect()->route('user_dashboard')->with('success', 'Evaluate Saved');
    }

    public function approvel(functionmaster $value)
    {
      $data=[];
      if (approve_func::getmydep($value->id)->first()) {
        foreach (approve_func::getmydep($value->id)->first()->getappmem()->OrderBy('level','ASC')->get() as $values) {
          $name=employee::find($values->employee_id);
          $data[]=$name->fname_en.' '.$name->lname_en;
        }
      }
      if (count($data)===0) {
        $data[]='No Approval';
      }
      return json_encode($data);
    }
}
