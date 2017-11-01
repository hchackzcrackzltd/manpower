@extends('template.admin.mainadmin')
@section('titlepage','Authorize')
@section('munu_act2','active')

@section('title_head')
  <i class="fa fa-users"></i> Authorize
@endsection

@section('breadcrumb')
  <li class="active">Authorize</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-primary')
        @slot('title')
          <i class="fa fa-user"></i> List of users
        @endslot
        @slot('overlay',null)
          <div class="btn-group">
            <a class="btn btn-success" href="{{route('authorize.create')}}" data-toggle="tooltip" title="Add user">
              <i class="fa fa-plus-circle"></i> ADD</a>
          </div><br><br>
        <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>No.</th>
              <th>Username</th>
              <th>Name</th>
              <th>Type</th>
              <th>Menu</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no=1;
            @endphp
            @foreach ($data as $value)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$value->username}}</td>
                <td>{{$value->name}}</td>
                <td>{{($value->is_admin)?'Admin':'User'}}</td>
                <td>
                  <form action="{{route('authorize.destroy',['authorize'=>$value->id])}}" method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                  <div class="btn-group">
                  <a class="btn btn-warning" title="Setting Authorize" data-toggle="tooltip" href="{{route('authorize.edit',['authorize'=>$value->id])}}">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <button type="submit" class="btn btn-danger" title="Delete This User" data-toggle="tooltip">
                    <i class="fa fa-trash-o"></i>
                  </button>
                  </div>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
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
