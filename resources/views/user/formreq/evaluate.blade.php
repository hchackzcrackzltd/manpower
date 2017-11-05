@extends('template.mainuser')
@inject('time','Carbon\Carbon')
@inject('edu','App\Model\Masterdata\education')
@inject('fac','App\Model\Masterdata\faculty')
@inject('sw','App\Model\Masterdata\softreq')
@inject('ac','App\Model\Masterdata\acereq')
@inject('user_text','App\Model\Masterdata\employee')

@section('titlepage','Evaluate Request')

@section('title')
<i class="fa fa-pencil-square-o"></i> Evaluate Request
@endsection

@section('subtitle','Form')

@section('breadcrumb')
  <li class="active"><i class="fa fa-pencil-square-o"></i> Evaluate Request Form</li>
@endsection

@section('content')
  @component('template.component.boxcontent')
    @slot('boxtype','box-primary')
    @slot('overlay',null)
    @slot('title')
      <i class="fa fa-file-text-o"></i> Evaluate Request
    @endslot
    <form class="" action="{{route('manpower.update' ,['evaluate'=>$fm->id])}}" method="post">
    {{method_field('PUT')}}
    {{csrf_field()}}
    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><b>Score</b></h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-12 text-center">
                <select class="ratting" name="score">
                  <option value="20">1</option>
                  <option value="40">2</option>
                  <option value="60">3</option>
                  <option value="80">4</option>
                  <option value="100">5</option>
                </select>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="comment">Comment</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                    <textarea name="comment" rows="5" class="form-control" placeholder="Insert comment here..."></textarea>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 pull-right text-right">
                <div class="btn-group">
                  <button type="reset" class="btn btn-default">
                    <i class="fa fa-repeat"></i> Reset
                  </button>
                  <button type="submit" class="btn btn-success">
                    <i class="fa fa-paper-plane"></i> Send
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>

    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#sec_1" data-toggle="tab"><i class="fa fa-tasks"></i> Status</a></li>
        <li><a href="#sec_2" data-toggle="tab"><i class="fa fa-file-text-o"></i> Request detail</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade in active" id="sec_1">
          @if (collect(['NJ','AJ','JC','SC'])->search($fm->status)>-1)
          <div class="row">
          <div class="col-xs-6 col-md-3">
            <div class="form-group">
              <label for="">Request Date</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                <input type="text" class="form-control" value="{{$time::parse($fm->time_str)->format('d M Y')}}" disabled>
              </div>
            </div>
          </div>
          @if (collect(['AJ','JC','SC'])->search($fm->status)>-1)
            <div class="col-xs-6 col-md-9">
            <div class="form-group">
              <label for="">Operator</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                @php
                  $user_txt=$user_text::find($fm->user_em_id);
                @endphp
                <input type="text" class="form-control" value="{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$fm->user_id}}" disabled>
              </div>
            </div>
            </div>
          @endif
          @if (collect(['JC','SC'])->search($fm->status)>-1)
            <div class="col-xs-6 col-md-4">
            <div class="form-group">
              <label for="">Start Job</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control" value="{{$time::parse($fm->time_agn)->format('d M Y')}}" disabled>
              </div>
            </div>
            </div>
            <div class="col-xs-6 col-md-4">
            <div class="form-group">
              <label for="">End Job</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control" value="{{$time::parse($fm->time_end)->format('d M Y')}}" disabled>
              </div>
            </div>
            </div>
            <div class="col-xs-12 col-md-4">
            <div class="form-group">
              <label for="">Average Time</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                @php
                  $dt1=$time::parse($fm->time_agn);
                  $dt2=$time::parse($fm->time_end);
                @endphp
                <input type="text" class="form-control" value="{{$dt1->diffForHumans($dt2)}}" disabled>
              </div>
            </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="remark_em">Remark</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-commenting-o"></i></span>
                  <textarea rows="5" class="form-control" placeholder="No Remark" disabled>{{$fm->em_remark}}</textarea>
                </div>
              </div>
            </div>
          @endif
          @if (collect(['SC'])->search($fm->status)>-1)
            <div class="col-xs-12">
              <div class="form-group">
                <label for="">Comment</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                  <textarea class="form-control" rows="5" disabled>{{$fm->comment}}</textarea>
                </div>
              </div>
            </div>
            <div class="col-xs-12">
              @php
                if ($fm->rate<21) {
                  $text_bar='progress-bar-danger';
                }elseif ($fm->rate<41) {
                $text_bar='progress-bar-warning';
              }elseif ($fm->rate<61) {
                $text_bar='progress-bar-info';
              }else {
                $text_bar='progress-bar-success';
              }
              @endphp
              <b>Score</b>
              <div class="progress">
                <div class="progress-bar progress-bar-striped active {{$text_bar}}" role="progressbar" aria-valuenow="{{$fm->rate}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$fm->rate}}%;">
                  <b>{{$fm->rate}}%</b>
                  <span class="sr-only">{{$fm->rate}}%</span>
                </div>
              </div>
            </div>
          @endif
          </div>
          @endif
        </div>
        <div class="tab-pane fade" id="sec_2">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info"></i> Information</a></li>
              <li><a href="#tab_2" data-toggle="tab"><i class="ion-android-laptop"></i> Computer</a></li>
              <li><a href="#tab_3" data-toggle="tab"><i class="ion-model-s"></i> Car&FleetCard</a></li>
              <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-thumb-tack"></i> Office equipment</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-xs-6 col-md-3 pull-right text-right">
                    <div class="form-group">
                      <label for="">Effective Date</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" value="{{$time::parse($fm->effect_date)->format('d M Y')}}" disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="locat">Location</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <input type="text" class="form-control" id="locat" placeholder="Location" value="{{strtoupper($fm->location)}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="em_type">Employee Type</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
                        <input type="text" class="form-control" id="em_type" placeholder="Employee Type" value="{{$fm->em_type_text}}" disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  @if (collect(['JC','SC'])->search($fm->status)>-1)
                    @foreach ($fm->getemp()->get() as $key => $value)
                    <div class="col-xs-12">
                      <div class="form-group">
                        <label for="">{{$key+1}}.ชื่อ-นามสกุล</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                          <input type="text" class="form-control" value="{{$value->name_th}}" disabled>
                        </div>
                      </div>
                    </div>
                  <div class="col-xs-12 col-md-7 col-lg-9">
                    <div class="form-group">
                      <label for="">Name</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                        <input type="text" class="form-control" value="{{$value->name_en}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-5 col-lg-3">
                    <div class="form-group">
                      <label for="">Code</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                        <input type="text" class="form-control" value="{{$value->code}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="">Start work date</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                        <input type="text" class="form-control" value="{{$time::parse($value->date_work)->format('d M Y')}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <hr>
                  </div>
                  @endforeach
                  @endif
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="">Position</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                        <input type="text" class="form-control" value="{{$fm->position}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 {{($fm->rfm_id==1)?null:'col-md-6 col-lg-5'}}">
                    <div class="form-group">
                      <label for="">Reason For Employment</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                        <input type="text" class="form-control" value="{{$fm->rfm}}" disabled>
                      </div>
                    </div>
                  </div>
                  @if ($fm->rfm_id==3)
                    <div class="col-xs-12 col-md-6 col-lg-7">
                      <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" value="{{$fm->ren_name}}" disabled>
                      </div>
                    </div>
                  @endif
                  @if ($fm->rfm_id==2)
                    <div class="col-xs-12 col-md-6 col-lg-7">
                      <div class="form-group">
                        <label for="">Reason</label>
                        <input type="text" class="form-control" value="{{$fm->rea_nfb}}" disabled>
                      </div>
                    </div>
                  @endif
                  <div class="col-xs-12 {{($fm->jt_id==1)?null:'col-md-6 col-lg-7'}}">
                    <div class="form-group">
                      <label for="">Job type</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                          <input type="text" class="form-control" value="{{$fm->jt}}" disabled>
                        </div>
                    </div>
                  </div>
                  @if ($fm->jt_id==2)
                    <div class="col-xs-12 col-md-6 col-lg-5">
                      <div class="form-group">
                        <label for="">Leadtime</label>
                        <div class="input-group">
                          <input type="text" class="form-control" value="{{$fm->tw_lead}}" disabled>
                          <span class="input-group-addon"><b>{{$fm->tw_lead_type_text}}</b></span>
                        </div>
                      </div>
                    </div>
                  @endif
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="">Job Description</label>
                      <textarea class="form-control" rows="6" disabled>{{$fm->jd}}</textarea>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <b>Job specification</b>
                  </div>
                  <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                      <label for="">Sex</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-male"></i><i class="fa fa-female"></i></span>
                        <input type="text" class="form-control" value="{{$fm->sex}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                      <label for="">Total amount</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" value="{{$fm->count}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                      <label for="">Age</label>
                      <div class="input-group">
                        <input type="text" class="form-control" value="{{$fm->age}}" disabled>
                        <span class="input-group-addon"><b>Year</b></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label for="">Education</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
                        <select class="form-control se-detail" multiple disabled>
                          @foreach (json_decode($fm->edu_id) as $value)
                            <option selected>{{$edu::find($value)->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label for="">Faculty</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                        <select class="form-control se-detail" multiple disabled>
                          @foreach (json_decode($fm->fac_id) as $value)
                            <option selected>{{$fac::find($value)->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 {{($fm->exp==1)?null:'col-md-6 col-lg-8'}}">
                    <div class="form-group">
                      <label for="">Experience</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
                        <input type="text" class="form-control" value="{{$fm->exp_text}}" disabled>
                      </div>
                    </div>
                  </div>
                  @if ($fm->exp==2)
                  <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                      <label for="">Experience Year</label>
                      <div class="input-group">
                        <input type="text" class="form-control" value="{{$fm->exp_year}}" disabled>
                        <span class="input-group-addon"><b>Year</b></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="">Aptitude</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                        <input type="text" class="form-control" value="{{$fm->exp_spc}}" disabled>
                      </div>
                    </div>
                  </div>
                  @endif
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="">Ability</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-trophy"></i></span>
                        <textarea class="form-control" cols="15" disabled>{{$fm->aly}}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="">Computer</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="ion-laptop"></i></span>
                        <input type="text" class="form-control" value="{{$fm->item_desc}}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <label for="">Computer Spec</label>
                      <textarea rows="6" class="form-control" disabled>{{$fm->detail}}</textarea>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    @if (strlen($fm->sw)>0)
                      <h4>Software</h4>
                      <ul>
                        @foreach (explode(',',$fm->sw) as $value)
                          <li>{{$sw::where('id',$value)->first()->name}}</li>
                        @endforeach
                      </ul>
                    @endif
                    @if (strlen($fm->sw_etc_spc)>0)
                    <h4>Software Other</h4>
                      <ul>
                        <li>{{$fm->sw_etc_spc}}</li>
                      </ul>
                    @endif
                  </div>
                  <div class="col-xs-12 col-md-6">
                    @if (strlen($fm->ac)>0)
                      <h4>Accessories</h4>
                      <ul>
                        @foreach (explode(',',$fm->ac) as $value)
                          <li>{{$ac::where('id',$value)->first()->name}}</li>
                        @endforeach
                      </ul>
                    @endif
                    @if (strlen($fm->ac_etc_spc)>0)
                    <h4>Accessories Other</h4>
                      <ul>
                        <li>{{$fm->ac_etc_spc}}</li>
                      </ul>
                    @endif
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <div class="row">
                  <div class="col-xs-12">
                    @if ($fm->fedc)
                    <label for="">Fleet Card: <span class="label label-success">Use</span></label><br>
                    @endif
                  @if ($fm->car)
                    <label for="">Car: <span class="label label-success">Use</span></label>
                  @endif
                    @if (strlen($fm->car_lp)>0)
                      <div class="form-group">
                        <label for="">Car Park: <span class="label label-success">Use</span></label>
                        <input type="text" class="form-control" value="{{$fm->car_lp}}" disabled>
                        <p class="help-block">License Plate</p>
                      </div>
                    @endif
                    @if (strlen($fm->car_lp)===0&&$fm->car!=1&&$fm->fedc!=1)
                      <h3 class="text-center">No need fleet card or car.</h3>
                    @endif
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab_4">
                <div class="row">
                  <div class="col-xs-12">
                    @if (strlen($fm->nmc)>0)
                    <label for="">Office Accessories</label><br>
                    <ul>
                      @foreach (explode(',',$fm->nmc) as $value)
                        <li>{{ucfirst($offac::where('id',$value)->first()->itemdesc)}}</li>
                      @endforeach
                    </ul>
                    @endif
                    @if (strlen($fm->ofa)>0)
                      <div class="form-group">
                        <label for="">Etc.</label>
                        <textarea rows="5" class="form-control" disabled>{{$fm->ofa}}</textarea>
                      </div>
                    @endif
                    @if (strlen($fm->remark)>0)
                      <div class="form-group">
                        <label for="">Remark</label>
                        <textarea rows="5" class="form-control" disabled>{{$fm->remark}}</textarea>
                      </div>
                    @endif
                    @if (strlen($fm->ofa)===0&&$fm->nmc!=1&&strlen($fm->remark)===0)
                      <h3 class="text-center">No need name card, office accessories and remark.</h3>
                    @endif
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </div>
  @endcomponent
@endsection

@section('script')
  <script>
    $(function() {
      $('.table').DataTable();
      $('.se-detail').select2({
        width:'100%'
      });
      $('.ratting').barrating({
        theme: 'fontawesome-stars',
        showValues:true
      });
    });
  </script>
@endsection
