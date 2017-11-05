@extends('template.mainuser')
@inject('emp','App\Model\Masterdata\employee')

@section('titlepage','Resign Request')

@section('title')
<i class="fa fa-user-times"></i> Resign Request
@endsection

@section('subtitle','Form')

@section('breadcrumb')
  <li class="active"><i class="fa fa-user-times"></i> Resign Request Form</li>
@endsection

@section('content')
  @component('template.component.boxcontent')
    @slot('boxtype','box-success')
    @slot('title')
      <i class="fa fa-check-circle"></i> Approval List
    @endslot
    @slot('overlay',null)
      <div class="row">
        <div class="col-xs-12">
            <ul class="list-group">
              @forelse ($applist as $value)
                @php
                  $empapp=$emp::find($value->employee_id);
                @endphp
                <li class="list-group-item"><i class="fa fa-user-circle"></i> <b>{{$empapp->fname_en}} {{$empapp->lname_en}}</b></li>
              @empty
                <li class="list-group-item"><i class="fa fa-user-circle"></i> <b>No Approval</b></li>
              @endforelse
            </ul>
        </div>
      </div>
  @endcomponent
  @component('template.component.boxcontent')
    @slot('boxtype','box-primary')
    @slot('overlay',null)
    @slot('title')
      <i class="fa fa-file-text-o"></i> Form Request
    @endslot
    <div class="col-xs-12 pull-right text-right">
      <p class="text-muted">{{config('documentnum.DOCNUM_RS')}}</p>
    </div>
    <form action="" method="post" id="fmrgn">
      {{csrf_field()}}
      <div class="row">
        <div class="col-xs-12 col-md-4 pull-right">
          <div class="form-group efd">
            <label for="eft">Effective Date</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
              <input type="text" class="form-control" id="eft" name="eft" placeholder="Effective Date" required readonly>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-4 pull-right">
          <div class="form-group ldfw">
            <label for="rsn">Last working date</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" class="form-control" id="lfw" name="lfw" placeholder="Last date for work" required readonly>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group fmmp">
            <label for="user">Employee</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-users"></i></span>
              <select class="form-control" name="user" id="user" required>
                <option disabled selected>Please Select Employee</option>
                @forelse ($data as $value)
                  @php
                    $emp_data=$emp::withoutGlobalScopes()->find($value->code);
                  @endphp
                  <option value="{{$value->code}}">{{$value->code}}-{{$emp_data->fname_en}} {{$emp_data->lname_en}}</option>
                @empty
                  <option disabled selected>No Employee</option>
                @endforelse
              </select>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="rsn">Reason</label>
            <textarea name="rsn" rows="5" class="form-control" placeholder="Reason for resign"></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-9">
          <div class="form-group">
            <label for="name">Name</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" id="name" placeholder="name" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-3">
          <div class="form-group">
            <label for="code">Code</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
              <input type="text" class="form-control" id="code" placeholder="Code" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="posit">Position</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="ion-person-stalker"></i></span>
              <input type="text" class="form-control" id="posit" placeholder="Position" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="dep">Department</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
              <input type="text" class="form-control" id="dep" placeholder="Department" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="rk">Remark</label>
            <textarea name="rk" rows="5" class="form-control" placeholder="Remark"></textarea>
          </div>
        </div>
        <div class="col-xs-12 text-right">
          <div class="btn-group">
            <button type="reset" class="btn btn-default" data-toggle="tooltip" title="Reset Form"><i class="fa fa-repeat"></i> Reset</button>
            <button type="button" class="btn btn-primary send" data-act='save' data-toggle="tooltip" title="Send Form"><i class="fa fa-floppy-o"></i> Save</button>
            <button type="button" class="btn btn-success send" data-act='send' data-toggle="tooltip" title="Send Form"><i class="fa fa-paper-plane"></i> Send</button>
          </div>
        </div>
      </div>
      </form>
      <div class="row">
        <div class="col-xs-6 col-lg-3">
          <p class="text-muted">Issued date: {{config('documentnum.ISSUE_RS')}}</p>
        </div>
        <div class="col-xs-6 col-lg-3 pull-right text-right">
          <p class="text-muted">{{config('documentnum.DOCNUM_RS_IN')}}</p>
        </div>
      </div>
  @endcomponent
@endsection

@section('script')
  <script>
    $(function() {
      $('#lfw,#eft').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
      todayHighlight: true
    });
    $('#user').select2();
    $('#user').on('select2:select', function(event) {
      $('#name,#code,#posit,#dep').val('');
      var id=$(this).val();
      $.get('resignreq/'+id).done(function(data) {
        var dataj=JSON.parse(data);
        $('#name').val(dataj.fname_en+' '+dataj.lname_en);
        $('#code').val(id);
        $('#posit').val(dataj.posit);
        $('#dep').val(dataj.dep);
      }).fail(function() {
        alertnotify('fa fa-ban','Load Personal Data Error','error');
        console.error('Load Personal Data Error');
      });
    });
    $('.send').on('click', function(event) {
      if ($(this).attr('data-act')==='save') {
        $('#fmrgn').attr('action', '{{route('resignreq.save')}}');
      }else {
        $('#fmrgn').attr('action', '{{route('resignreq.store')}}');
      }
      $('.form-group').removeClass('has-error');
    if ($('#lfw').val().length<1) {
        event.preventDefault();
        alertnotify('fa fa-ban','Please Insert Last Date For Work','error');
        $('.ldfw').addClass('has-error');
        $('#lfw').focus();
    }else if ($('#eft').val().length<1) {
    event.preventDefault();
    alertnotify('fa fa-ban','Please Insert Effective Date','error');
    $('.efd').addClass('has-error');
    $('#eft').focus();
  }else if ($('#user').val()===null) {
      event.preventDefault();
      alertnotify('fa fa-ban','Please Select Employee','error');
      $('.fmmp').addClass('has-error');
      $('#user').focus();
    }else {
      $('#fmrgn').submit();
    }
    });
    });
  </script>
@endsection
