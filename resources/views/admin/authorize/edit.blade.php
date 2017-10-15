@extends('template.admin.mainadmin')
@section('titlepage','Authorize')
@section('munu_act2','active')

@section('title_head')
  <i class="fa fa-users"></i> Authorize
@endsection

@section('breadcrumb')
  <li><a href="{{route('authorize.index')}}">Authorize</a></li>
  <li class="active">Edit User</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-warning')
        @slot('title')
          <i class="fa fa-pencil"></i> Edit User
        @endslot
        @slot('overlay',null)
          <form action="{{route('authorize.update',['authorize'=>$data->id])}}" method="post">
            {{method_field('PATCH')}}
            {{csrf_field()}}
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="users">User</label>
                <select class="form-control" id="users" name="users" disabled>
                    <option>{{$data->username}} - {{$data->name}}</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="">Type: </label>
                <input type="radio" name="type" value="0" id="us" {{($data->is_admin==0)?'checked':null}}>
                <label for="us">User</label>
                <input type="radio" name="type" value="1" id="ad" {{($data->is_admin)?'checked':null}}>
                <label for="ad">Admin</label>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="">Admin Menu: </label>
                <input type="checkbox" class="set" name="set[]" value="1" id="as" {{(isset($data->getrole()->where(['menu'=>1,'is_admin'=>1])->first()->menu))?'checked':(($data->is_admin)?null:'disabled')}}>
                <label for="as">Assign Job</label>
                <input type="checkbox" class="set" name="set[]" value="2" id="mj" {{(isset($data->getrole()->where(['menu'=>2,'is_admin'=>1])->first()->menu))?'checked':(($data->is_admin)?null:'disabled')}}>
                <label for="mj">My Job</label>
                <input type="checkbox" class="set" name="set[]" value="3" id="st" {{(isset($data->getrole()->where(['menu'=>3,'is_admin'=>1])->first()->menu))?'checked':(($data->is_admin)?null:'disabled')}}>
                <label for="st">Setting</label>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="">User Menu: </label>
                <input type="checkbox" class="uset" name="uset[]" value="1" id="mp" {{(isset($data->getrole()->where(['menu'=>1,'is_admin'=>0])->first()->menu))?'checked':(($data->is_admin==0)?null:'disabled')}}>
                <label for="mp">Manpower</label>
                <input type="checkbox" class="uset" name="uset[]" value="2" id="rs" {{(isset($data->getrole()->where(['menu'=>2,'is_admin'=>0])->first()->menu))?'checked':(($data->is_admin==0)?null:'disabled')}}>
                <label for="rs">Resign</label>
                <input type="checkbox" class="uset" name="uset[]" value="3" id="ap" {{(isset($data->getrole()->where(['menu'=>3,'is_admin'=>0])->first()->menu))?'checked':(($data->is_admin==0)?null:'disabled')}}>
                <label for="ap">Approve</label>
              </div>
            </div>
            <div class="col-xs-12 text-right">
              <div class="btn-group">
                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
              </div>
            </div>
          </div>
          </form>
      @endcomponent
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(function() {
      $('select').select2();
      $('input[type=checkbox],input[type=radio]').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
      });
      $('input[name=type]').on('ifChecked', function(event) {
        console.log($(this).val());
        if ($(this).val()==='1') {
          $(".set").iCheck('enable');
          $(".uset").iCheck('disable');
          $(".uset").iCheck('uncheck');
        }else {
          $(".uset").iCheck('enable');
          $(".set").iCheck('disable');
          $(".set").iCheck('uncheck');
        }
      });
    });
  </script>
@endsection
