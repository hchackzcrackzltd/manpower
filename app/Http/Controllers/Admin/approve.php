<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Masterdata\functionmaster;
use App\Model\Masterdata\approve_func;
use App\Model\Masterdata\approve_mem;
use App\Model\Db_employee\department;
use App\Model\Db_employee\party;
use App\Model\Masterdata\employee;
use App\Model\Form\resign as rsgdb;
use App\Model\Form\request as mandb;
use App\Model\Masterdata\approve as abdb;
use Illuminate\Support\Facades\Mail;
use App\Mail\notiapprove;
use App\Mail\notiapproversg;
use App\Mail\notiresign;
use App\Mail\notiresignem;
use App\Mail\notihr;
use App\Mail\prenotiac;
use App\Mail\prenotiad;
use App\Mail\prenotimis;
use App\Model\Masterdata\mail_group;
use App\Model\User\user_dashboard_detail;
use App\Model\User\user_resign_detail;
use Illuminate\Support\Facades\Log;

class approve extends Controller
{
  public function __construct()
    {
        $this->middleware('checkmasterdata');
    }

    protected function refactor(approve_func $data)
    {
      $checknx=$this;
        employee::where(['party_code'=>$data->party_id,'dpm_code'=>$data->department_id])
        ->each(function($value) use ($data,$checknx){
          if ($data->function_id==1||$data->function_id==3) {
          mandb::where(['user_id'=>$value->code,'approve'=>0])->with(['getmyapp'=>function($value) use ($data){
            $value->whereIn('status',[0,1])->where('type',$data->function_id);
          }])->get()->each(function($value) use ($data,$checknx){
          $min=$value->getmyapp->min('level');
          $value->getmyapp->each(function($value){
            abdb::find($value->id)->forceDelete();
          });
          $rsl=$data->getappmem()->where('level','>=',intval($min))->get();
          if (count($rsl)===0) {
            mandb::find($value->id)->update(['approve'=>1]);
            Mail::to(mail_group::find(1))->send(new notihr(user_dashboard_detail::find($value->id)));
            if ($value->com_id>0) {
              Mail::to(mail_group::find(2))->send(new prenotimis(user_dashboard_detail::find($value->id)));
            }
            if ($value->fedc>0) {
              Mail::to(mail_group::find(3))->send(new prenotiac(user_dashboard_detail::find($value->id)));
            }
            if (strlen($value->nmc)>0||strlen($value->ofa)>0) {
              Mail::to(mail_group::find(4))->send(new prenotiad(user_dashboard_detail::find($value->id)));
            }
          }else {
          $rsl->each(function($values) use ($value,$data){
            abdb::create([
              'request_id'=>$value->id,
              'type'=>$data->function_id,
              'user_id'=>$values->employee_id,
              'level'=>$values->level,
              'status'=>0
            ]);
          });
          $checknx->checknextapp($value->id,$data->function_id);
        }
          });
        }else {
          rsgdb::where(['user_id'=>$value->code,'approve'=>0])->with(['getmyapp'=>function($value) use ($data){
            $value->whereIn('status',[0,1])->where('type',$data->function_id);
          }])->get()->each(function($value) use ($data,$checknx){
            $min=$value->getmyapp->min('level');
            $value->getmyapp->each(function($value){
              abdb::find($value->id)->forceDelete();
            });
            $rsl=$data->getappmem()->where('level','>=',intval($min))->get();
            if (count($rsl)===0) {
              rsgdb::find($value->id)->update(['approve'=>1]);
              Mail::to(mail_group::find(1))->send(new notiresign(user_resign_detail::find($value->id)));
              Mail::to(mail_group::find(2))->send(new notiresignem(user_resign_detail::find($value->id)));
              Mail::to(mail_group::find(3))->send(new notiresignem(user_resign_detail::find($value->id)));
              Mail::to(mail_group::find(4))->send(new notiresignem(user_resign_detail::find($value->id)));
            }else {
              $rsl->each(function($values) use ($value,$data){
                abdb::create([
                  'request_id'=>$value->id,
                  'type'=>$data->function_id,
                  'user_id'=>$values->employee_id,
                  'level'=>$values->level,
                  'status'=>0
                ]);
              });
              $checknx->checknextapprsg($value->id,$data->function_id);
            }
          });
        }
        });
    }

    protected function checknextapp($id,$type=1){
      $getminlv=abdb::where(['request_id'=>$id,'type'=>$type,'status'=>0])
      ->min('level');
      abdb::where(['request_id'=>$id,'type'=>$type,'status'=>0,'level'=>$getminlv])
      ->tap(function($values) use ($id){
        foreach ($values->get() as $value) {
          Mail::to($value->getemployee()->first())
          ->send(new notiapprove(user_dashboard_detail::find($id)));
        }
      })->update(['status'=>1]);
      return $getminlv;
    }

    protected function checknextapprsg($id,$type=2){
      $getminlv=abdb::where(['request_id'=>$id,'type'=>$type,'status'=>0])
      ->min('level');
      $getrowapp=abdb::where(['request_id'=>$id,'type'=>$type,'status'=>0,'level'=>$getminlv]);
        foreach ($getrowapp->get() as $value) {
          Mail::to($value->getemployee()->first())
          ->send(new notiapproversg(user_resign_detail::find($id)));
        }
        $getrowapp->update([
            'status'=>1
          ]);
      return $getminlv;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.approve.index',['data'=>functionmaster::all()]);
    }

    public function indexfunc(functionmaster $funcid)
    {
      return view('admin.approve.indexfunc',['data'=>$funcid->getappfunc()
      ->orderBy('party_th','asc')->get(),'func_id'=>$funcid->id]);
    }

    public function indexdep(approve_func $depid)
    {
      return view('admin.approve.indexmem',['data'=>$depid->getappmem()->orderBy('level','asc')->get(),
      'func_id'=>$depid->id,'memeber'=>employee::getapp($depid->party_id)->get(),
    'page_id'=>$depid->function_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'function_id'=>'required|numeric|exists:functions,id',
          'party'=>'required|string|exists:mysql.party,code|checkdpdup:function_id,department',
          'department'=>'required|string|exists:mysql.departments,code'
        ]);
        $dep=department::where('code',$request->department)->first();
        $par=party::where('code',$request->party)->first();
        $id=approve_func::create([
          'function_id'=>$request->function_id,
          'party_id'=>$request->party,
          'department_id'=>$request->department,
          'dep_th'=>$dep->name_th,
          'dep_en'=>$dep->name_en,
          'party_th'=>$par->name_th,
          'party_en'=>$par->name_en
        ]);
        return redirect()->route('approve.indexfunc',['funcid'=>$id->function_id])
        ->with('success', 'Data Saved');
    }
    public function storemem(Request $request)
    {
      $this->validate($request,[
        'func_id'=>'required|numeric|exists:approve_funcs,id',
        'code'=>'required|array|checkmem',
        'code.*'=>'required|string|exists:mysql.employee_com,id',
        'level.*'=>'required|numeric'
      ]);
      approve_mem::where('approve_func_id',$request->func_id)->delete();
      foreach ($request->code as $key=>$value) {
        $id=approve_mem::create([
          'approve_func_id'=>$request->func_id,
          'employee_id'=>$value,
          'level'=>$request->level[$key]
        ]);
      }
      $this->refactor(approve_func::find($request->func_id));
      return redirect()->route('approve.indexdep',['depid'=>$id->approve_func_id])->
      with('success', 'Data Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(functionmaster $approve)
    {
      return view('admin.approve.addpd',['data'=>party::all(),'func_id'=>$approve->id]);
    }
    public function getdepartment(party $partyid)
    {
      return (string) $partyid->getdep()->get();
    }
    public function getemployee(employee $emp){
      return (string) $emp;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(approve_func $approve)
    {
        approve_mem::where('approve_func_id',$approve->id)->delete();
        $approve->delete();
        return redirect()->route('approve.indexfunc',['approve'=>$approve->function_id])
        ->with('success','Data has been deleted');
    }
}
