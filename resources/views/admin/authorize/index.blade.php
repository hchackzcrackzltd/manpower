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
                  <form action="{{route('authorize.destroy',['authorize'=>$value->id])}}" method="post" name="delbtn{{$value->id}}" id="delbtn{{$value->id}}">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    </form>
                    <form action="{{route('authorize.restore')}}" method="post" name="rstbtn{{$value->id}}" id="rstbtn{{$value->id}}">
                      {{method_field('PATCH')}}
                      {{csrf_field()}}
                      <input type="hide" name="id" value="{{$value->id}}" class="hide">
                      </form>
                  <div class="btn-group">
                    @if (empty($value->deleted_at))
                      <a class="btn btn-warning" title="Setting Authorize" data-toggle="tooltip" href="{{route('authorize.edit',['authorize'=>$value->id])}}">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Delete" form="delbtn{{$value->id}}"><i class="fa fa-ban"></i></button>
                    @else
                      <button type="submit" class="btn btn-default" data-toggle="tooltip" title="Restore" form="rstbtn{{$value->id}}"><i class="fa fa-repeat"></i></button>
                    @endif
                  </div>
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
