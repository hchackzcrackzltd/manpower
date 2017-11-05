<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\user_dashboard_detail as rorm;
use App\Model\Masterdata\approve as apv;
use App\Model\User\user_resign_detail;
use App\Model\Masterdata\cannidate_interest;

class Dashboard extends Controller
{
    public function index()
    {
      return view('user.dashboard.index',[
        'nj'=>rorm::userown()->whereIn('status',['NJ','NP'])->get(),
        'aj'=>rorm::userown()->whereIn('status',['AJ'])->get(),
        'cn'=>rorm::userown()->whereIn('status',['CN'])->get(),
        'sc'=>rorm::userown()->whereIn('status',['SC'])->get(),
        'rnj'=>user_resign_detail::userown()->whereIn('status',['NJ','NP'])->get(),
        'raj'=>user_resign_detail::userown()->whereIn('status',['AJ'])->get(),
        'rcn'=>user_resign_detail::userown()->whereIn('status',['CN'])->get(),
        'rsc'=>user_resign_detail::userown()->whereIn('status',['SC'])->get(),
      ]);
    }

    public function getdetail(rorm $dashboard){
      return view('user.dashboard.detail',[
        'fm'=>$dashboard,
        'can'=>cannidate_interest::with(['getcandidate','getcandidate.gethisjob','getcandidate.getfile'])->mycan($dashboard)->get(),
        'apl'=>apv::withTrashed()->listapp([$dashboard->id,[1,3]])->get()
      ]);
    }
}
