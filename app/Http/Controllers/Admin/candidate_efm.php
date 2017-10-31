<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Eform\eform_form;
use App\Model\Eform\tagcandidate;

class candidate_efm extends Controller
{
    public function index()
    {
      return view('admin.candidate.index_list',['data'=>eform_form::with('getposition')->status('OP')->get()]);
    }

    public function detail(eform_form $id)
    {
      return view('admin.candidate.candidate_detail',[
        'data'=>$id->load(['getposition','getbrosis','getedu','getfam','gethisjob','getlang',
        'gettrn','getfile']),
        'master_titlename'=>['นาย','นาง','นางสาว'],
        'master_titlenameeng'=>['Mr.','Mrs.','Miss.'],
        'master_mlitary'=>[1=>'เกณฑ์แล้ว Yes',2=>'ยังไม่เกณฑ์ No',3=>'ได้รับการยกเว้นเพราะ If exempted specify reason'],
        'master_lang'=>['ไม่ได้เลย Poor','พอใช้  Fair','ดี  Good','ดีมาก Excellent']
        ]);
    }

    public function destroy(eform_form $id)
    {
      tagcandidate::where('form_id',$id->id)->delete();
      $id->update(['status_can'=>'CN']);
      return redirect()->route('cannidate_new.index')->with('success', 'Resume Close');
    }

    public function history()
    {
      return view('admin.candidate.list_history',['data'=>eform_form::with('getposition')->status('CN')->get()]);
    }

    public function destroy_his(eform_form $id)
    {
      tagcandidate::where('form_id',$id->id)->delete();
      $id->delete();
      return redirect()->route('cannidate_new.history')->with('success', 'Resume has deleted');
    }

    public function recover(eform_form $id)
    {
      tagcandidate::onlyTrashed()->where('form_id',$id->id)->restore();
      $id->update(['status_can'=>'OP']);
      return redirect()->route('cannidate_new.index')->with('success', 'Resume has restore');
    }

    public function create(Request $request)
    {
      $this->validate($request,['file_im'=>'required|file|mimes:zip'],['file_im.required'=>'Plase Insert File'
      ,'file_im.mimes'=>'Support Only ZIP',]);
    }
}
