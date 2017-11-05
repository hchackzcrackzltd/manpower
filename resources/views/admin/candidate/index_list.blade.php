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
@endsection

@section('script')
  <script>
  $(function(){
    $('.table').DataTable();
  });
  </script>
@endsection
