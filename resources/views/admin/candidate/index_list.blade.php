@extends('template.admin.mainadmin')
@section('titlepage','Candidate')
@section('munu_act4','active')

@section('title_head')
  <i class="fa fa-user"></i> Candidate
@endsection

@section('breadcrumb')
  <li>Candidate</li>
  <li class="active">List Candidate</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-success')
        @slot('title')
          <i class="fa fa-list"></i> List of Candidate
        @endslot
        @slot('overlay',null)
          <div class="row">
            <div class="col-xs-12 form-inline">
              <form action="{{route('cannidate_new.create')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                  <div class="form-group">
                    <label for="fim">Insert File</label>
                    <input type="file" class="form-control" name="file_im" id="fim" required>
                  </div>
                  <button type="submit" class="btn btn-success" title="Import Candidate From Application Form" data-toggle="tooltip">
                    <i class="fa fa-download"></i> Import
                  </button>
                  <label class="label label-warning"><i class="fa fa-warning"></i> (Support File Export From Appplication Form Only)</label><br><br>
                  </form>
            </div>
            <div class="col-xs-12">
              <div class="table-responsive">
                <table class="table table-condensed table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">ชื่อ-นามสกุล</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Position</th>
                      <th class="text-center">Interest</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $value)
                    <tr>
                      <td>{{$loop->index+1}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{$value->nameeng}}</td>
                      <td>
                        @foreach ($value->getposition as $valuepo)
                          {{$ref_posit->where('id', $valuepo->posit_id)->first()->name}},
                        @endforeach
                        {{$value->etc_posit}}
                      </td>
                      <td><span class="badge">{{$value->interest}}</span></td>
                      <td>
                        <form action="{{route('cannidate_new.destroy',['id'=>$value->id])}}" method="post">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        <div class="btn-group">
                          <a class="btn btn-info" title="Resume" target="_blank" href="{{route('cannidate_new.detail',['id'=>$value->id])}}" data-toggle="tooltip">
                            <i class="fa fa-file-text-o"></i>
                          </a>
                          <button type="submit" class="btn btn-success" title="Candidate Select" data-toggle="tooltip"><i class="fa fa-check"></i></button>
                          <button type="button" class="btn btn-warning upiqeqmbtibtn" data-toggle="modal" data-target=".iqeqmbti" title="Update IQ,EQ,MBTI" data-id='{{$value->id}}'>
                            <i class="fa fa-pencil"></i>
                          </button>
                        </div>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      @endcomponent
    </div>
  </div>
  @component('template.component.model')
    @slot('selector','iqeqmbti')
    @slot('title')
      <i class='fa fa-pencil'></i> Update Resume
    @endslot
    @slot('bodysec',null)
    @slot('footer',null)
      <form action="{{route('cannidate_new.iqeqmbti')}}" method="post">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <input type="hidden" class="hide" name="id" id="iqeqmbti" required>
      <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="form-group">
            <label for="iq">IQ</label>
            <input type="number" min="0" max="200" class="form-control" name="iq" id="iq" placeholder="IQ Score">
            <p class="help-block">Please Insert IQ Score.</p>
          </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="form-group">
            <label for="eq">EQ</label>
            <input type="number" min="0" max="200" class="form-control" name="eq" id="eq" placeholder="EQ Score">
            <p class="help-block">Please Insert EQ Score.</p>
          </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="form-group">
            <label for="mbti">MBTI</label>
            <input type="text" class="form-control" id="mbti" name="mbti" placeholder="MBTI">
            <p class="help-block">Please Insert MBTI.</p>
          </div>
        </div>
        <div class="col-xs-12 text-right">
          <div class="btn-group">
            <button type="submit" class="btn btn-success" title="Save" data-togle="tooltip">
              <i class="fa fa-floppy-o"></i> Save
            </button>
            <button type="reset" class="btn btn-danger" title="Reset" data-togle="tooltip">
              <i class="fa fa-repeat"></i> Reset
            </button>
          </div>
        </div>
      </div>
      </form>
  @endcomponent
@endsection

@section('script')
  <script>
  $(function(){
    $('.table').DataTable();
    $('.upiqeqmbtibtn').on('click', function(event) {
      $('#iqeqmbti').val($(this).attr('data-id'));
    });
  });
  </script>
@endsection
