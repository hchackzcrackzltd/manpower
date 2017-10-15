<?php

namespace App\Http\Controllers\Admin;

use App\Model\Masterdata\mail_group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class emailgroup extends Controller
{
  public function __construct()
    {
        $this->middleware('checkmasterdata');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.emailgroup.index',['data'=>mail_group::all()]);
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
        $this->validate($request,[
          'hr'=>'nullable|email',
          'mis'=>'nullable|email',
          'acc'=>'nullable|email',
          'ad'=>'nullable|email',
        ]);
        mail_group::find(1)->update(['email'=>$request->hr]);
        mail_group::find(2)->update(['email'=>$request->mis]);
        mail_group::find(3)->update(['email'=>$request->acc]);
        mail_group::find(4)->update(['email'=>$request->ad]);
        return redirect()->route('mailgroup.index')->with('success','E-Mail Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Masterdata\mail_group  $mail_group
     * @return \Illuminate\Http\Response
     */
    public function show(mail_group $mailgroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Masterdata\mail_group  $mail_group
     * @return \Illuminate\Http\Response
     */
    public function edit(mail_group $mailgroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Masterdata\mail_group  $mail_group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mail_group $mailgroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Masterdata\mail_group  $mail_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(mail_group $mailgroup)
    {
        //
    }
}
