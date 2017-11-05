<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Masterdata\approve as apv;
use App\Model\Form\request as reqfm;
use App\Model\Form\resign as rsn;
use App\Model\Masterdata\functionmaster;
use App\Model\User\authorize;
use App\Model\User\user_dashboard_detail;
use App\Model\User\user_resign_detail;
use Illuminate\Support\Facades\Mail;
use App\Mail\notiapproversg;
use App\Mail\notiapprove;
use App\Mail\notihr;
use App\Mail\prenotiac;
use App\Mail\prenotiad;
use App\Mail\prenotimis;
use App\Mail\notiresign;
use App\Mail\notiresignem;
use App\Mail\noticnapprove;
use App\Mail\noticnapproversg;
use App\Model\Masterdata\mail_group;
use App\Mail\notiapproved;
use App\Mail\notiapprovedrsg;
use App\Model\Masterdata\employee;

class ApproveUser extends Controller
{
  protected function checknextapp($id,$type){
    $getminlv=apv::where(['request_id'=>$id,'type'=>$type,'status'=>0])
    ->min('level');
    $getrowapp=apv::where(['request_id'=>$id,'type'=>$type,'status'=>0,'level'=>$getminlv]);
    if ($getrowapp->first()) {
        if ($type==2) {
          foreach ($getrowapp->get() as $value) {
            Mail::to($value->getemployee()->first())
            ->send(new notiapproversg(user_resign_detail::find($id)));
          }
        }else {
          foreach ($getrowapp->get() as $value) {
            Mail::to($value->getemployee()->first())
            ->send(new notiapprove(user_dashboard_detail::find($id)));
          }
        }
        $getrowapp->update([
            'status'=>1
          ]);
    }else {
      switch ($type) {
        case 1:
          reqfm::find($id)->update(['approve'=>1]);
          $daman=user_dashboard_detail::find($id);
          Mail::to(employee::find($daman->user_id))->send(new notiapproved($daman));
          Mail::to(mail_group::find(1))->send(new notihr($daman));
          if ($daman->com_id>0) {
            Mail::to(mail_group::find(2))->send(new prenotimis($daman));
          }
          if ($daman->fedc>0) {
            Mail::to(mail_group::find(3))->send(new prenotiac($daman));
          }
          if (strlen($daman->nmc)>0||strlen($daman->ofa)>0) {
            Mail::to(mail_group::find(4))->send(new prenotiad($daman));
          }
          break;
        case 2:
            rsn::find($id)->update(['approve'=>1]);
            $darsg=user_resign_detail::find($id);
            Mail::to(employee::find($darsg->user_id))->send(new notiapprovedrsg($darsg));
            Mail::to(mail_group::find(1))->send(new notiresign($darsg));
            Mail::to(mail_group::find(2))->send(new notiresignem($darsg));
            Mail::to(mail_group::find(3))->send(new notiresignem($darsg));
            Mail::to(mail_group::find(4))->send(new notiresignem($darsg));
          break;
        case 3:
            reqfm::find($id)->update(['approve'=>1]);
            $daman=user_dashboard_detail::find($id);
            Mail::to(employee::find($daman->user_id))->send(new notiapproved($daman));
            Mail::to(mail_group::find(1))->send(new notihr($daman));
            if ($daman->com_id>0) {
              Mail::to(mail_group::find(2))->send(new prenotimis($daman));
            }
            if ($daman->fedc>0) {
              Mail::to(mail_group::find(3))->send(new prenotiac($daman));
            }
            if (strlen($daman->nmc)>0||strlen($daman->ofa)>0) {
              Mail::to(mail_group::find(4))->send(new prenotiad($daman));
            }
        break;
      }
    }
  }
  public function updateapp(functionmaster $type,apv $app){
    $this->authorize('acapp',authorize::getau(3)->first());
    $this->authorize('myapp',apv::myapp([$app->request_id,$type->id])->first());
    $app1=apv::where([
      'request_id'=>$app->request_id,
      'type'=>$type->id,
      'user_id'=>auth()->user()->username,
      'status'=>1
    ]);
    if ($app1->first()) {
    $lavel=$app1->first()->level;
    $name=$app1->first()->getemployee()->first()->name;
    $app1->update([
      'status'=>2
    ]);
    apv::where([
      ['user_id','!=',auth()->user()->username],
      'request_id'=>$app->request_id,
      'type'=>$type->id,
      'level'=>$lavel,
      'status'=>1
      ])->update([
      'status'=>2,
      'reason'=>"Approved By {$name}"
    ]);
      $this->checknextapp($app->request_id,$type->id);
    }else {
      return redirect()->route('approveu.index')->withErrors(['Approve'=> 'Request Approved']);
    }
    return redirect()->route('approveu.index')->with('success', 'Request Approved');
  }

  public function destroyapp(Request $request,functionmaster $type,apv $app)
  {
    $this->authorize('acapp',authorize::getau(3)->first());
    $this->authorize('myapp',apv::myapp([$app->request_id,$type->id])->first());
    $this->validate($request,[
      'reason'=>'nullable|string'
    ]);
    $status=apv::where(['request_id'=>$app->request_id,'type'=>$type->id,
    'user_id'=>auth()->user()->username,'status'=>1])->
    update([
      'status'=>3,
      'reason'=>$request->reason
    ]);
    if ($status) {
    switch ($type->id) {
      case 1:
        reqfm::find($app->request_id)->update(['approve'=>0,'status'=>'CN']);
        $damanm=user_dashboard_detail::find($app->request_id);
        Mail::to($damanm->getnamereq()->first())
        ->send(new noticnapprove($damanm));
        break;
      case 2:
          rsn::find($app->request_id)->update(['approve'=>0,'status'=>'CN']);
          $darsgm=user_resign_detail::find($app->request_id);
          Mail::to($darsgm->getnamereq()->first())
          ->send(new noticnapproversg($darsgm));
        break;
      case 3:
          reqfm::find($app->request_id)->update(['approve'=>0,'status'=>'CN']);
          $damanm=user_dashboard_detail::find($app->request_id);
          Mail::to($damanm->getnamereq()->first())
          ->send(new noticnapprove($damanm));
        break;
    }
    apv::where(['request_id'=>$app->request_id,'type'=>$type->id])->delete();
    return redirect()->route('approveu.index')->with('success','Request has been reject');
    }
    return redirect()->route('approveu.index')->withErrors(['Reject','Request exists reject']);
  }

  public function index()
  {
    $this->authorize('acapp',authorize::getau(3)->first());
    return view('user.approve.index',[
      'app'=>apv::getmyapp([[1,3],[1]])->get(),
      'apprsg'=>apv::getmyapp([[2],[1]])->get(),
      'sapp'=>apv::getmyapp([[1,3],[2]])->get(),
      'sapprsg'=>apv::getmyapp([[2],[2]])->get(),
      'capp'=>apv::onlyTrashed()->getmyapp([[1,3],[1,3]])->get(),
      'capprsg'=>apv::onlyTrashed()->getmyapp([[2],[1,3]])->get(),
    ]);
  }

  public function detailman(user_dashboard_detail $id)
  {
    $this->authorize('acapp',authorize::getau(3)->first());
    if ($id->rfm_id==2) {
      $this->authorize('showapp',apv::withTrashed()->myapp([$id->id,3])->first());
    }else {
      $this->authorize('showapp',apv::withTrashed()->myapp([$id->id,1])->first());
    }
    return view('user.approve.detail',[
      'fm'=>$id,
      'apl'=>apv::withTrashed()->listapp([$id->id,[1,3]])->get()
    ]);
  }

  public function detailrsg(user_resign_detail $id)
  {
    $this->authorize('acapp',authorize::getau(3)->first());
    $this->authorize('showapp',apv::withTrashed()->myapp([$id->id,2])->first());
    return view('user.approve.detailrgn',[
      'fm'=>$id,
      'apl'=>apv::withTrashed()->listapp([$id->id,[2]])->get()
    ]);
  }

  public function manpage(user_dashboard_detail $id)
  {
    $this->authorize('acapp',authorize::getau(3)->first());
    $type=($id->rfm_id==2)?3:1;
    $this->authorize('myapp',apv::myapp([$id->id,$type])->first());
    return view('user.approve.approveman',[
      'fm'=>$id,
      'type_app'=>$type
    ]);
  }

  public function rsgpage(user_resign_detail $id)
  {
    $this->authorize('acapp',authorize::getau(3)->first());
    $this->authorize('myapp',apv::myapp([$id->id,2])->first());
    return view('user.approve.approversg',[
      'fm'=>$id
    ]);
  }
}
