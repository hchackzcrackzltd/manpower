<?php

namespace App\Http\Controllers\Admin;

use App\Model\Masterdata\cannidate as cddb;
use App\Model\Masterdata\position;
use App\Model\Masterdata\cannidate_attach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\cannidate as cdrq;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Model\User\user_dashboard_detail;
use App\Model\Masterdata\employee;
use Illuminate\Support\Facades\Mail;
use App\Mail\notiaddcannidate;

class cannidate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.candidate.index',['data'=>cddb::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.candidate.create',['datap'=>position::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(cdrq $request)
    {
      $id=cddb::create([
        'name_th'=>$request->name_th,
        'name_en'=>$request->name_en,
        'position'=>implode(',',$request->position),
        'interest'=>0,
        'emp_id'=>$request->user()->username
      ]);
      foreach ($request->fileat as $value) {
        if ($value->isValid()) {
          $filenm=Carbon::now()->format('ymdhis').'.'.$value->getClientOriginalExtension();
          cannidate_attach::create([
            'cannidate_id'=>$id->id,
            'file'=>$filenm,
            'name'=>$value->getClientOriginalName()
          ]);
          $value->storeAs('cannidate',$filenm);
        }
      }
      foreach (user_dashboard_detail::whereIn('position_id',$request->position)->where('status','AJ')->get() as $data){
        Mail::to(employee::find($data->user_id))->send(new notiaddcannidate($id));
      }
      return redirect()->route('cannidate.index')->with('success','Data Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Masterdata\cannidate  $cannidate
     * @return \Illuminate\Http\Response
     */
    public function show(cannidate_attach $cannidate)
    {
        return response()->file('storage/cannidate/'.$cannidate->file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Masterdata\cannidate  $cannidate
     * @return \Illuminate\Http\Response
     */
    public function edit(cddb $cannidate)
    {
        return view('admin.candidate.edit',['data'=>$cannidate,
        'datap'=>position::all(),
        'files'=>cannidate_attach::where('cannidate_id',$cannidate->id)->get()
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Masterdata\cannidate  $cannidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cddb $cannidate)
    {
      $cannidate->update([
        'name_th'=>$request->name_th,
        'name_en'=>$request->name_en,
        'position'=>implode(',',$request->position)
      ]);
      foreach ($request->fileat as $value) {
        if ($value->isValid()) {
          $filenm=Carbon::now()->format('ymdhis').'.'.$value->getClientOriginalExtension();
          cannidate_attach::create([
            'cannidate_id'=>$cannidate->id,
            'file'=>$filenm,
            'name'=>$value->getClientOriginalName()
          ]);
          $value->storeAs('cannidate',$filenm);
        }
      }
      return redirect()->route('cannidate.index')->with('success','Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Masterdata\cannidate  $cannidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(cddb $cannidate)
    {
      /*if ($cannidate->interest>0) {
        return redirect()->route('cannidate.index')->withErrors(['use',"Cannidate Can't Deleted"]);
      }
      foreach (cannidate_attach::where('cannidate_id',$cannidate->id)->get() as $value) {
        Storage::delete('cannidate/'.$value->file);
      }
      cannidate_attach::where('cannidate_id',$cannidate->id)->delete();*/
        $cannidate->delete();
        return redirect()->route('cannidate.index')->with('success', 'Cannidate Deleted');
    }

    public function delfile(cannidate_attach $cannidate){
      Storage::delete('cannidate/'.$cannidate->file);
      $cannidate->delete();
      return redirect()->back();
    }

    public function detail($cannidate){
      $data=cddb::withTrashed()->find($cannidate);
      return view('admin.candidate.detail',['data'=>$data,
      'datap'=>position::all(),
      'files'=>cannidate_attach::where('cannidate_id',$data->id)->get()
    ]);
    }

    public function history()
    {
      return view('admin.candidate.history',[
        'data'=>cddb::onlyTrashed()->get()
      ]);
    }
}
