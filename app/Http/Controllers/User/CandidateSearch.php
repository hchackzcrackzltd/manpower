<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Eform\eform_form;
use App\Model\Eform\tagcandidate;

class CandidateSearch extends Controller
{
    public function index()
    {
        return view('user.candidate.index',['data'=>eform_form::with([
          'getposition'=>function($value)
          {
            $value->where('no',0);
          },'getedu','gethisjob','getfile'])->get()]);
    }

    public function search(Request $req)
    {
      $this->validate($req, [
        'posit'=>'nullable|exists:eform.form_posits,id',
        'exp'=>'nullable|string',
        'edu.*'=>'nullable|exists:eform.master_edus,id',
        'age'=>'nullable|string',
        'sex'=>'nullable|numeric|in:0,1,2,100',
        'eq'=>'nullable|string',
        'iq'=>'nullable|string',
      ]);
      $id=[];
      foreach (tagcandidate::tag($req->all())->get() as $value) {
        $id[]=$value->form_id;
      }
      return view('user.candidate.index',['data'=>eform_form::with([
        'getposition'=>function($value)
        {
          $value->where('no',0);
        },'getedu','gethisjob'])->whereIn('id',(count($id)>0)?$id:[0])->get()]);
    }

    public function detail(eform_form $id)
    {
      return view('user.candidate.candidate_detail',[
        'data'=>$id->load(['getposition','getbrosis','getedu','getfam','gethisjob','getlang',
        'gettrn','getfile']),
        'master_titlename'=>['นาย','นาง','นางสาว'],
        'master_titlenameeng'=>['Mr.','Mrs.','Miss.'],
        'master_mlitary'=>[1=>'เกณฑ์แล้ว Yes',2=>'ยังไม่เกณฑ์ No',3=>'ได้รับการยกเว้นเพราะ If exempted specify reason'],
        'master_lang'=>['ไม่ได้เลย Poor','พอใช้  Fair','ดี  Good','ดีมาก Excellent']
        ]);
    }

    public function getattech(eform_form $id,$no)
    {
      $fm=$id->load('getfile');
      $ext=$fm->getfile->where('no',$no)->first();
      return response()->file(storage_path('app/exports/'.$ext->temp),["Content-Disposition"=>"inline; filename='{$ext->name}'"]);
    }

    public function send(Request $req)
    {
      $this->validate($req,['req'=>'required|exists:user_dashboard_details,id'],['req.required'=>'Plase Select Position']);
      return redirect()->route('candidatesh.index')->with(['success'=>'Request Sended']);
    }
}
