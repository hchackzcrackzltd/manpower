@extends('template.mainuser')

@section('titlepage','Candidate')

@section('title')
<i class="fa fa-users"></i> Candidate
@endsection

@section('breadcrumb')
  <li class="active"><i class="fa fa-users"></i> Candidate</li>
@endsection

@section('subtitle',null)

@section('content')
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          @component('template.component.boxcontent')
          @slot('boxtype','box-success')
          @slot('title')
            <i class="fa fa-search"></i> Search
          @endslot
          @slot('overlay','')
          <form action="{{route('candidatesh.search')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
          <div class="col-xs-12 col-sm-7 col-lg-8">
                  <div class="form-group">
                      <label for="po">Position</label>
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                          <select name="posit" id="po" class="form-control">
                            @foreach ($ref_posit as $key => $value)
                              <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>
          </div>
          <div class="col-xs-12 col-sm-5 col-lg-4">
                  <div class="form-group">
                    <label for="sx">Sex</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-male"></i><i class="fa fa-female"></i></div>
                        <select name="sex" id="sx" class="form-control">
                            <option value="100">All</option>
                            <option value="0">นาย Mr.</option>
                            <option value="1">นาง Mrs.</option>
                            <option value="2">นางสาว Miss.</option>
                        </select>
                    </div>
                      </div>
          </div>
          <div class="col-xs-12">
                  <div class="form-group">
                          <label for="ed">Education</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-mortar-board"></i></div>
                              <select name="edu[]" id="ed" class="form-control" multiple>
                                @foreach ($ref_edu as $value)
                                  <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
          </div>
          <div class="col-xs-12 col-lg-6">
                  <div class="form-group">
                          <label for="ag">Age</label>
                              <input type="text" name="age" id="age">
                      </div>
          </div>
          <div class="col-xs-12 col-lg-6">
                  <div class="form-group">
                    <label for="ex">Experience</label>
                    <input type="text" name="exp" id="exp">
                      </div>
          </div>
          <div class="col-xs-12 col-lg-6">
                  <div class="form-group">
                          <label for="ag">EQ</label>
                          <input type="text" name="eq" id="eq">
                      </div>
          </div>
          <div class="col-xs-12 col-lg-6">
                  <div class="form-group">
                          <label for="ag">IQ</label>
                          <input type="text" name="iq" id="iq">
                      </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
              <button type="submit" class="btn btn-success" title="Search" data-toggle="tooltip"><i class="fa fa-search"></i> Search</button>
          </div>
      </form>
          @endcomponent
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          @component('template.component.boxcontent')
          @slot('boxtype','box-info')
          @slot('title')
            <i class="fa fa-list"></i> List of candidate
          @endslot
          @slot('overlay','')
            <div class="row">
              @forelse ($data as  $value)
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <img src="{{asset('img/No_image_available.png')}}" class="img-responsive" alt="Image">
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <a href="{{route('candidatesh.detail',['id'=>$value->id])}}" target="_blank"><b>{{(count($value->getposition)>0)?$ref_posit->where('id',$value->getposition->first()->posit_id)->first()->name:'N/A'}}</b></a><br>
                            <b>Age: </b>{{$value->age}}<br>
                            <b>Experience: </b> {{(count($value->gethisjob)>0)?$value->gethisjob->sum('exp'):0}}<br>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <div class="col-xs-12">
                          <b>Education:</b>
                        @forelse ($value->getedu as $edu)
                            <p>{{$ref_edu->where('id',$edu->edu_id)->first()->name}},</p>
                        @empty
                          <p>No Education Data</p>
                        @endforelse
                      </div>
                      <div class="col-xs-12 col-md-6 col-lg-4">
                        <b>IQ Score:</b> {{(empty($value->iq))?0:$value->iq}}
                      </div>
                      <div class="col-xs-12 col-md-6 col-lg-4">
                        <b>EQ Score:</b> {{(empty($value->eq))?0:$value->eq}}
                      </div>
                      <div class="col-xs-12 col-lg-4">
                        <b>MBTI:</b> {{(empty($value->mbti))?'No Data':$value->mbti}}
                      </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center">
                        <div class="btn-group">
                            <a type="button" class="btn btn-info" title="Detail" href="{{route('candidatesh.detail',['id'=>$value->id])}}" target="_blank"><i class="fa fa-file-text-o"></i></a>
                            <button type="button" class="btn btn-success hide" title="Interest">
                              <i class="fa fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
              @empty
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                  <h4>Can't Found Candidate <i class="fa fa-question-circle"></i></h4>
                </div>
              @endforelse
            </div>
          @endcomponent
      </div>
  </div>
@endsection

@section('script')
  <script>
  $(function() {
    $('select').select2({
      placeholder:'Plase Select'
    });
    $('#age').ionRangeSlider({
      type: "double",
      grid: true,
      min: 20,
      max: 60,
      postfix: " Year",
      decorate_both: true
    });
    $('#exp').ionRangeSlider({
      type: "double",
      grid: true,
      min: 0,
      max: 40,
      postfix: " Year",
      decorate_both: true
    });
    $('#iq').ionRangeSlider({
      type: "double",
      grid: true,
      min: 0,
      max: 80,
      postfix: " Score",
      decorate_both: true
    });
    $('#eq').ionRangeSlider({
      type: "double",
      grid: true,
      min: 0,
      max: 80,
      postfix: " Score",
      decorate_both: true
    });
  });
  </script>
@endsection
