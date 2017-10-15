<?php

namespace App\Http\Controllers\Admin\Masterdata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Masterdata\education as edu;

class educaton extends Controller
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
        return view('admin.masterdata.education',['data'=>edu::all()]);
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
        'name'=>'required|string'
      ]);
      edu::create([
        'name'=>$request->name
      ]);
        return 'Education Added';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $education
     * @return \Illuminate\Http\Response
     */
    public function show(edu $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(edu $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,edu $education)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(edu $education)
    {
        $education->delete();
        return 'Education Deleted';
    }
}
