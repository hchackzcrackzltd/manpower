@extends('template.admin.mainadmin')
@section('titlepage','Division')
@section('munu_act2','active')
@section('title_head')
  <i class="fa fa-sitemap"></i> Division
@endsection

@section('breadcrumb')
  <li>Setting</li>
  <li><a href="{{route('approve.index')}}">Approve</a></li>
  <li class="active">Division</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    @component('template.component.boxcontent')
      @slot('boxtype','box-success')
      @slot('title')
        <i class="fa fa-list"></i> List of Division
      @endslot
      @slot('overlay',null)
        @php
          $no=1;
        @endphp
        <div class="row">
          <div class="col-xs-12">
            <div class="btn-group">
              <button type="button" class="btn btn-success btn-add" title="Add Party" data-toggle="modal" data-target=".pdreq">
                <i class="fa fa-plus-circle"></i> ADD
              </button>
            </div><br><br>
          </div>
          <div class="col-xs-12">
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-hover text-center">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Division</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $value)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$value->party_th}} {{$value->party_en}}</td>
                    <td>{{$value->dep_th}} {{$value->dep_en}}</td>
                    <td>
                    <form action="{{route('approve.destroy',['approve'=>$value->id])}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                    <div class="btn-group">
                      <a href="{{route('approve.indexdep' ,['depid'=>$value->id])}}" class="btn btn-primary" title="Add Member" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a>
                      <button type="submit" class="btn btn-danger" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></button>
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

@component('template.component.model')
  @slot('title')
    <i class="fa fa-plus-circle"></i> Add Party/Department
  @endslot
  @slot('selector','pdreq')
  @slot('footer',null)
  @slot('bodysec','bodypdreq')
@endcomponent

@section('script')
  <script>
  $(function() {
    $('table').DataTable();
    $('.btn-add').on('click', function(event) {
      $.get('{{route('approve.show',['approve'=>$func_id])}}').done(function(data) {
        $('.bodypdreq').html(data);
        $('select[name=party]').trigger('change');
      }).fail(function() {
        console.error('Load Add Page');
      });
    });
    $('.bodypdreq').on('change', 'select[name=party]', function(event) {
      $.get('../getdepartment/'+$(this).val()).done(function(data) {
        $('select[name=department]').empty();
        $.each(JSON.parse(data),function(index, el) {
          $('select[name=department]').append("<option value='"+el.code+"'>"+el.name_th+"</option>");
        });
      }).fail(function() {
        console.error('Load Department');
      });
    });
    $('.bodypdreq').on('submit', '.savepd', function(event) {
      $('.bodypdreq').find('.pt,.dp').removeClass('has-error');
      if ($('.bodypdreq').find('select[name=party]').val()==null) {
        event.preventDefault();
        $('.bodypdreq').find('.pt').addClass('has-error');
        $('.bodypdreq').find('select[name=party]').focus();
        alertnotify('fa fa-ban','Please Select Party','error');
      }else if ($('.bodypdreq').find('select[name=department]').val()==null) {
        event.preventDefault();
        $('.bodypdreq').find('.pt').addClass('has-error');
        $('.bodypdreq').find('.dp').addClass('has-error');
        $('.bodypdreq').find('select[name=department]').focus();
        alertnotify('fa fa-ban','Please Select Department','error');
      }else {}
    });
  });
  </script>
@endsection
