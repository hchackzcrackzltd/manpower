@extends('template.admin.mainadmin')
@section('titlepage','Cannidate')
@section('munu_act2','active')
@section('title_head')
  <i class="fa fa-check-circle"></i> Approve
@endsection

@section('breadcrumb')
  <li>Setting</li>
  <li class="active">Approve</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    @component('template.component.boxcontent')
      @slot('boxtype','box-success')
      @slot('title')
        <i class="fa fa-list"></i> List of function
      @endslot
      @slot('overlay',null)
        @php
          $no=1;
        @endphp
        <div class="row">
          <div class="col-xs-12">
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover text-center">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Function</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $value)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$value->name}}</td>
                    <td><a href="{{route('approve.indexfunc',['funcid'=>$value->id])}}" class="btn btn-primary" title="Setting" data-toggle="tooltip"><i class="fa fa-cog"></i></a></td>
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
  $(function() {
    $('.table').DataTable();
  });
  </script>
@endsection
