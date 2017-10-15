<?php

namespace App\Http\Controllers\Admin\Masterdata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Masterdata\faculty as fac;

class faculty extends Controller
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
        return view('admin.masterdata.faculty',['data'=>fac::all()]);
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
        'name'=>'required|string'
      ]);
      fac::create([
        'name'=>$request->name
      ]);
      return 'Faculty Added';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(fac $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(fac $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,fac $faculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(fac $faculty)
    {
        $faculty->delete();
        return 'Faculty Deleted';
    }
}
