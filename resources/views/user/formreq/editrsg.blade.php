@extends('template.mainuser')
@inject('emp','App\Model\Masterdata\employee')

@section('titlepage','Resign Request')

@section('title')
<i class="fa fa-user-times"></i> Edit Resign Request
@endsection

@section('subtitle','Form')

@section('breadcrumb')
  <li class="active"><i class="fa fa-user-times"></i> Edit Resign Request Form</li>
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
    <form action="" method="post" id="fmrgn">
      {{csrf_field()}}
      {{method_field('PATCH')}}
      <div class="row">
        <div class="col-xs-12 col-md-4 pull-right">
          <div class="form-group efd">
            <label for="eft">Effective Date</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
              <input type="text" class="form-control" id="eft" name="eft" placeholder="Effective Date" value="{{$data->effect_date}}" required readonly>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-4 pull-right">
          <div class="form-group ldfw">
            <label for="rsn">Last working date</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" class="form-control" id="lfw" name="lfw" placeholder="Last date for work" value="{{$data->last_date}}" required readonly>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        @php
        $da_data=$emp::find($data->code);
        @endphp
        <div class="col-xs-12 col-md-9">
          <div class="form-group">
            <label for="name">Name</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" id="name" value="{{(isset($da_data))?$da_data->fname_en:null}} {{(isset($da_data))?$da_data->lname_en:null}}" placeholder="name" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-3">
          <div class="form-group">
            <label for="code">Code</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
              <input type="text" class="form-control" id="code" value="{{$data->code}}" placeholder="Code" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="posit">Position</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="ion-person-stalker"></i></span>
              <input type="text" class="form-control" id="posit" value="{{(isset($da_data))?$da_data->posit:null}}" placeholder="Position" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="dep">Department</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
              <input type="text" class="form-control" id="dep" placeholder="Department" value="{{(isset($da_data))?$da_data->dep:null}}" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="rsn">Reason</label>
            <textarea name="rsn" rows="5" class="form-control" placeholder="Reason for resign">{{$data->reason}}</textarea>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="rk">Remark</label>
            <textarea name="rk" rows="5" class="form-control" placeholder="Remark">{{$data->remark}}</textarea>
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
    $('.send').on('click', function(event) {
      if ($(this).attr('data-act')==='save') {
        $('#fmrgn').attr('action', '{{route('resignreq.upsave',['resignreq'=>$data->id])}}');
      }else {
        $('#fmrgn').attr('action', '{{route('resignreq.update',['resignreq'=>$data->id])}}');
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
  }else {
      $('#fmrgn').submit();
    }
    });
    });
  </script>
@endsection
