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
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
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
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                          <label for="ed">Education</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-mortar-board"></i></div>
                              <select name="edu" id="ed" class="form-control" multiple>
                                  <option value=""></option>
                              </select>
                          </div>
                      </div>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                  <div class="form-group">
                          <label for="ex">Experience</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-bullseye"></i></div>
                              <input type="text" name="" id="ex" class="form-control">
                          </div>
                      </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                          <label for="ag">Age</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-male"></i></div>
                              <input type="text" name="" id="ag" class="form-control">
                          </div>
                      </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                          <label for="sx">Sex</label>
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-male"></i><i class="fa fa-female"></i></div>
                              <select name="" id="sx" class="form-control">
                                  <option value=""></option>
                              </select>
                          </div>
                      </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
              <button type="submit" class="btn btn-success" title="Search"><i class="fa fa-search"></i> Search</button>
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
                            <img src="#" class="img-responsive" alt="Image">
                        </div>
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <a href="http://"><b>title_job</b></a>
                            <p>Age: </p>
                            <p>Experience: </p>
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                        <b>Education:</b>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info" title="Detail"><i class="fa fa-info-circle"></i></button>
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
    $('select').select2();
  });
  </script>
@endsection
