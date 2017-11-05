@extends('template.admin.mainadmin')
@section('titlepage','History')
@section('munu_act4','active')

@section('title_head')
  <i class="fa fa-history"></i> History
@endsection

@section('breadcrumb')
  <li>Candidate</li>
  <li class="active">History</li>
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
                        <form action="{{route('cannidate_new.history_del',['id'=>$value->id])}}" method="post" name="delete" id="delete">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          </form>
                        <form action="{{route('cannidate_new.history_rev',['id'=>$value->id])}}" method="post" name="restore" id="restore">
                          {{csrf_field()}}
                          {{method_field('PATCH')}}
                          </form>
                        <div class="btn-group">
                          <a class="btn btn-info" title="Resume" target="_blank" href="{{route('cannidate_new.detail',['id'=>$value->id])}}" data-toggle="tooltip">
                            <i class="fa fa-file-text-o"></i>
                          </a>
                          <button type="submit" class="btn bg-purple" title="Recovery Candidate" data-toggle="tooltip" form="restore"><i class="fa fa-repeat"></i></button>
                          <button type="submit" class="btn btn-danger" title="Delete Candidate" data-toggle="tooltip" form="delete"><i class="fa fa-trash-o"></i></button>
                        </div>
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
