<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Form\resign as rsn;
use App\Http\Requests\resignupdate;
use App\Http\Requests\resign as rsf;
use Carbon\Carbon;
use App\Model\Masterdata\employee_resign_use;
use App\Model\Masterdata\employee;
use App\Model\User\user_resign_detail;
use App\Model\Masterdata\employee_resign;
use Illuminate\Support\Facades\Mail;
use App\Model\Masterdata\mail_group;
use App\Mail\notiresign;
use App\Mail\notiresignem;
use App\Model\Masterdata\approve;
use App\Model\Masterdata\approve_func;
use App\Mail\notiapproversg;

class Resign extends Controller
{
  protected function getidrsg(){
    $id=rsn::withTrashed()->where('id', 'LIKE', Carbon::now()->format('ymd').'%')->max('id');
    return (isset($id))?$id+1:Carbon::now()->format('ymd').'001';
  }
  protected function makeapprove(rsn $data)
  {
    $appraw=approve_func::getmydep(2)->first();
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
          'type'=>2,
          'user_id'=>$value->employee_id,
          'level'=>$value->level,
          'status'=>0
        ]);
      }
      $this->checknextapp($data->id,2);
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
  protected function checknextapp($id,$type=2){
    $getminlv=approve::where(['request_id'=>$id,'type'=>$type,'status'=>0])
    ->min('level');
    $getrowapp=approve::where(['request_id'=>$id,'type'=>$type,'status'=>0,'level'=>$getminlv]);
      foreach ($getrowapp->get() as $value) {
        Mail::to($value->getemployee()->first())
        ->send(new notiapproversg(user_resign_detail::find($id)));
      }
      $getrowapp->update([
          'status'=>1
        ]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $applist=approve_func::getmydep(2)->first();
        return view('user.formreq.rsg', [
          'data'=>employee_resign_use::emp()->get(),
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(rsf $request)
    {
        $id=$this->getidrsg();
        $data=rsn::create([
        'id'=>$id,'user_id'=>$request->user()->username,'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eft,'status'=>'NJ','remark'=>$request->rk,'code'=>$request->user,
        'last_date'=>$request->lfw,'reason'=>$request->rsn,'approve'=>0
      ]);
        employee_resign::where('id', $request->user)->delete();
        if ($this->makeapprove($data)) {
          Mail::to(mail_group::find(1))->send(new notiresign(user_resign_detail::find($data->id)));
          Mail::to(mail_group::find(2))->send(new notiresignem(user_resign_detail::find($data->id)));
          Mail::to(mail_group::find(3))->send(new notiresignem(user_resign_detail::find($data->id)));
          Mail::to(mail_group::find(4))->send(new notiresignem(user_resign_detail::find($data->id)));
        }
        return redirect()->route('user_dashboard')->with('success', 'Request Sended');
    }

    public function save(rsf $request)
    {
        $id=$this->getidrsg();
        rsn::create([
        'id'=>$id,'user_id'=>$request->user()->username,'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eft,'status'=>'NP','remark'=>$request->rk,'code'=>$request->user,
        'last_date'=>$request->lfw,'reason'=>$request->rsn,'approve'=>0
      ]);
        employee_resign::where('id', $request->user)->delete();
        return redirect()->route('user_dashboard')->with('success', 'Request Sended');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(employee $resignreq)
    {
        return json_encode(['fname_en'=>$resignreq->fname_en,'lname_en'=>$resignreq->lname_en,
      'posit'=>$resignreq->posit,'dep'=>$resignreq->dep]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(rsn $resignreq)
    {
        $this->authorize('edit', $resignreq);
        $applist=approve_func::getmydep(2)->first();
        return view('user.formreq.editrsg', [
          'data'=>$resignreq,
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
    public function update(resignupdate $request, rsn $resignreq)
    {
        $this->authorize('edit', $resignreq);
        $resignreq->update([
          'time_str'=>Carbon::now()->format('ymd'),
          'effect_date'=>$request->eft,'status'=>'NJ','remark'=>$request->rk,
          'last_date'=>$request->lfw,'reason'=>$request->rsn,'approve'=>0
        ]);
        employee_resign::where('id', $resignreq->code)->delete();
        if ($this->makeapprove($resignreq)) {
          Mail::to(mail_group::find(1))->send(new notiresign(user_resign_detail::find($resignreq->id)));
          Mail::to(mail_group::find(2))->send(new notiresignem(user_resign_detail::find($resignreq->id)));
          Mail::to(mail_group::find(3))->send(new notiresignem(user_resign_detail::find($resignreq->id)));
          Mail::to(mail_group::find(4))->send(new notiresignem(user_resign_detail::find($resignreq->id)));
        }
        return redirect()->route('user_dashboard')->with('success', 'Request has been sended');
    }

    public function upsave(resignupdate $request, rsn $resignreq)
    {
        $this->authorize('edit', $resignreq);
        $resignreq->update([
        'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eft,'status'=>'NP','remark'=>$request->rk,
        'last_date'=>$request->lfw,'reason'=>$request->rsn,'approve'=>0
      ]);
        employee_resign::where('id', $resignreq->code)->delete();
        return redirect()->route('user_dashboard')->with('success', 'Request has been saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(rsn $resignreq)
    {
        $this->authorize('delete', $resignreq);
        $resignreq->update(['status'=>'CN']);
        employee_resign::onlyTrashed()->where('id', $resignreq->code)->restore();
        return redirect()->route('user_dashboard')->with('success', 'Request has been cancle');
    }

    public function showcn(rsn $resignreq)
    {
        $this->authorize('showcn', $resignreq);
        $applist=approve_func::getmydep(2)->first();
        return view('user.formreq.duplicatersg', [
          'data'=>$resignreq,
          'applist'=>($applist)?$applist->getappmem()->OrderBy('level','ASC')->get():[]
        ]);
    }

    public function resave(resignupdate $request, rsn $resignreq)
    {
        $this->authorize('showcn', $resignreq);
        $id=$this->getidrsg();
        rsn::create([
        'id'=>$id,'user_id'=>$request->user()->username,'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eft,'status'=>'NP','remark'=>$request->rk,'code'=>$resignreq->code,
        'last_date'=>$request->lfw,'reason'=>$request->rsn,'approve'=>0
      ]);
        $resignreq->delete();
        employee_resign::where('id', $resignreq->code)->delete();
        return redirect()->route('user_dashboard')->with('success', 'Request Saved');
    }

    public function restore(resignupdate $request, rsn $resignreq)
    {
        $this->authorize('showcn', $resignreq);
        $id=$this->getidrsg();
        $data=rsn::create([
        'id'=>$id,'user_id'=>$request->user()->username,'time_str'=>Carbon::now()->format('ymd'),
        'effect_date'=>$request->eft,'status'=>'NJ','remark'=>$request->rk,'code'=>$resignreq->code,
        'last_date'=>$request->lfw,'reason'=>$request->rsn,'approve'=>0
      ]);
        $resignreq->delete();
        if ($this->makeapprove($data)) {
          employee_resign::where('id', $resignreq->code)->delete();
          Mail::to(mail_group::find(1))->send(new notiresign(user_resign_detail::find($data->id)));
          Mail::to(mail_group::find(2))->send(new notiresignem(user_resign_detail::find($data->id)));
          Mail::to(mail_group::find(3))->send(new notiresignem(user_resign_detail::find($data->id)));
          Mail::to(mail_group::find(4))->send(new notiresignem(user_resign_detail::find($data->id)));
        }
        return redirect()->route('user_dashboard')->with('success', 'Request Sended');
    }

    public function detail(user_resign_detail $resignreq)
    {
        $this->authorize('view', $resignreq);
        return view('user.dashboard.detailrgn', [
          'fm'=>$resignreq,
          'apl'=>approve::withTrashed()->listapp([$resignreq->id,[2]])->get()
        ]);
    }

    public function updatersg(Request $request, rsn $resignreq)
    {
        $this->authorize('updatersg', $resignreq);
        $this->validate($request, [
        'ratingval'=>'required|numeric',
        'comment'=>'nullable|string'
      ]);
        $resignreq->update([
        'rate'=>$request->ratingval,
        'comment'=>$request->comment,
        'status'=>'SC'
      ]);
        return redirect()->route('user_dashboard')->with('success', 'Evaluate Saved');
    }
}
