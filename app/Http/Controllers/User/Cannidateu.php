<?php

namespace App\Http\Controllers\User;

use App\Model\Masterdata\cannidate;
use App\Model\Masterdata\cannidate_attach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Masterdata\cannidate_interest;
use Illuminate\Support\Facades\Mail;
use App\Mail\notiintcannidate;
use App\Model\Masterdata\employee;
use App\Model\User\user_dashboard_detail;
use Illuminate\Support\Facades\Log;

class Cannidateu extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Masterdata\cannidate  $cannidate
     * @return \Illuminate\Http\Response
     */
    public function show(cannidate_attach $cannidateu)
    {
        return response()->file('storage/cannidate/'.$cannidateu->file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Masterdata\cannidate  $cannidate
     * @return \Illuminate\Http\Response
     */
    public function edit(cannidate $cannidateu){
      $cannidateu->increment('interest');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Masterdata\cannidate  $cannidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cannidate $cannidateu)
    {
      $this->validate($request,[
        'position'=>'required|exists:positions,id',
        'manpower'=>'required|exists:requests,id'
      ]);
        $cannidateu->increment('interest');
        $id=cannidate_interest::create([
          'cannidate_id'=>$cannidateu->id,
          'user_id'=>$request->user()->username,
          'position_id'=>$request->position,
          'manpower_id'=>$request->manpower
        ]);
        //return dd($id);
        Mail::to(employee::find(user_dashboard_detail::find($id->manpower_id)->user_em_id))->send(new notiintcannidate($id));
        return redirect()->route('user_dashboard')->with('success', 'Data Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Masterdata\cannidate  $cannidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(cannidate $cannidate)
    {
        //
    }
}
