@inject('user_text','App\Model\Masterdata\employee')
@extends('template.admin.mainadmin')
@section('titlepage','Request Status')
@section('munu_act1','active')

@section('title_head')
  <i class="fa fa-tachometer"></i> Request Status
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-warning')
        @slot('title')
          <i class="fa fa-certificate"></i> New Request
        @endslot
        @slot('overlay','')
        <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>Req No.</th>
              <th>Position</th>
              <th>Requestor</th>
              <th>Type</th>
              <th>Menu</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($nj as $value)
              <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->position}}</td>
                @php
                  $user_txt=$user_text::find($value->user_id);
                @endphp
                <td>{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$value->user_id}}</td>
                <td><label class="label label-success">Manpower</label></td>
                <td>
                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                  <button type="button" class="btn bg-olive btn-assign" data-toggle="modal" data-target=".assign"  data-id="{{$value->id}}" title="Assign Request"><i class="fa fa-users"></i></button>
                  </div>
                </td>
              </tr>
            @endforeach
            @foreach ($rnj as $valuernj)
              <tr>
              <td>{{$valuernj->id}}</td>
              @php
                $rnjp=$user_text::find($valuernj->user_id);
                $rnjp2=$user_text::find($valuernj->code);
              @endphp
              <td>{{(isset($rnjp2->posit))?$rnjp2->posit:$valuernj->code}}</td>
              <td>{{(isset($rnjp))?$rnjp->fname_en.' '.$rnjp->lname_en:$valuernj->user_id}}</td>
              <td><label class="label label-danger">Resign</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valuernj->id}}"><i class="fa fa-info-circle"></i></button>
                <button type="button" class="btn bg-olive btn-assign-resign" data-toggle="modal" data-target=".assign"  data-id="{{$valuernj->id}}" title="Assign Request"><i class="fa fa-users"></i></button>
                </div>
              </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      @endcomponent
    </div>
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-info')
        @slot('title')
          <i class="fa fa-tasks"></i> Assign Request
        @endslot
        @slot('overlay','')
        <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>Req No.</th>
              <th>Position</th>
              <th>Operator</th>
              <th>Type</th>
              <th>Menu</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($aj as $value)
            <tr>
              <td>{{$value->id}}</td>
              <td>{{$value->position}}</td>
              @php
                $user_txt=$user_text::find($value->user_em_id);
              @endphp
              <td>{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$value->user_em_id}}</td>
              <td><label class="label label-success">Manpower</label></td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                  <button type="button" class="btn bg-olive btn-assign" data-toggle="modal" data-target=".assign"  data-id="{{$value->id}}" title="Assign Request"><i class="fa fa-users"></i></button>
                </div>
              </td>
            </tr>
            @endforeach
            @foreach ($raj as $valueraj)
              <tr>
              <td>{{$valueraj->id}}</td>
              @php
              $rajp=$user_text::find($valueraj->code);
              @endphp
              <td>{{(isset($rajp->posit))?$rajp->posit:$valueraj->code}}</td>
              @php
                $user_txt=$user_text::find($valueraj->user_em_id);
              @endphp
              <td>{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$valueraj->user_em_id}}</td>
              <td><label class="label label-danger">Resign</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valueraj->id}}"><i class="fa fa-info-circle"></i></button>
                <button type="button" class="btn bg-olive btn-assign-resign" data-toggle="modal" data-target=".assign"  data-id="{{$valueraj->id}}" title="Assign Request"><i class="fa fa-users"></i></button>
                </div>
              </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      @endcomponent
    </div>
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-success')
        @slot('title')
          <i class="fa fa-check"></i> Complete Request
        @endslot
        @slot('overlay','')
        <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>Req No.</th>
              <th>Position</th>
              <th>Operator</th>
              <th>Type</th>
              <th>Menu</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sc as $value)
            <tr>
              <td>{{$value->id}}</td>
              <td>{{$value->position}}</td>
              @php
                $user_txt=$user_text::find($value->user_em_id);
              @endphp
              <td>{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$value->user_em_id}}</td>
              <td><label class="label label-success">Manpower</label></td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                </div>
              </td>
            </tr>
            @endforeach
            @foreach ($rsc as $valuersc)
              <tr>
              <td>{{$valuersc->id}}</td>
              @php
                $rjcp=$user_text::find($valuersc->code);
              @endphp
              <td>{{(isset($rjcp->posit))?$rjcp->posit:$valuersc->code}}</td>
              @php
                $user_txt=$user_text::find($valuersc->user_em_id);
              @endphp
              <td>{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$valuersc->user_em_id}}</td>
              <td><label class="label label-danger">Resign</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valuersc->id}}"><i class="fa fa-info-circle"></i></button>
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

@component('template.component.model')
  @slot('title')
    <i class="fa fa-file-text-o"></i> Detail Request
  @endslot
  @slot('selector','detail')
  @slot('footer',null)
  @slot('bodysec','bodydesc')
@endcomponent

@component('template.component.model')
  @slot('title')
    <i class="fa fa-users"></i> Assign Request
  @endslot
  @slot('selector','assign')
  @slot('footer',null)
  @slot('bodysec','bodyassign')
@endcomponent

@section('script')
  <script>
    $(function() {
      $('table').DataTable({
        order: [[ 0, "desc" ]]
    });
      $('.table').on('click','.btn-desc', function(event) {
        var id=$(this).attr('data-id');
        $.get('admin/dashboard/detail/'+id).done(function(data) {
          $('.bodydesc').html(data);
          if(typeof sede != 'undefined'){
            sede.select2('destroy');
          }
          var sede=$('.se-detail').select2({
            width:'100%'
          });
        }).fail(function() {
          console.error('Error Detail Load');
          location.reload();
        });
      });
      $('.table').on('click','.btn-assign', function(event) {
        var id=$(this).attr('data-id');
        $.get('admin/dashboard/assign/'+id).done(function(data) {
          $('.bodyassign').html(data);
        }).fail(function() {
          console.error('Error Assign User Load');
        });
      });
      $('.table').on('click','.btn-assign-resign', function(event) {
        var id=$(this).attr('data-id');
        $.get('admin/dashboard/assignrsg/'+id).done(function(data) {
          $('.bodyassign').html(data);
        }).fail(function() {
          console.error('Error Assign User Load');
        });
      });
      $('.table').on('click','.btn-desc-resign', function(event) {
        var id=$(this).attr('data-id');
        $.get('admin/dashboard/detailrsg/'+id).done(function(data) {
          $('.bodydesc').html(data);
        }).fail(function() {
          console.error('Error Detail Load');
          location.reload();
        });
      });
    });
  </script>
@endsection
