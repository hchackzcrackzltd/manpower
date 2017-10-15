<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\user_dashboard_detail;
use App\Model\Masterdata\employee;
use App\Model\Form\request as req;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Model\User\user_resign_detail;
use App\Model\Form\resign;
use App\Mail\notihrasg;
use App\Mail\notiresignasg;
use App\Model\Masterdata\cannidate_interest;
use App\Model\Masterdata\approve;

class dashboard extends Controller
{
    public function index(){
      return view('admin.dashboard.index',[
        'nj'=>user_dashboard_detail::whereIn('status',['NJ'])->where('approve',1)->get(),
        'aj'=>user_dashboard_detail::whereIn('status',['AJ'])->get(),
        'sc'=>user_dashboard_detail::whereIn('status',['SC'])->get(),
        'rnj'=>user_resign_detail::whereIn('status',['NJ'])->where('approve',1)->get(),
        'raj'=>user_resign_detail::whereIn('status',['AJ'])->get(),
        'rsc'=>user_resign_detail::whereIn('status',['SC'])->get(),
        'rcn'=>user_resign_detail::whereIn('status',['CN'])->get(),
      ]);
    }

    public function getdetail(user_dashboard_detail $dashboard){
      return view('admin.dashboard.detail',['fm'=>$dashboard,
      'can'=>cannidate_interest::getinterestcannidate($dashboard->id)->get(),
      'apl'=>approve::withTrashed()->listapp([$dashboard->id,[1,3]])->get()
    ]);
    }

    public function getdetailrsg(user_resign_detail $dashboard){
      return view('admin.dashboard.detailrgn',[
        'fm'=>$dashboard,
        'apl'=>approve::withTrashed()->listapp([$dashboard->id,[2]])->get()
      ]);
    }

    public function getassign($dashboard){
      return view('admin.dashboard.assign',['data'=>employee::where('code_dep','D020')->get(),'id'=>$dashboard]);
    }

    public function getassignrsg($dashboard){
      return view('admin.dashboard.assignrsg',['data'=>employee::where('code_dep','D020')->get(),'id'=>$dashboard]);
    }

    public function updateassign(Request $request,req $dashboard){
      $this->validate($request,[
        'useras'=>'required|string|exists:employee_resigns,id'
      ]);
      $dashboard->update([
        'user_em_id'=>$request->useras,
        'time_agn'=>Carbon::now(),
        'status'=>'AJ'
      ]);
      Mail::to(employee::where('id',$request->useras)->first())->send(new notihrasg(user_dashboard_detail::find($dashboard->id)));
      return redirect()->route('admin_dashboard')->with('success','Request Assign');
    }

    public function updateassignrsg(Request $request,resign $dashboard){
      $this->validate($request,[
        'useras'=>'required|string|exists:employee_resigns,id'
      ]);
      $dashboard->update([
        'user_em_id'=>$request->useras,
        'time_agn'=>Carbon::now(),
        'status'=>'AJ'
      ]);
      Mail::to(employee::where('id',$request->useras)->first())->send(new notiresignasg(user_resign_detail::find($dashboard->id)));
      return redirect()->route('admin_dashboard')->with('success','Request Assign');
    }
}
