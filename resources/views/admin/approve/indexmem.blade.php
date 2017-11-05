@extends('template.admin.mainadmin')
@section('titlepage','Cannidate')
@section('munu_act2','active')
@section('title_head')
  <i class="fa fa-users"></i> Member
@endsection

@section('breadcrumb')
  <li>Setting</li>
  <li><a href="{{route('approve.index')}}">Approve</a></li>
  <li><a href="{{route('approve.indexfunc',['funcid'=>$page_id])}}">Division</a></li>
  <li class="active">Member</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    @component('template.component.boxcontent')
      @slot('boxtype','box-success')
      @slot('title')
        <i class="fa fa-list"></i> List of member
      @endslot
      @slot('overlay',null)
        @php
          $no=1;
        @endphp
        <div class="row">
          <form class="addmem" method="post">
          <div class="col-xs-12 col-md-9 col-lg-10">
            <div class="form-group has-feedback us">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control" name="user" required>
                  <option selected disabled>Select Member</option>
                  @foreach ($memeber as $value)
                    <option value="{{$value->code}}">{{$value->code}} - {{$value->fname_en}} {{$value->lname_en}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-md-3 col-lg-2">
            <div class="form-group has-feedback lv">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                <input type="number" class="form-control" placeholder="Level" name="level" min="1" required>
              </div>
            </div>
          </div>
          <div class="col-xs-12 text-right">
            <div class="btn-group">
              <button type="submit" class="btn btn-success" title="Add Member" data-toggle="tooltip">
                <i class="fa fa-plus"></i> ADD
              </button><br><br>
            </div>
          </div>
          </form>
          <form class="svf" action="{{route('approve.storemem')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" class="hide" name="func_id" value="{{$func_id}}" readonly>
          <div class="col-xs-12">
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover text-center">
                <thead>
                  <tr>
                    <th class="text-center">Code</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $value)
                  <tr>
                    @php
                      $personal=$value->getuser()->first();
                    @endphp
                    <td>
                      <input type='text' class='form-control text-center' value='{{$personal->code}}' name='code[]' readonly/>
                    </td>
                    <td>
                      <input type='text' class='form-control text-center' value='{{$personal->fname_en}} {{$personal->lname_en}}' readonly/>
                    </td>
                    <td>
                      <input type='number' class='form-control text-center' value='{{$value->level}}' name='level[]' readonly/>
                    </td>
                    <td><button type='button' class='btn btn-danger delrow'><i class='fa fa-trash-o' title='Delete'></i></button></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-xs-12 text-right">
            <div class="btn-group">
              <button type="submit" class="btn btn-success" title="Save" data-toggle="tooltip">
                <i class="fa fa-floppy-o"></i> Save
              </button>
            </div>
          </div>
          </form>
        </div>
    @endcomponent
  </div>
</div>
@endsection

@section('script')
  <script>
  $(function() {
    var tb=$('.table').DataTable();
    $('select').select2({width:'100%'});
    $('.addmem').on('submit', function(event) {
      event.preventDefault();
      $('.us,.lv').removeClass('has-error');
      if ($('select[name=user]').val()==null) {
        $('.us').addClass('has-error');
          alertnotify('fa fa-ban','Please Select Member','error');
      }else if ($('input[name=level]').val().length<1) {
        $('.lv').addClass('has-error');
          alertnotify('fa fa-ban','Please Insert Level','error');
      }else {
        $.get('../getemployee/'+$('select[name=user]').val()).done(function(data) {
          var rawnm=JSON.parse(data);
          var name=rawnm.fname_en+" "+rawnm.lname_en;
          tb.row.add([
            "<input type='text' class='form-control text-center' value='"+$('select[name=user]').val()+"' name='code[]' readonly/>",
            "<input type='text' class='form-control text-center' value='"+name+"' readonly/>",
            "<input type='number' class='form-control text-center' value='"+$('input[name=level]').val()+"' name='level[]' readonly/>",
            "<button type='button' class='btn btn-danger delrow'><i class='fa fa-trash-o' title='Delete'></i></button>"
          ]).draw( false );
        }).fail(function() {
          console.error('Load Employee');
        });
      }
    });
    $('.table').on('click', '.delrow', function(event) {
      tb.row($(this).parents('tr')).remove().draw();
    });
  });
  </script>
@endsection
