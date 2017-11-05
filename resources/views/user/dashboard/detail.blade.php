@inject('time','Carbon\Carbon')
@inject('edu','App\Model\Masterdata\education')
@inject('fac','App\Model\Masterdata\faculty')
@inject('sw','App\Model\Masterdata\softreq')
@inject('ac','App\Model\Masterdata\acereq')
@inject('user_text','App\Model\Masterdata\employee')
@inject('offac','App\Model\Masterdata\offac')

<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li><a href="#sec_1" data-toggle="tab"><i class="fa fa-tasks"></i> Status</a></li>
    <li class="active"><a href="#sec_2" data-toggle="tab"><i class="fa fa-file-text-o"></i> Request detail</a></li>
    @if (count($apl)>0)
    <li><a href="#sec_4" data-toggle="tab"><i class="fa fa-check-circle"></i> Approve</a></li>
  @endif
    @if (collect(['AJ'])->search($fm->status)>-1)
    <li><a href="#sec_3" data-toggle="tab"><i class="fa fa-users"></i> Candidate selected</a></li>
  @endif
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade" id="sec_1">
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
              $user_txt=$user_text::where('id',$fm->user_em_id)->first();
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
      @if (collect(['CN'])->search($fm->status)>-1)
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="">Reason</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                <textarea class="form-control" rows="5" placeholder="No Reason" disabled>{{$fm->em_remark}}</textarea>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
    <div class="tab-pane fade in active" id="sec_2">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info"></i> Information <span class="badge">1</span></a></li>
          <li><a href="#tab_2" data-toggle="tab"><i class=" fa fa-asterisk"></i> Job Description <span class="badge bg-teal">2</span></a></li>
          <li><a href="#tab_3" data-toggle="tab"><i class="ion-laptop"></i> Computer <span class="badge bg-blue">3</span></a></li>
          <li><a href="#tab_4" data-toggle="tab"><i class="ion-model-s"></i> Fleet card&Car <span class="badge bg-aqua">4</span></a></li>
          <li><a href="#tab_5" data-toggle="tab"><i class="fa fa-thumb-tack"></i> Office equipment <span class="badge bg-green">5</span></a></li>
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
                  <label for="compa">Company</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    <input type="text" class="form-control" id="compa" placeholder="Company" value="{{strtoupper($fm->company_name)}}" disabled>
                  </div>
                </div>
              </div>
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
                    <span class="input-group-addon"><i class="fa fa-male"></i></span>
                    <input type="text" class="form-control" id="em_type" placeholder="Employee Type" value="{{$fm->em_type_text}}" disabled>
                  </div>
                </div>
              </div>
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
              <div class="col-xs-12">
                <div class="form-group">
                  <label for="">Immediate Manager</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                    @php
                      $data_imd=$user_text::where('id',$fm->imd_id)->first();
                    @endphp
                    <input type="text" class="form-control" value="{{$data_imd->fname_en}} {{$data_imd->lname_en}}" disabled>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 {{($fm->rfm_id==1||$fm->rfm_id==2)?null:'col-md-6 col-lg-5'}}">
                <div class="form-group">
                  <label for="">Reason For Employment</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-question-circle"></i></span>
                    <input type="text" class="form-control" value="{{$fm->rfm}}" disabled>
                  </div>
                </div>
              </div>
              @if ($fm->rfm_id==2)
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="">Reason For Position Without budget</label>
                    <textarea class="form-control" rows="5" disabled>{{$fm->rfm_nfb}}</textarea>
                  </div>
                </div>
              @endif
              @if ($fm->rfm_id==3)
                <div class="col-xs-12 col-md-6 col-lg-7">
                  <div class="form-group">
                    <label for="">Name</label>
                    @php
                      $data_rpm=$user_text::where('id',$fm->ren_name)->first();
                    @endphp
                    <input type="text" class="form-control" value="{{$data_rpm->fname_en}} {{$data_rpm->lname_en}}" disabled>
                  </div>
                </div>
              @endif
              @if ($fm->rfm_id==4)
                <div class="col-xs-12 col-md-6 col-lg-7">
                  <div class="form-group">
                    <label for="">Name</label>
                    @php
                      $data_rpm=$user_text::where('id',$fm->rfm_emp_id)->first();
                    @endphp
                    <input type="text" class="form-control" value="{{$data_rpm->fname_en}} {{$data_rpm->lname_en}}" disabled>
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
                <hr>
              </div>
              <div class="col-xs-12">
                <b>Employee specification</b>
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
                      @foreach (explode(',',$fm->edu_id) as $value)
                        <option selected>{{$edu::withoutGlobalScopes()->where('id',$value)->first()->name}}</option>
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
                      @foreach (explode(',',$fm->fac_id) as $value)
                        <option selected>{{$fac::withoutGlobalScopes()->where('id',$value)->first()->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <div class="row">
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
                  <label for="">Year Of Experience</label>
                  <div class="input-group">
                    <input type="text" class="form-control" value="{{$fm->exp_year}}" disabled>
                    <span class="input-group-addon"><b>Year</b></span>
                  </div>
                </div>
              </div>
              @endif
            <div class="col-xs-12">
              <div class="form-group">
                <label for="">Job Description</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-info"></i></span>
                  <textarea name="jd" class="form-control" style="resize:vertical" placeholder="Insert job description this here" rows="8" disabled>{{$fm->jd}}</textarea>
                </div>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group has-feedback">
                <label for="qua">Qualifications</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                  <textarea name="qua" class="form-control" style="resize:vertical" placeholder="Please specify qualifications" rows="8" disabled>{{$fm->qua}}</textarea>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="tab-pane" id="tab_3">
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
                      <li>{{$sw::withoutGlobalScopes()->where('id',$value)->first()->name}}</li>
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
                      <li>{{$ac::withoutGlobalScopes()->where('id',$value)->first()->name}}</li>
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
          <div class="tab-pane" id="tab_4">
            <ul>
                @if ($fm->fedc)
                <li><label for="">Fleet Card: <span class="label label-success">Use</span></label></li>
                @endif
              @if ($fm->car)
                <li><label for="">Car: <span class="label label-success">Use</span></label></li>
              @endif
                @if (strlen($fm->car_lp)>0)
                  <li><div class="form-group">
                    <label for="">Car Park: <span class="label label-success">Use</span></label>
                    <input type="text" class="form-control" value="{{$fm->car_lp}}" disabled>
                    <p class="help-block">License Plate</p>
                  </div></li>
                @endif
            </ul>
            @if (strlen($fm->car_lp)===0&&$fm->car!=1&&$fm->fedc!=1)
              <h3 class="text-center">No need fleet card or car.</h3>
            @endif
          </div>
          <div class="tab-pane" id="tab_5">
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
    @if (collect(['AJ'])->search($fm->status)>-1)
    <div class="tab-pane fade" id="sec_3">
      <div class="row">
        @forelse ($can as $value)
        <div class="col-xs-6 col-md-4 col-lg-3">
          <div class="col-xs-12">
            <a href="{{route('candidatesh.detail',['id'=>$value->getcandidate->id])}}" target="_blank">
            <img class="img-thumbnail" src="data:{{Storage::disk('local')->mimeType('exports/'.$value->getcandidate->getfile->where('type', 2)->first()->temp)}};base64,{{base64_encode(Storage::disk('local')->get('exports/'.$value->getcandidate->getFile->where('type', 2)->first()->temp))}}" alt="Picture Profile">
            </a>
          </div>
          <div class="col-xs-12">
            <a href="{{route('candidatesh.detail',['id'=>$value->getcandidate->id])}}" target="_blank" class="btn btn-link">{{$value->getcandidate->nameeng}}</a>
          </div>
          <div class="col-xs-6 text-center">
            <b>Age</b> <p>{{$value->getcandidate->age}}</p>
          </div>
          <div class="col-xs-6 text-center">
            <b>Experience</b> <p>{{$value->getcandidate->gethisjob->sum('exp')}}</p>
          </div>
        </div>
        @empty
          <div class="col-xs-12 text-center">
            <h4><i class="fa fa-question-circle"></i> No Candidate Select</h4>
          </div>
        @endforelse
      </div>
    </div>
    @endif
    @if (count($apl)>0)
    <div class="tab-pane fade" id="sec_4">
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr class="bg-primary">
              <th text-center>Name</th>
              <th text-center>Status</th>
              <th text-center>Reason</th>
            </tr>
          </thead>
          <tbody>
            @php
              $status_text=['Wait for approve','Pending','Approved','Reject'];
              $status_color=['label-info','label-warning','label-success','label-danger'];
            @endphp
            @foreach ($apl as $value)
              <tr>
                <td>{{$value->getemployee()->first()->name}}</td>
                <td>
                  <label class="label {{$status_color[$value->status]}}">
                    {{$status_text[$value->status]}}
                  </label>
                </td>
                <td>{{$value->reason}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
  </div>
</div>
