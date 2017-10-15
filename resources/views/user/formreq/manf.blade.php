@extends('template.mainuser')
@inject('emp','App\Model\Masterdata\employee')

@section('titlepage','Manpower Request')

@section('title')
<i class="fa fa-user"></i> Manpower Request
@endsection

@section('subtitle','Form')

@section('breadcrumb')
  <li class="active"><i class="fa fa-user"></i> Manpower Request Form</li>
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
            <ul class="list-group list-app">
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
    @slot('title')
      <i class="fa fa-file-text-o"></i> Form Request
    @endslot
    @slot('overlay',null)
    <form class="addreq" action="" method="post">
      {{csrf_field()}}
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs btnw">
          <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info"></i> Information <span class="badge">1</span></a></li>
          <li><a href="#tab_2" data-toggle="tab"><i class=" fa fa-asterisk"></i> Job Description <span class="badge bg-teal">2</span></a></li>
          <li><a href="#tab_3" data-toggle="tab"><i class="ion-laptop"></i> Computer <span class="badge bg-blue">3</span></a></li>
          <li><a href="#tab_4" data-toggle="tab"><i class="ion-model-s"></i> Fleet card&Car <span class="badge bg-aqua">4</span></a></li>
          <li><a href="#tab_5" data-toggle="tab"><i class="fa fa-thumb-tack"></i> Office equipment <span class="badge bg-green">5</span></a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tab_1">
            <div class="row">
              <div class="col-xs-12 col-md-5 pull-right">
                <div class="form-group has-feedback eed">
                  <label for="eed">Effective Date<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" id="eed" name="eed" placeholder="Please Insert Effective Date" required readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-3 col-lg-2">
                <b>Company<span class="text-danger">*</span></b>
              </div>
              @foreach ($company as $value)
                <div class="col-xs-12 col-sm-4 col-lg-2">
                  <div class="form-group">
                    <input type="radio" name="compa" id="compa{{$value->id}}" value="{{$value->id}}">
                    <label for="compa{{$value->id}}">:{{ucfirst($value->name)}}</label>
                  </div>
                </div>
              @endforeach
              <input type="hidden" class="hide" name="scompa">
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-3 col-lg-2">
                <b>Location<span class="text-danger">*</span></b>
              </div>
              @foreach ($location as $value)
                <div class="col-xs-12 col-sm-4 col-lg-2">
                  <div class="form-group">
                    <input type="radio" name="locat" id="locat{{$value->id}}" value="{{$value->id}}">
                    <label for="locat{{$value->id}}">:{{strtoupper($value->location)}}</label>
                  </div>
                </div>
              @endforeach
              <input type="hidden" class="hide" name="slocat">
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group has-feedback posit">
                  <label for="dide">Position<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                    <select class="form-control" name="posit" id="posit" required>
                      <option selected disabled>Please Select Position</option>
                      @foreach ($pos as $value)
                        <option value="{{$value->id}}">{{$value->dep}} - {{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group has-feedback imr">
                  <label for="imr">Immediate Manager<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                    <select class="form-control" name="imr" id="imr">
                      <option value="0" selected disabled>Please Select Immediate Manager</option>
                      @foreach ($emp->mlevel()->get() as $value)
                        <option value="{{$value->code}}">{{$value->code}} - {{$value->fname_en}} {{$value->lname_en}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xs-12"><hr></div>
              <div class="col-xs-12 col-md-3 col-lg-2">
                <label>Reason for employment<span class="text-danger">*</span></label>
              </div>
              <div class="col-xs-12 col-md-9">
                <div class="row">
                  <div class="col-xs-12">
                      <label><input type="radio" name="rfm" value="3">&nbsp;&nbsp;:Replacement employee name</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <select class="form-control" name="ren_name" disabled>
                          @forelse ($resign as $value)
                            @php
                              $txt_name=$emp::withoutGlobalScopes()->find($value->code);
                            @endphp
                            <option value="{{$value->code}}">{{$value->code}} - {{$txt_name->fname_en}} {{$txt_name->lname_en}}</option>
                          @empty
                            <option value="0" selected disabled>Name</option>
                          @endforelse
                        </select>
                      </div>
                  </div>
                  <div class="col-xs-12">
                  <hr>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label><input type="radio" name="rfm" value="4">&nbsp;&nbsp;:Transfer employee name</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                        <select class="form-control" name="rfm_trans" disabled>
                          @forelse ($emp->all() as $value)
                            <option value="{{$value->code}}">{{$value->code}} - {{$value->fname_en}} {{$value->lname_en}}</option>
                          @empty
                            <option value="0" selected disabled>Name</option>
                          @endforelse
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12">
                  <hr>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label><input type="radio" name="rfm" value="2">&nbsp;&nbsp;:New position without approved annual budget</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <textarea name="rfm_nfb" class="form-control" rows="5" placeholder="Please Specify Reason" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12">
                  <hr>
                  </div>
                  <div class="col-xs-12">
                    <label><input type="radio" name="rfm" value="1">&nbsp;&nbsp;:New position within approved annual budget</label>
                  </div>
                </div>
                <input type="hidden" class="hide" name="srfm" readonly>
              </div>
              <div class="col-xs-12"><hr></div>
                <div class="col-xs-12 col-sm-3 col-lg-2">
                  <b>Employee type<span class="text-danger">*</span></b>
                </div>
                <div class="col-xs-12 col-sm-9 col-lg-10">
                  <div class="row">
                  <div class="col-xs-12 col-sm-5">
                    <div class="form-group">
                      <input type="radio" name="type_em" id="type_mt" value="1">
                      <label for="type_mt">:Monthly</label>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-7">
                    <div class="form-group">
                      <input type="radio" name="type_em" id="type_dy" value="2">
                      <label for="type_dy">:Daily</label>
                    </div>
                  </div>
                  </div>
                </div>
                <input type="hidden" class="hide" name="stype_em">
              <div class="col-xs-12 col-md-3 col-lg-2">
                <label>Job type<span class="text-danger">*</span></label>
              </div>
              <div class="col-xs-12 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-xs-12 col-md-5">
                    <label><input type="radio" name="jt" value="1">&nbsp;&nbsp;:Permanent employee</label>
                  </div>
                  <div class="col-xs-12 col-md-7">
                    <label><input type="radio" name="jt" value="2">&nbsp;&nbsp;:Temporary worker</label>
                  </div>
                  <div class="col-xs-8">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                      <input type="number" class="form-control" name="tw_lead" min="0" placeholder="Insert leadtime" disabled>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                      <select name="tw_lead_type" class="form-control" disabled>
                          <option value="1">Day</option>
                          <option value="2">Month</option>
                        </select>
                    </div>
                  </div>
                </div>
                <input type="hidden" class="hide" name="sjt" readonly>
              </div>
              <div class="col-xs-12"><hr></div>
              <div class="col-xs-12">
                  <label>Employee specification</label>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group has-feedback sex">
                  <label for="">Sex<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-male"></i><i class="fa fa-female"></i></span>
                    <select class="form-control" name="sex" required>
                      <option value="1">Men</option>
                      <option value="2">Women</option>
                      <option value="3">Men/Women</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group has-feedback js1_count">
                  <label for="js1_count">Total amount<span class="text-danger">*</span>:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <input type="number" class="form-control" id="js1_count" name="js1_count" placeholder="Count" min="0" required>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group has-feedback age">
                  <label for="age">Age<span class="text-danger">*</span></label>
                    <input type="text" id="age" placeholder="Age" name="age" required>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group has-feedback deg">
                  <label for="deg">Education<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                    <select class="form-control" name="deg[]" multiple required>
                      @foreach ($edu as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group has-feedback fac">
                  <label for="fac">Faculty<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                    <select class="form-control" name="fac[]" multiple required>
                      @foreach ($fac as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <br>
              </div>
              <div class="col-xs-12 text-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-success nxft">Next <i class="fa fa-arrow-right"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane fade" id="tab_2">
            <div class="row">
              <div class="col-xs-12 col-md-3 col-lg-2">
                <label>Experience<span class="text-danger">*</span></label>
              </div>
              <div class="col-xs-12 col-md-9 col-lg-10">
                <div class="row">
                  <div class="col-xs-12">
                    <label for="exp_n"><input type="radio" id="exp_n" name="exp" value="1">&nbsp;&nbsp;:New graduated</label>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-lg-5">
                      <label for="exp_h"><input type="radio" id="exp_h" name="exp" value="2">&nbsp;&nbsp;:Have experience</label>
                      <div class="input-group">
                        <input type="number" class="form-control" name="exp_year" min="1" placeholder="Please specify year of experience" disabled>
                        <span class="input-group-addon"><b>Year</b></span>
                      </div>
                  </div>
                </div>
                <input type="hidden" class="hide" name="sexp">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group has-feedback jd">
                  <label for="jd">Job description<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea name="jd" class="form-control" style="resize:vertical" placeholder="Insert job description this here" rows="8" required></textarea>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group has-feedback qua">
                  <label for="qua">Qualifications<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                    <textarea name="qua" class="form-control" style="resize:vertical" placeholder="Please specify qualifications" rows="8" required></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <div class="btn-group">
                  <button type="button" class="btn btn-default bk" data-inx="0"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
              </div>
              <div class="col-xs-6 text-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-success nxtw">Next <i class="fa fa-arrow-right"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="tab_3">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group has-feedback comfk">
                  <label for="com_name">Computer<span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="ion-laptop"></i></span>
                    <select class="form-control" name="com_id">
                        <option selected disabled>No Computer Available</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><i class="fa fa-align-justify"></i> <b>Computer Spec</b></div>
                  <div class="panel-body com-detail">
                    <h4 class="text-center"><i class="fa fa-briefcase"></i> Please Select Position</h4>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <hr>
              </div>
              @isset($sw)
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="">Software<span class="text-danger">*</span>:&nbsp;&nbsp;&nbsp;</label>
                    @foreach ($sw as $value)
                      <label for="sw_{{$value->id}}"><input type="checkbox" name="sw[]" id="sw_{{$value->id}}" value="{{$value->id}}"> {{$value->name}}</label>&nbsp;&nbsp;&nbsp;
                    @endforeach
                    <input type="hidden" class="hide" name="ssw">
                    <label for="sw_etc"><input type="checkbox" name="sw_etc" id="sw_etc" value="etc"> Etc.</label>
                    <input type="hidden" class="hide" name="ssw_etc">
                    <div class="input-group">
                      <span class="input-group-addon"><b>Etc.</b></span>
                      <input type="text" class="form-control" name="sw_etc_spc" placeholder="Software Etc." disabled>
                    </div>
                  </div>
              </div>
              @endisset
              <div class="col-xs-12">
                <hr>
              </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="">Accessories<span class="text-danger">*</span>:&nbsp;&nbsp;&nbsp;</label>
                    <span class="ac-group"></span>
                    <input type="hidden" class="hide" name="sac">
                    <label for="ac_etc"><input type="checkbox" name="ac_etc" id="ac_etc" value="etc"> Etc.</label>
                    <input type="hidden" class="hide" name="sac_etc">
                    <div class="input-group">
                      <span class="input-group-addon"><b>Etc.</b></span>
                      <input type="text" class="form-control" name="ac_etc_spc" placeholder="Accessories Etc." disabled>
                    </div>
                  </div>
              </div>

            </div>
            <div class="row">
              <div class="col-xs-6">
                <div class="btn-group">
                  <button type="button" class="btn btn-default bk" data-inx="1"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
              </div>
              <div class="col-xs-6 text-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-success nxtr">Next <i class="fa fa-arrow-right"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane fade" id="tab_4">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="">Fleet Card:&nbsp;&nbsp;&nbsp;</label>
                  <label for="fedc"><input type="checkbox" name="fedc" id="fedc" value="1"> Fleet Card</label>&nbsp;&nbsp;&nbsp;
                </div>
                <input type="hidden" name="sfedc">
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="">Car:&nbsp;&nbsp;&nbsp;</label>
                  <label for="car_1"><input type="checkbox" name="car" id="car_1" value="1"> Car Rent</label>&nbsp;&nbsp;&nbsp;
                  <label for="car_pk"><input type="checkbox" name="car_pk" id="car_pk" value="etc"> Car Park</label>
                  <div class="input-group">
                    <span class="input-group-addon"><b>License Plate</b></span>
                    <input type="text" class="form-control" id="car_lp" name="car_lp" placeholder="License Plate" disabled>
                  </div>
                </div>
                <input type="hidden" name="scar">
                <input type="hidden" name="scar_pk">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <div class="btn-group">
                  <button type="button" class="btn btn-default bk" data-inx="2"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
              </div>
              <div class="col-xs-6 text-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-success nxfo">Next <i class="fa fa-arrow-right"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane fade" id="tab_5">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="nmc">Other Accessories:&nbsp;&nbsp;&nbsp;</label>
                  @foreach ($offac as $value)
                    <label for="nmc{{$value->id}}"><input type="checkbox" name="nmc[]" id="nmc{{$value->id}}" value="{{$value->id}}"> {{ucfirst($value->itemdesc)}}</label>&nbsp;&nbsp;&nbsp;
                  @endforeach
                </div>
                <input type="hidden" name="snmc">
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="ofa">Etc.</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <textarea id="ofa" name="ofa" style="resize:vertical" class="form-control" placeholder="Office Accessories"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Remark</label>
                  <textarea class="form-control" name="remark" rows="5" placeholder="Insert Remark Here"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <div class="btn-group">
                  <button type="button" class="btn btn-default bk" data-inx="3"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
              </div>
              <div class="col-xs-6 text-right">
              <div class="button-group">
                <button type="button" class="btn btn-primary savefm" title="Save Form" data-toggle="tooltip"><i class="fa fa-floppy-o"></i> Save</button>
                <button type="button" class="btn btn-success sendf" title="Send request" data-toggle="tooltip"><i class="fa fa-paper-plane"></i> Send</button>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.tab-content -->
      </div>
      <!---------------------------------------------->
      </form>
  @endcomponent
@endsection

@section('script')
  <script>
  $(function() {
    $('#eed').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayHighlight: true
  });
  $("select[name='deg[]']").select2({
    placeholder:'Please Select Education',
    allowClear: true
  });
  $("select[name='fac[]']").select2({
    placeholder:'Please Select Faculty',
    allowClear: true
  });
  $("select[name=posit]").select2({
    placeholder:'Please Select Position',
    allowClear: true
  });
  $("select[name=ren_name],select[name=rfm_trans]").select2({
    placeholder:'Please Select Empolyee',
    allowClear: true
  });
  $("select[name=imr]").select2({
    placeholder:'Please Select Immediate Manager',
    allowClear: true
  });
  $('#age').ionRangeSlider({
    type: "double",
    grid: true,
    min: 20,
    max: 60,
    postfix: " Year",
    decorate_both: true
  });
function approvel(id) {
  $('.list-app').empty();
  $.get('approveu/aprovel/'+id).done(function(data) {
    $.each(JSON.parse(data),function(index,el) {
      $('.list-app').append("<li class='list-group-item'><i class='fa fa-user-circle'></i> <b>"+el+"</b></li>")
    });
  }).fail(function() {
    console.error('Load Error');
  });
}
  $('input[name=rfm]').on('ifChecked', function(event) {
    $('input[name=srfm]').val($(this).val());
    switch ($(this).val()) {
      case '4':
      $('select[name=rfm_trans]').attr('disabled',false);
        $('select[name=ren_name]').attr('disabled',true);
        $('textarea[name=rfm_nfb]').val('').attr('disabled',true);
        $('#js1_count').val(1).prop('readonly',true);
        approvel(1);
        break;
      case '3':
        $('select[name=ren_name]').attr('disabled',false);
        $('textarea[name=rfm_nfb]').val('').attr('disabled',true);
        $('select[name=rfm_trans]').attr('disabled',true);
        $('#js1_count').val(1).prop('readonly',true);
        approvel(1);
        break;
      case '2':
      $('select[name=rfm_trans]').attr('disabled',true);
      $('select[name=ren_name]').attr('disabled',true);
          $('textarea[name=rfm_nfb]').val('').attr('disabled',false);
          $('#js1_count').val(1).prop('readonly',false);
          approvel(3);
        break;
      case '1':
      $('select[name=rfm_trans]').attr('disabled',true);
        $('select[name=ren_name]').val('').attr('disabled',true);
        $('textarea[name=rfm_nfb]').val('').attr('disabled',true);
        $('#js1_count').val(1).prop('readonly',false);
        approvel(1);
        break;
      default:
        alertnotify('fa fa-ban','Please Select Reason for employment','error');
    }
  });
  $('input[name=jt]').on('ifChecked', function(event) {
    $('input[name=sjt]').val($(this).val());
    switch ($(this).val()) {
      case '2':
        $('select[name=tw_lead_type]').removeAttr('disabled');
        $('input[name=tw_lead]').removeAttr('disabled');
        break;
      case '1':
        $('select[name=tw_lead_type]').attr('disabled',true);
        $('input[name=tw_lead]').attr('disabled',true);
        break;
      default:
        alertnotify('fa fa-ban','Please Select Job type','error');
    }
  });
  $('input[name=exp]').on('ifChecked', function(event) {
    $('input[name=sexp]').val($(this).val());
    switch ($(this).val()) {
      case '2':
        $('input[name=exp_year]').removeAttr('disabled');
        break;
      case '1':
        $('input[name=exp_year]').attr('disabled',true);
        $('input[name=exp_year]').val(null);
        break;
      default:
        alertnotify('fa fa-ban','Please Select Experience','error');
    }
  });
  $('input[name=sw_etc]').on('ifToggled', function(event) {
    if ($('input[name=sw_etc_spc]').attr('disabled')) {
      $('input[name=ssw_etc]').val($(this).val());
      $('input[name=sw_etc_spc]').attr('disabled',false);
    }else {
      $('input[name=ssw_etc]').val('');
      $('input[name=sw_etc_spc]').val('');
      $('input[name=sw_etc_spc]').attr('disabled',true);
    }
  });
  $('input[name=ac_etc]').on('ifToggled', function(event) {
    if ($('input[name=ac_etc_spc]').attr('disabled')) {
      $('input[name=sac_etc]').val($(this).val());
      $('input[name=ac_etc_spc]').attr('disabled',false);
    }else {
      $('input[name=sac_etc]').val('');
      $('input[name=ac_etc_spc]').val('');
      $('input[name=ac_etc_spc]').attr('disabled',true);
    }
  });
  $('input[name=car_pk]').on('ifToggled', function(event) {
    if ($('input[name=car_lp]').attr('disabled')) {
      $('input[name=car_lp]').attr('disabled',false);
    }else {
      $('input[name=car_lp]').val('');
      $('input[name=car_lp]').attr('disabled',true);
    }
  });
  $("input[name='sw[]']").on('ifChecked', function(event) {
    if ($('input[name=ssw]').val().length>0) {
      var data=JSON.parse($('input[name=ssw]').val());
      data.push($(this).val());
      $('input[name=ssw]').val(JSON.stringify(data));
    }else {
      var data=[];
      data.push($(this).val());
      $('input[name=ssw]').val(JSON.stringify(data));
    }
  });
  $("input[name='sw[]']").on('ifUnchecked', function(event) {
      var data=JSON.parse($('input[name=ssw]').val());
      data.splice(data.indexOf($(this).val()),1);
      $('input[name=ssw]').val(JSON.stringify(data));
  });
  $(".ac-group").on('ifChecked',"input[name='ac[]']", function(event) {
    if ($('input[name=sac]').val().length>0) {
      var data=JSON.parse($('input[name=sac]').val());
      data.push($(this).val());
      $('input[name=sac]').val(JSON.stringify(data));
    }else {
      var data=[];
      data.push($(this).val());
      $('input[name=sac]').val(JSON.stringify(data));
    }
  });
  $(".ac-group").on('ifUnchecked',"input[name='ac[]']", function(event) {
      var data=JSON.parse($('input[name=sac]').val());
      data.splice(data.indexOf($(this).val()),1);
      $('input[name=sac]').val(JSON.stringify(data));
  });
  $("input[name=fedc]").on('ifToggled', function(event) {
    if ($('input[name=sfedc]').val().length>0) {
      $('input[name=sfedc]').val('');
    }else {
      $('input[name=sfedc]').val($(this).val());
    }
  });
  $("input[name=car]").on('ifToggled', function(event) {
    if ($('input[name=scar]').val().length>0) {
      $('input[name=scar]').val('');
    }else {
      $('input[name=scar]').val($(this).val());
    }
  });
  $("input[name=car_pk]").on('ifToggled', function(event) {
    if ($('input[name=scar_pk]').val().length>0) {
      $('input[name=scar_pk]').val('');
    }else {
      $('input[name=scar_pk]').val($(this).val());
    }
  });
  $('input[name=type_em]').on('ifToggled', function(event) {
    $('input[name=stype_em]').val($(this).val());
  });
  $('input[name=locat]').on('ifToggled', function(event) {
    $('input[name=slocat]').val($(this).val());
  });
  $('input[name=compa]').on('ifToggled', function(event) {
    $('input[name=scompa]').val($(this).val());
  });
  /*------- Validate ---------*/
  function validate() {
    $('.has-feedback').removeClass('has-error');
    if ($('input[name=eed]').val().length<1) {
      alertnotify('fa fa-ban','Please Insert Effective Date','error');
      $('.eed').addClass('has-error');
      $('input[name=eed]').focus();
      return false;
    }else if ($('input[name=scompa]').val().length<1) {
      alertnotify('fa fa-ban','Please Select Company','error');
      return false;
    }else if ($('input[name=slocat]').val().length<1) {
      alertnotify('fa fa-ban','Please Select Location','error');
      return false;
    }else if ($('select[name=posit]').val()===null) {
      alertnotify('fa fa-ban','Please Select Position','error');
      $('.posit').addClass('has-error');
      $('select[name=posit]').focus();
      return false;
    }else if ($('select[name=imr]').val()===null) {
      alertnotify('fa fa-ban','Please Select Immediate Manager','error');
      $('.imr').addClass('has-error');
      $('select[name=imr]').focus();
      return false;
    }else if ($('input[name=srfm]').val().length<1) {
      alertnotify('fa fa-ban','Please Select Reason For Employment','error');
      return false;
    } else if ($('input[name=srfm]').val()==='2'&&$('textarea[name=rfm_nfb]').val().length<1) {
      alertnotify('fa fa-ban','Please Specify Reason For New position without approved annual budget','error');
      $('textarea[name=rfm_nfb]').focus();
      return false;
    }else if ($('input[name=srfm]').val()==='3'&&$('select[name=ren_name]').val()===null) {
      alertnotify('fa fa-ban','Please Select Name For Replace Employee','error');
      $('select[name=ren_name]').focus();
      return false;
    }else if ($('input[name=srfm]').val()==='4'&&$('select[name=rfm_trans]').val()===null) {
      alertnotify('fa fa-ban','Please Select Name For Transfer Employee','error');
      $('select[name=rfm_trans]').focus();
      return false;
    } else if ($('input[name=stype_em]').val().length<1) {
      alertnotify('fa fa-ban','Please Select Type Employee','error');
      return false;
    }else if ($('input[name=sjt]').val().length<1) {
      alertnotify('fa fa-ban','Please Select Job type','error');
      return false;
    } else if ($('input[name=sjt]').val()==='2'&&$('input[name=tw_lead]').val().length<1) {
      alertnotify('fa fa-ban','Please Insert Leadtime','error');
      $('input[name=tw_lead]').focus();
      return false;
    }else if ($('input[name=js1_count]').val().length<1||parseInt($('input[name=js1_count]').val())<1) {
      alertnotify('fa fa-ban','Please Specify Total Amount','error');
      $('.js1_count').addClass('has-error');
      $('input[name=js1_count]').focus();
      return false;
    } else if ($('input[name=age]').val().length<1) {
      alertnotify('fa fa-ban','Please Specify Age','error');
      $('.age').addClass('has-error');
      return false;
    } else if ($("select[name='deg[]']").val().length<1) {
      alertnotify('fa fa-ban','Please Select Education','error');
      $('.deg').addClass('has-error');
      return false;
    } else if ($("select[name='fac[]']").val().length<1) {
      alertnotify('fa fa-ban','Please Select Faculty','error');
      $('.fac').addClass('has-error');
      return false;
    } else {
      return true;
    }
  }
  function validatejd() {
    $('.has-feedback').removeClass('has-error');
     if ($('input[name=sexp]').val().length<1) {
      alertnotify('fa fa-ban','Please Select Experience','error');
      return false;
    } else if ($('input[name=sexp]').val()==='2'&&($('input[name=exp_year]').val().length<1 || parseInt($('input[name=exp_year]').val())==0)) {
      alertnotify('fa fa-ban','Please Specify At Least Year','error');
      $('input[name=exp_year]').focus();
      return false;
    } else if ($('textarea[name=jd]').val().length<1) {
      alertnotify('fa fa-ban','Please Insert Job Description','error');
      $('.jd').addClass('has-error');
      $('textarea[name=jd]').focus();
      return false;
    } else if ($('textarea[name=qua]').val().length<1){
      $('.qua').addClass('has-error');
    alertnotify('fa fa-ban','Please Specify Qualifications','error');
      $('textarea[name=qua]').focus();
      return false;
    } else {
      return true;
    }
  }
  function validate2() {
    $('.has-feedback').removeClass('has-error');
    if ($('select[name=com_id]').val()===null) {
      $('.comfk').addClass('has-error');
      alertnotify('fa fa-ban','Please Select Position.','error');
      $('select[name=com_id]').focus();
      return false;
    }else if ($('input[name=ssw_etc]').val()==='etc'&&$('input[name=sw_etc_spc]').val().length<1) {
      alertnotify('fa fa-ban','Please Specify Software Etc.','error');
      $('input[name=sw_etc_spc]').focus();
      return false;
    }else if ($('input[name=sac_etc]').val()==='etc'&&$('input[name=ac_etc_spc]').val().length<1) {
      alertnotify('fa fa-ban','Please Specify Accessories Etc.','error');
      $('input[name=ac_etc_spc]').focus();
      return false;
    }else {
      return true;
    }
  }
  function validate3() {
    if ($('input[name=scar_pk]').val()==='etc'&&$('input[name=car_lp]').val().length<1) {
      alertnotify('fa fa-ban','Please Specify License Plate.','error');
      $('input[name=car_lp]').focus();
      return false;
    }else {
      return true;
    }
  }
    /*------- Validate ---------*/
    /*------- Ajax ------------*/
    $('select[name=posit]').on('select2:select', function(event) {
      var id=$(this).val();
      $.get('manpowerreq/com/'+id).done(function(data) {
        $('select[name=com_id]').empty();
        var daj=JSON.parse(data);
        $.each(daj,function(index, el) {
          $('select[name=com_id]').append("<option value='"+el.barcode+"'>"+el.item_desc+"</option>");
        });
        $('select[name=com_id]').trigger('change');
      }).fail(function() {
        console.log("Error Get Com");
      });
      $.get('manpowerreq/acc/'+id).done(function(data) {
        $('.ac-group').empty();
        var asj=JSON.parse(data);
        $.each(asj,function(index, el) {
          $('.ac-group').append("<label for='ac_"+el.id+"'><input type='checkbox' name='ac[]' id='ac_"+el.id+"' value='"+el.id+"'>"+el.name+"</label>&nbsp;&nbsp;&nbsp;");
        });
        $("input[name='ac[]']").iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green'
        });
      }).fail(function() {
        console.error('Get Accessories Error');
      });
    });
    $('select[name=com_id]').on('change', function(event) {
      var barcode=$(this).val();
      $.get('manpowerreq/comdesc/'+barcode).done(function(data) {
        var daj=JSON.parse(data);
        $('.com-detail').html(daj.detail);
      }).fail(function() {
        console.log("Error Get Com Detail");
      });
    });
    /*---------- Ajax ----------------------*/
    $('.sendf').on('click', function(event) {
      if (!validate()) {
        event.preventDefault();
        $(".btnw li:eq(0) a").tab('show');
      }else if (!validatejd()) {
        event.preventDefault();
        $(".btnw li:eq(1) a").tab('show');
      }else if (!validate2()) {
        event.preventDefault();
        $(".btnw li:eq(1) a").tab('show');
      }else if (!validate3()) {
        event.preventDefault();
        $(".btnw li:eq(2) a").tab('show');
      }else {
        $('.addreq').attr('action', '{{route('manpowerreq.store')}}');
        $(this).attr('disabled', true);
        $('.addreq').submit();
      }
    });
    $('.savefm').on('click', function(event) {
      if (!validate()) {
        event.preventDefault();
        $(".btnw li:eq(0) a").tab('show');
      }else if (!validatejd()) {
        event.preventDefault();
        $(".btnw li:eq(1) a").tab('show');
      }else if (!validate2()) {
        event.preventDefault();
        $(".btnw li:eq(2) a").tab('show');
      }else if (!validate3()) {
        event.preventDefault();
        $(".btnw li:eq(3) a").tab('show');
      }else {
        $('.addreq').attr('action', '{{route('manpowerreq.save')}}');
        $('.addreq').submit();
      }
    });
    $('.bk').on('click', function(event) {
      var id=$(this).attr('data-inx');
        $(".btnw li:eq("+id+") a").tab('show');
    });
    $('.nxft').on('click', function(event) {
      if (validate()) {
        $(".btnw li:eq(1) a").tab('show');
      }
    });
    $('.nxtw').on('click', function(event) {
      if (validatejd()) {
        $(".btnw li:eq(2) a").tab('show');
      }
    });
    $('.nxtr').on('click', function(event) {
      if (validate2()) {
        $(".btnw li:eq(3) a").tab('show');
      }
    });
    $('.nxfo').on('click', function(event) {
      if (validate3()) {
        $(".btnw li:eq(4) a").tab('show');
      }
    });
  });
  </script>
@endsection
