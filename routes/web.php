<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','User\Dashboard@index')->middleware('auth','checktype');

Route::group(['prefix'=>'user','middleware'=>['auth','checktype']],function(){
  Route::get('/','User\Dashboard@index')->name('user_dashboard');
  Route::resource('manpowerreq','User\Manpowerreq');
  Route::get('dashboard/detail/{dashboard}','User\Dashboard@getdetail')->name('dashboard.getdetail')->middleware('can:view,dashboard');
  Route::get('manpowerreq/acc/{manpowerreq}','User\Manpowerreq@getacc')->name('manpowerreq.getacc');
  Route::get('manpowerreq/com/{manpowerreq}','User\Manpowerreq@getcom')->name('manpowerreq.getcom');
  Route::get('manpowerreq/comdesc/{manpowerreq}','User\Manpowerreq@getcomdesc')->name('manpowerreq.getcomdesc');
  Route::post('manpowerreq/save','User\Manpowerreq@save')->name('manpowerreq.save');
  Route::patch('manpowerreq/updatesave/{manpowerreq}','User\Manpowerreq@updatesave')->name('manpowerreq.updatesave');
  Route::post('manpowerreq/restore/{manpowerreq}','User\Manpowerreq@restore')->name('manpowerreq.restore');
  Route::post('manpowerreq/resave/{manpowerreq}','User\Manpowerreq@resave')->name('manpowerreq.resave');
  Route::post('manpowerreq/rating/{manpowerreq}','User\Manpowerreq@rating')->name('manpowerreq.rating');
  Route::resource('resignreq','User\Resign');
  Route::post('resignreq/save','User\Resign@save')->name('resignreq.save');
  Route::patch('resignreq/upsave/{resignreq}','User\Resign@upsave')->name('resignreq.upsave');
  Route::get('resignreq/showcn/{resignreq}','User\Resign@showcn')->name('resignreq.showcn');
  Route::post('resignreq/resave/{resignreq}','User\Resign@resave')->name('resignreq.resave');
  Route::post('resignreq/restore/{resignreq}','User\Resign@restore')->name('resignreq.restore');
  Route::get('resignreq/detail/{resignreq}','User\Resign@detail')->name('resignreq.detail');
  Route::post('resignreq/rating/{resignreq}','User\Resign@updatersg')->name('resignreq.rating');
  /*Route::resource('evaluate/manpower','User\Evaluate');*/
  /*Route::get('evaluate/resign/{evaluate}','User\Evaluate@showrsg')->name('evaluate.showrsg');
  Route::put('evaluate/resign/{evaluate}','User\Evaluate@updatersg')->name('evaluate.updatersg');*/
  Route::resource('cannidateu','User\Cannidateu');
  Route::patch('approveu/{type}/{app}','User\ApproveUser@updateapp')->name('approveu.update');
  Route::delete('approveu/{type}/{app}','User\ApproveUser@destroyapp')->name('approveu.destroy');
  Route::get('approveu','User\ApproveUser@index')->name('approveu.index');
  Route::get('approveu/manpower/{id}','User\ApproveUser@detailman')->name('approveu.detailman');
  Route::get('approveu/resign/{id}/','User\ApproveUser@detailrsg')->name('approveu.detailrsg');
  Route::get('approveu/manpower/{id}/view','User\ApproveUser@manpage')->name('approveu.manpage');
  Route::get('approveu/resign/{id}/view','User\ApproveUser@rsgpage')->name('approveu.rsgpage');
  Route::get('approveu/aprovel/{value}','User\Manpowerreq@approvel')->name('approveu.aprovel');
  Route::get('candidate','User\CandidateSearch@index')->name('candidatesh.index');
  Route::post('candidate/search','User\CandidateSearch@search')->name('candidatesh.search');
  Route::get('candidate/detail/{id}','User\CandidateSearch@detail')->name('candidatesh.detail');
  Route::post('candidate/send/{id}','User\CandidateSearch@send')->name('candidatesh.send');
  Route::get('candidate/atth_detail/{id}/{no}','User\CandidateSearch@getattech')->name('candidatesh.getimg');
});

Route::group(['prefix'=>'admin','middleware'=>['auth','checkuser']],function(){
  Route::get('/','Admin\dashboard@index')->name('admin_dashboard');
  Route::get('dashboard/detail/{dashboard}','Admin\dashboard@getdetail')->name('admin_dashboard.getdetail');
  Route::get('dashboard/detailrsg/{dashboard}','Admin\dashboard@getdetailrsg')->name('admin_dashboard.getdetailrsg');
  Route::get('dashboard/assign/{dashboard}','Admin\dashboard@getassign')->name('admin_dashboard.getassign');
  Route::get('dashboard/assignrsg/{dashboard}','Admin\dashboard@getassignrsg')->name('admin_dashboard.getassignrsg');
  Route::put('dashboard/assign/{dashboard}','Admin\dashboard@updateassign')->name('admin_dashboard.updateassign')->middleware('can:updateassign,dashboard');
  Route::put('dashboard/assignrsg/{dashboard}','Admin\dashboard@updateassignrsg')->name('admin_dashboard.updateassignrsg');
  Route::get('masterdata','Admin\masterdata@index')->name('admin_masterdata')->middleware('checkmasterdata');
  Route::resource('myjob','Admin\myjob');
  Route::get('myjob/rsg/{myjob}','Admin\myjob@showrsg')->name('myjob.showrsg')->middleware('can:showrsgadmin,myjob');
  Route::put('myjob/rsg/{myjob}','Admin\myjob@updatersg')->name('myjob.updatersg')->middleware('can:showrsgadmin,myjob');
  Route::get('myjob/mancn/{myjob}','Admin\myjob@showmancn')->name('myjob.showmancn')->middleware('can:cancelman,myjob');
  Route::get('myjob/rsgcn/{myjob}','Admin\myjob@showrsgcn')->name('myjob.showrsgcn')->middleware('can:cancelrsg,myjob');
  Route::delete('myjob/rsg/{myjob}','Admin\myjob@destroyresign')->name('myjob.deletersg')->middleware('can:cancelrsg,myjob');
  Route::resource('masterdata/department','Admin\Masterdata\department');
  Route::resource('masterdata/position','Admin\Masterdata\position');
  Route::resource('masterdata/education','Admin\Masterdata\educaton');
  Route::resource('masterdata/faculty','Admin\Masterdata\faculty');
  Route::resource('setting/authorize','Admin\authorizect');
  Route::resource('setting/mailgroup','Admin\emailgroup');
  /*Route::resource('setting/cannidate','Admin\cannidate');
  Route::delete('cannidate/file/{cannidate}','Admin\cannidate@delfile')->name('cannidate.delfile');
  Route::get('cannidate/detail/{cannidate}','Admin\cannidate@detail')->name('cannidate.detail');
  Route::get('cannidate/history','Admin\cannidate@history')->name('cannidate.history');*/
  Route::resource('setting/approve','Admin\approve');
  Route::get('setting/approve/department/{funcid}','Admin\approve@indexfunc')->name('approve.indexfunc');
  Route::get('setting/approve/getdepartment/{partyid}','Admin\approve@getdepartment')->name('approve.getdepartment');
  Route::get('setting/approve/member/{depid}','Admin\approve@indexdep')->name('approve.indexdep');
  Route::get('setting/approve/getemployee/{emp}','Admin\approve@getemployee')->name('approve.emp');
  Route::post('setting/approve/member','Admin\approve@storemem')->name('approve.storemem');
  //new_candidate
  Route::get('setting/cannidate_new','Admin\candidate_efm@index')->name('cannidate_new.index');
  Route::post('setting/cannidate_new','Admin\candidate_efm@create')->name('cannidate_new.create');
  Route::get('setting/cannidate_new/detail/{id}','Admin\candidate_efm@detail')->name('cannidate_new.detail');
  Route::delete('setting/cannidate_new/close/{id}','Admin\candidate_efm@destroy')->name('cannidate_new.destroy');
  Route::get('setting/cannidate_new/history','Admin\candidate_efm@history')->name('cannidate_new.history');
  Route::patch('setting/cannidate_new/history/{id}','Admin\candidate_efm@recover')->name('cannidate_new.history_rev');
  Route::delete('setting/cannidate_new/history/{id}','Admin\candidate_efm@destroy_his')->name('cannidate_new.history_del');
  Route::get('setting/cannidate_new/atth_detail/{id}/{no}','Admin\candidate_efm@getattech')->name('cannidate_new.getimg');
});

Auth::routes();
