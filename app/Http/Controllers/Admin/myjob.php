<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\user_dashboard_detail;
use App\Model\Form\request AS req;
use Carbon\Carbon;
use App\Model\Masterdata\employee;
use App\Model\Masterdata\employee_resign;
use App\Model\Masterdata\acereq;
use App\Model\Masterdata\softreq;
use App\Model\Form\employee_new;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Model\Masterdata\mail_group;
use App\Model\User\user_resign_detail;
use App\Model\Form\resign;
use App\Mail\notiea;
use App\Mail\notimis;
use App\Mail\notiac;
use App\Mail\notiad;
use App\Mail\notiearesign;
use App\Model\Misticket\logform;
use App\Model\Misticket\logprob;
use App\Mail\noticn;
use App\Mail\noticnresign;

class myjob extends Controller
{
  public function getidmis(){
    $id=logform::where('idjob','LIKE',Carbon::now()->format('ymd').'%')->max('idjob');
    return (isset($id))?$id+1:Carbon::now()->format('ymd').'001';
  }

  public function createticket(user_dashboard_detail $myjob){
    $prob=null;
    $ace=$soft=[];
    $effdate=Carbon::parse($myjob->effect_date)->format('d m Y');
    if (strlen($myjob->sw)>0) {
      foreach (explode(',',$myjob->sw) as $value) {
        $soft[]=softreq::find($value)->name;
      }
      $soft=implode(', ',$soft);
    }else {
      $soft=null;
    }
    if (strlen($myjob->ac)>0) {
      foreach (explode(',',$myjob->ac) as $value) {
        $ace[]=acereq::find($value)->name;
      }
      $ace=implode(', ',$ace);
    }else {
      $ace=null;
    }
    foreach (employee_new::where('id',$myjob->id)->get() as $value) {
$prob=<<<EOT
New Hire Request
Name Th: {$value->name_th}
Name EN: {$value->name_en}
Position: {$myjob->position}
Level: {$myjob->grade}
Effective date: {$effdate}
Computer Spec: {$myjob->item_desc}
{$myjob->detail}
Software: {$soft}
Accessories: {$ace}
EOT;
$datalf=logform::create([
  'idjob'=>$this->getidmis(),
  'iduser'=>auth()->user()->username,
  'status'=>'sj',
  'location'=>strtoupper($myjob->location),
  'problem'=>$prob,
  'time'=>Carbon::now()->format('Y-m-d H:i:s')
]);
logprob::create([
  'idjob'=>$datalf->idjob,
  'type'=>'hardware',
  'prob'=>'New Hire'
]);
    }
  }

  public function createticketrsg(user_resign_detail $myjob){
    $prob=null;
    $ace=$soft=[];
    $effdate=Carbon::parse($myjob->effect_date)->format('d m Y');
    $emp_txt=employee::find($myjob->code);
$prob=<<<EOT
Resign Request
Code: {$myjob->code}
Name Th: {$emp_txt->fname_th} {$emp_txt->lname_th}
Name EN: {$emp_txt->fname_en} {$emp_txt->lname_en}
Position: {$emp_txt->posit}
Effective date: {$effdate}
EOT;
$datalf=logform::create([
  'idjob'=>$this->getidmis(),
  'iduser'=>auth()->user()->username,
  'status'=>'sj',
  'location'=>$emp_txt->branch_code,
  'problem'=>$prob,
  'time'=>Carbon::now()->format('Y-m-d H:i:s')
]);
logprob::create([
  'idjob'=>$datalf->idjob,
  'type'=>'hardware',
  'prob'=>'Resign'
]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.myjob.index',[
          'aj'=>user_dashboard_detail::myjob()->whereIn('status',['AJ'])->get(),
          'sc'=>user_dashboard_detail::myjob()->whereIn('status',['SC'])->get(),
          'raj'=>user_resign_detail::myjob()->whereIn('status',['AJ'])->get(),
          'rsc'=>user_resign_detail::myjob()->whereIn('status',['SC'])->get(),
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(req $myjob)
    {
       $this->authorize('showmyjob', $myjob);
        return view('admin.myjob.personaldata',['data'=>$myjob]);
    }

    public function showrsg(resign $myjob)
    {
        return view('admin.myjob.rsg',['data'=>$myjob]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(req $myjob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,req $myjob){
      $this->authorize('updatemyjob', $myjob);
      $this->validate($request,[
        'fname.*'=>'required|string',
        'lname.*'=>'required|string',
        'tfname.*'=>'required|string',
        'tlname.*'=>'required|string',
        'sjdate.*'=>'required|date|date_format:Y-m-d|after:now',
        'remark'=>'nullable|string',
        'code.*'=>'required|string|unique:employee_news,code',
      ]);
      if(count(collect($request->code)->unique()->values()->all())<>count($request->code)){
        return redirect()->route('myjob.index')->withErrors(['Code'=>'Code employee must be different']);
      }
      foreach ($request->fname as $key => $value) {
        employee_new::create([
          'id'=>$myjob->id,
          'name_en'=>$value.' '.$request->lname[$key],
          'name_th'=>$request->tfname[$key].' '.$request->tlname[$key],
          'date_work'=>$request->sjdate[$key],
          'code'=>$request->code[$key]
        ]);
      }
      $myjob->update([
        'em_remark'=>$request->remark,
        'status'=>'SC',
        'time_end'=>Carbon::now()->format('Y-m-d')
      ]);
      $this->createticket(user_dashboard_detail::find($myjob->id));
      /*Mail::to(User::where('username',$myjob->user_id)->first())->send(new notiea(user_dashboard_detail::find($myjob->id)));*/
      if ($myjob->com_id>0) {
      Mail::to(mail_group::find(2))->send(new notimis(user_dashboard_detail::find($myjob->id)));
    }
      if ($myjob->fedc==1) {
        Mail::to(mail_group::find(3))->send(new notiac(user_dashboard_detail::find($myjob->id)));
      }
      if ($myjob->nmc==1||strlen($myjob->ofa)>0) {
        Mail::to(mail_group::find(4))->send(new notiad(user_dashboard_detail::find($myjob->id)));
      }
        return redirect()->route('myjob.index')->with('success','Request Close');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,req $myjob){
        $this->authorize('cancelman', $myjob);
        $this->validate($request,[
          'remark'=>'nullable|string'
        ]);
        $myjob->update([
          'em_remark'=>$request->remark,
          'status'=>'CN'
        ]);
        Mail::to(User::where('username',$myjob->user_id)->first())->send(new noticn(user_dashboard_detail::find($myjob->id)));
        $myjob->delete();
        return redirect()->route('myjob.index')->with('success','Request Cancel');
    }

    public function destroyresign(Request $request,resign $myjob){
      $this->authorize('cancelrsg', $myjob);
      $this->validate($request,[
        'remark'=>'nullable|string'
      ]);
      $myjob->update([
        'em_remark'=>$request->remark,
        'status'=>'CN'
      ]);
      Mail::to(User::where('username',$myjob->user_id)->first())->send(new noticnresign(user_resign_detail::find($myjob->id)));
      $myjob->delete();
      return redirect()->route('myjob.index')->with('success','Request Cancel');
    }

    public function updatersg(Request $request,resign $myjob){
      $this->validate($request,[
        'remark'=>'nullable|string'
      ]);
      $myjob->update([
        'em_remark'=>$request->remark,
        'status'=>'SC',
        'time_end'=>Carbon::now()->format('Y-m-d')
      ]);
      employee_resign::onlyTrashed()->where('id',$myjob->code)->update(['replace'=>1]);
      $this->createticketrsg(user_resign_detail::find($myjob->id));
      /*Mail::to(User::where('username',$myjob->user_id)->first())->send(new notiearesign(user_resign_detail::find($myjob->id)));*/
      return redirect()->route('myjob.index')->with('success','Request Close');
    }

    public function showmancn(req $myjob){
      return view('admin.myjob.cancelman',['data'=>$myjob]);
    }

    public function showrsgcn(resign $myjob){
      return view('admin.myjob.cancelrsg',['data'=>$myjob]);
    }
}
