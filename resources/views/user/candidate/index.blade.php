@extends('template.mainuser')

@section('titlepage','Candidate')

@section('title')
<i class="fa fa-users"></i> Candidate
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
          <form action="" method="get">
          <div class="col-xs-12 col-sm-6 col-lg-4">
                  <div class="form-group">
                      <label for="po">Position</label>
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-briefcase"></i></div>
                          <select name="posit" id="po" class="form-control">
                              <option value=""></option>
                          </select>
                      </div>
                  </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-lg-4">
                  <div class="form-group">
                          <label for="ed">Education</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-mortar-board"></i></div>
                              <select name="edu" id="ed" class="form-control">
                                  <option value=""></option>
                              </select>
                          </div>
                      </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-lg-4">
                  <div class="form-group">
                          <label for="ex">Experience</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-bullseye"></i></div>
                              <input type="number" name="exp" id="ex" class="form-control" placeholder="Year">
                          </div>
                      </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-lg-3">
                  <div class="form-group">
                          <label for="ag">Age</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-male"></i></div>
                              <input type="number" name="age" id="ag" class="form-control" placeholder="Year">
                          </div>
                      </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-lg-3">
                  <div class="form-group">
                          <label for="sx">Sex</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-male"></i><i class="fa fa-female"></i></div>
                              <select name="sex" id="sx" class="form-control">
                                  <option value=""></option>
                              </select>
                          </div>
                      </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-lg-3">
                  <div class="form-group">
                          <label for="ag">EQ</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-male"></i></div>
                              <input type="number" name="eq" id="eq" class="form-control" placeholder="EQ Score">
                          </div>
                      </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-lg-3">
                  <div class="form-group">
                          <label for="ag">IQ</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-male"></i></div>
                              <input type="number" name="iq" id="iq" class="form-control" placeholder="IQ Score">
                          </div>
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
                            <a href="http://"><b>{{$value->getposition->first()->posit_id}}</b></a><br>
                            <b>Age: </b>{{$value->age}}<br>
                            <b>Experience: </b> {{$value->gethisjob->sum('exp')}}<br>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                      <div class="col-xs-12">
                          <b>Education:</b>
                        @forelse ($value->getedu as $edu)
                            <p>{{$edu->edu_id}},</p>
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
                            <button type="button" class="btn btn-info" title="Detail"><i class="fa fa-file-text-o"></i></button>
                            <button type="button" class="btn btn-success" title="Interest">
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
  });
  </script>
@endsection
