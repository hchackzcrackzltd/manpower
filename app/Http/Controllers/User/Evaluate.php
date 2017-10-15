<?php

namespace App\Http\Controllers\User;

use App\Model\Form\request as req;
use App\Model\User\user_dashboard_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Form\resign;

class Evaluate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(req $manpower)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Form\request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(user_dashboard_detail $manpower)
    {
      $this->authorize('show', $manpower);
        return view('user.formreq.evaluate',['fm'=>$manpower]);
    }

    public function showrsg(resign $evaluate)
    {
      $this->authorize('showrsg', $evaluate);
        return view('user.formreq.evaluatersg',['fm'=>$evaluate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Form\request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(req $manpower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Form\request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, req $manpower)
    {
      $this->authorize('updateeva', $manpower);
      $this->validate($request,[
        'score'=>'required|numeric',
        'comment'=>'nullable|string'
      ]);
      $manpower->update([
        'rate'=>$request->score,
        'comment'=>$request->comment,
        'status'=>'SC'
      ]);
      return redirect()->route('user_dashboard')->with('success', 'Evaluate Saved');
    }

    public function updatersg(Request $request, resign $evaluate)
    {
      $this->authorize('updatersg', $evaluate);
      $this->validate($request,[
        'score'=>'required|numeric',
        'comment'=>'nullable|string'
      ]);
      $evaluate->update([
        'rate'=>$request->score,
        'comment'=>$request->comment,
        'status'=>'SC'
      ]);
      return redirect()->route('user_dashboard')->with('success', 'Evaluate Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Form\request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(req $manpower)
    {
        //
    }
}
