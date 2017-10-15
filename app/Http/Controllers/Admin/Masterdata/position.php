<?php

namespace App\Http\Controllers\Admin\Masterdata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Masterdata\position as psm;
use App\Model\Masterdata\department;

class position extends Controller
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
        return view('admin.masterdata.position',[
          'data'=>psm::leftJoin('departments','departments.id','=','positions.department_id')
          ->selectRaw('positions.*,departments.name AS dep')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.masterdata.fm_position',['data'=>department::all()]);
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
        'name'=>'required|string',
        'grade'=>'required|numeric',
        'dep'=>'required|numeric|exists:departments,id',
      ]);
        psm::create([
          'name'=>$request->name,
          'grade'=>$request->grade,
          'department_id'=>$request->dep
        ]);
        return 'Position Added';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $position
     * @return \Illuminate\Http\Response
     */
    public function show(psm $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(psm $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,psm $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(psm $position)
    {
        $position->delete();
        return 'Position Deleted';
    }
}
