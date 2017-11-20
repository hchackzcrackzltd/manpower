<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Eform\eform_form;
use App\Model\Eform\tagcandidate_view;
use App\Model\Masterdata\cannidate_interest;
use Illuminate\Support\Facades\Mail;
use App\Mail\noticandiate_new;
use App\Mail\candidate_share;
use App\Model\Masterdata\employee;
use App\Model\User\authorize;
use App\Mail\test;

class CandidateSearch extends Controller
{
    public function index()
    {
      $this->authorize("accan",authorize::getau(4)->first());
        return view('user.candidate.index',['data'=>eform_form::with([
          'getposition'=>function($value)
          {
            $value->where('no',0);
          },'getedu','gethisjob','getfile'])->get(),'emm'=>employee::where('email','<>','')->get()]);
    }

    public function search(Request $req)
    {
      $this->authorize("accan",authorize::getau(4)->first());
      $this->validate($req, [
        'posit'=>'nullable|exists:eform.form_posits,id',
        'exp'=>'nullable|string',
        'edu.*'=>'nullable|exists:eform.master_edus,id',
        'age'=>'nullable|string',
        'sex'=>'nullable|numeric|in:1,2,100',
        'eq'=>'nullable|string',
        'iq'=>'nullable|string',
      ]);
      $id=[];
      foreach (tagcandidate_view::tag($req->all())->get() as $value) {
        $id[]=$value->form_id;
      }
      return view('user.candidate.index',['data'=>eform_form::with([
        'getposition'=>function($value)
        {
          $value->where('no',0);
        },'getedu','gethisjob'])->whereIn('id',(count($id)>0)?$id:[0])->get(),
      'emm'=>employee::where('email','<>','')->get()]);
    }

    public function detail(eform_form $id)
    {
      $this->authorize("accan",authorize::getau(4)->first());
      return view('user.candidate.candidate_detail',[
        'data'=>$id->load(['getposition','getbrosis','getedu','getfam','gethisjob','getlang',
        'gettrn','getfile']),
        'master_titlename'=>['นาย','นาง','นางสาว'],
        'master_titlenameeng'=>['Mr.','Mrs.','Miss.'],
        'master_mlitary'=>[1=>'เกณฑ์แล้ว Yes',2=>'ยังไม่เกณฑ์ No',3=>'ได้รับการยกเว้นเพราะ If exempted specify reason'],
        'master_lang'=>['ไม่ได้ Poor','พอใช้  Fair','ดี  Good','ดีมาก Excellent']
        ]);
    }

    public function getattech(eform_form $id,$no)
    {
      $this->authorize("accan",authorize::getau(4)->first());
      $fm=$id->load('getfile');
      $ext=$fm->getfile->where('no',$no)->first();
      return response()->file(storage_path('app/exports/'.$ext->temp),["Content-Disposition"=>"inline; filename='{$ext->name}'"]);
    }

    public function send(Request $req,eform_form $id)
    {
      $this->authorize("accan",authorize::getau(4)->first());
      $this->validate($req,['req'=>"required|checkcanexist:{$id->id}|exists:user_dashboard_details,id"],['req.required'=>'Plase Select Position']);
      $data=cannidate_interest::create([
        'cannidate_id'=>$id->id,'user_id'=>auth()->user()->username,
        'manpower_id'=>$req->req
      ]);
      $id->update([
        'interest'=>$id->interest+1
      ]);
      Mail::to(employee::find(cannidate_interest::with('getmanpower')->find($data->id)->getmanpower->user_em_id))->send(new noticandiate_new($data));
      return redirect()->route('candidatesh.index')->with(['success'=>'Request Sended']);
    }

    public function share(Request $req)
    {
      $this->validate($req,['link'=>'required|url','emm'=>'required|array','emm.*'=>'required|exists:mysql.employee_com,id']);
      foreach ($req->emm as $value) {
        $usermailto=employee::find($value);
      Mail::to($usermailto)->send(new candidate_share($usermailto,$req->link));
      }
      return redirect()->route('candidatesh.index')->with(['success'=>'Candidate Share']);
    }
}
