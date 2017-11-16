<?php

namespace App\Http\Controllers\Admin;

use App\Model\User\authorize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Masterdata\employee;

class authorizect extends Controller
{
  /*public function __construct()
    {
        $this->middleware('checkmasterdata');
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.authorize.index',['data'=>User::withTrashed()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authorize.create',['users'=>employee::all()]);
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
          'users'=>'required|string|exists:employee_resigns,id|unique:users,username',
          'type'=>'required|numeric',
          'set.*'=>'nullable|numeric',
          'uset.*'=>'nullable|numeric'
        ]);
        $data=employee::find($request->users);
        User::create([
          'username'=>$data->code,
          'email'=>$data->email_office,
          'name'=>$data->fname_en.'.'.substr($data->lname_en,0,1),
          'is_admin'=>$request->type,
          'password'=>bcrypt(base64_decode($data->password))
        ]);
        if (isset($request->set)) {
          foreach ($request->set as $value) {
            authorize::create([
              'username'=>$data->code,
              'menu'=>$value,
              'is_admin'=>$request->type
            ]);
          }
        }else {
          foreach ($request->uset as $value) {
            authorize::create([
              'username'=>$data->code,
              'menu'=>$value,
              'is_admin'=>$request->type
            ]);
          }
        }
        return redirect()->route('authorize.index')->with('success','User Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\User\authorize  $authorize
     * @return \Illuminate\Http\Response
     */
    public function show(authorize $authorize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\User\authorize  $authorize
     * @return \Illuminate\Http\Response
     */
    public function edit(User $authorize)
    {
      return view('admin.authorize.edit',['data'=>$authorize]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\User\authorize  $authorize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $authorize){
      $this->validate($request,[
        'type'=>'required|numeric',
        'set.*'=>'nullable|numeric',
        'uset.*'=>'nullable|numeric'
      ]);
      $authorize->update([
        'is_admin'=>$request->type,
      ]);
      authorize::where('username',$authorize->username)->delete();
      if (isset($request->set)) {
        foreach ($request->set as $value) {
          authorize::create([
            'username'=>$authorize->username,
            'menu'=>$value,
            'is_admin'=>$request->type
          ]);
        }
      }else {
        foreach ($request->uset as $value) {
          authorize::create([
            'username'=>$authorize->username,
            'menu'=>$value,
            'is_admin'=>$request->type
          ]);
        }
      }
      return redirect()->route('authorize.index')->with('success','User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User\authorize  $authorize
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $authorize)
    {
      $authorize->delete();
      return redirect()->route('authorize.index')->with('success','User has been disabled');
    }

    public function restore(Request $request)
    {
      $this->validate($request,['id'=>'required|exists:users,id'],['id.exists'=>'Not found user']);
      User::onlyTrashed()->where('id',$request->id)->restore();
      return redirect()->route('authorize.index')->with('success','User has been enable');
    }
}
