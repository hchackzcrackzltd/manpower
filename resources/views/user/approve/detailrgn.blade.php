@inject('time','Carbon\Carbon')
@inject('user_text','App\Model\Masterdata\employee')

<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li><a href="#sec_1" data-toggle="tab"><i class="fa fa-tasks"></i> Status</a></li>
    <li class="active"><a href="#sec_2" data-toggle="tab"><i class="fa fa-file-text-o"></i> Request detail</a></li>
    @if (count($apl)>0)
    <li><a href="#sec_3" data-toggle="tab"><i class="fa fa-check-circle"></i> Approve</a></li>
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
    <div class="tab-pane fade in active" id="sec_2">
      <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3 pull-right">
          <div class="form-group">
            <label for="eff">Effective Date</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
              <input type="text" class="form-control" id="eff" placeholder="Effective Date" value="{{$time::parse($fm->effect_date)->format('d M Y')}}" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3 pull-right">
          <div class="form-group">
            <label for="ldfw">Last working date</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" class="form-control" id="ldfw" placeholder="Last date for work" value="{{$time::parse($fm->last_date)->format('d M Y')}}" disabled>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-9">
          @php
          $fm_data=$user_text::find($fm->code);
          @endphp
          <div class="form-group">
            <label for="em_type">Employee Type</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-male"></i></span>
              <input type="text" class="form-control" id="em_type" value="{{(isset($fm_data))?$fm_data->emp_type:null}}" placeholder="Employee Type" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-3">
          <div class="form-group">
            <label for="locat">Location</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input type="text" class="form-control" id="locat" value="{{(isset($fm_data))?$fm_data->branch_code:null}}" placeholder="Location" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-9">
          <div class="form-group">
            <label for="name">Name</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control" id="name" value="{{(isset($fm_data))?$fm_data->fname_en:$fm->code}} {{(isset($fm_data))?$fm_data->lname_en:null}}" placeholder="name" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-3">
          <div class="form-group">
            <label for="code">Code</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
              <input type="text" class="form-control" id="code" value="{{$fm->code}}" placeholder="Code" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="posit">Position</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="ion-person-stalker"></i></span>
              <input type="text" class="form-control" id="posit" value="{{(isset($fm_data))?$fm_data->posit:null}}" placeholder="Position" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="dep">Department</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
              <input type="text" class="form-control" id="dep" value="{{(isset($fm_data))?$fm_data->dep:null}}" placeholder="Department" disabled>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="rsn">Reason</label>
            <textarea name="rsn" rows="5" class="form-control" placeholder="Reason for resign" disabled>{{$fm->reason}}</textarea>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="rk">Remark</label>
            <textarea name="rk" rows="5" class="form-control" placeholder="Remark" disabled>{{$fm->remark}}</textarea>
          </div>
        </div>
      </div>
    </div>
    @if (count($apl)>0)
    <div class="tab-pane fade" id="sec_3">
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
