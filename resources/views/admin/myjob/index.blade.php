@extends('template.admin.mainadmin')
@section('titlepage','My Job')
@section('munu_act3','active')
@inject('user_text','App\Model\Masterdata\employee')

@section('title_head')
  <i class="fa fa-briefcase"></i> My Job
@endsection

@section('breadcrumb')
  <li class="active">My Job</li>
@endsection

@section('content')
  <div class="row">
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
              <th>Requestor</th>
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
                $user_txt=$user_text::find($value->user_id);
              @endphp
              <td>{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$value->user_id}}</td>
              <td><label class="label label-success">Manpower</label></td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                  <button type="button" class="btn bg-orange btn-updatereq" data-toggle="modal" data-target=".updatereq"  data-id="{{$value->id}}" title="Update Request"><i class="fa fa-pencil"></i></button>
                  <button type="button" class="btn btn-danger btn-cancleman" data-toggle="modal" data-target=".canclereq"  data-id="{{$value->id}}" title="Cancle Request"><i class="fa fa-ban"></i></button>
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
                $user_txt=$user_text::find($valueraj->user_id);
              @endphp
              <td>{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$valueraj->user_em_id}}</td>
              <td><label class="label label-danger">Resign</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valueraj->id}}"><i class="fa fa-info-circle"></i></button>
                <button type="button" class="btn bg-orange btn-updatereq-rsg" data-toggle="modal" data-target=".updatereq"  data-id="{{$valueraj->id}}" title="Update Request"><i class="fa fa-pencil"></i></button>
                <button type="button" class="btn btn-danger btn-canclersg" data-toggle="modal" data-target=".canclereq"  data-id="{{$valueraj->id}}" title="Cancle Request"><i class="fa fa-ban"></i></button>
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
              <th>Requestor</th>
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
                $user_txt=$user_text::find($value->user_id);
              @endphp
              <td>{{(isset($user_txt))?$user_txt->fname_en.' '.$user_txt->lname_en:$value->user_id}}</td>
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
                $user_txt=$user_text::find($valuersc->user_id);
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
      <i class="fa fa-file-text-o"></i> Personal Data
    @endslot
    @slot('selector','updatereq')
    @slot('footer',null)
    @slot('bodysec','bodyupdatereq')
  @endcomponent

  @component('template.component.model')
    @slot('title')
      <i class="fa fa-file-text-o"></i> Cancel Request
    @endslot
    @slot('selector','canclereq')
    @slot('footer',null)
    @slot('bodysec','bodycanclereq')
  @endcomponent
@endsection



@section('script')
  <script>
    $(function() {
      $('table').DataTable({
        order: [[ 0, "desc" ]]
    });
      $('.table').on('click','.btn-desc', function(event) {
        var table,sede;
        var id=$(this).attr('data-id');
        $.get('dashboard/detail/'+id).done(function(data) {
          $('.bodydesc').html(data);
          if(typeof sede != 'undefined'){
            sede.select2('destroy');
          }
          if(typeof table != 'undefined'){
            table.destroy();
          }
          sede=$('.se-detail').select2({
            width:'100%'
          });
          table=$('.can').DataTable();
        }).fail(function() {
          console.error('Error Detail Load');
          location.reload();
        });
      });
      $('.table').on('click','.btn-desc-resign', function(event) {
        var id=$(this).attr('data-id');
        $.get('dashboard/detailrsg/'+id).done(function(data) {
          $('.bodydesc').html(data);
        }).fail(function() {
          console.error('Error Detail Load');
          location.reload();
        });
      });
      $('.table').on('click','.btn-updatereq', function(event) {
        var id=$(this).attr('data-id');
        $.get('myjob/'+id).done(function(data) {
          $('.bodyupdatereq').html(data);
          $('.sjdate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
          });
        }).fail(function() {
          console.error('Load Form Update');
        });
      });
      $('.table').on('click','.btn-updatereq-rsg', function(event) {
        var id=$(this).attr('data-id');
        $.get('myjob/rsg/'+id).done(function(data) {
          $('.bodyupdatereq').html(data);
        }).fail(function() {
          console.error('Load Form Update');
        });
      });
      $('.table').on('click','.btn-cancleman', function(event) {
        var id=$(this).attr('data-id');
        $.get('myjob/mancn/'+id).done(function(data) {
          $('.bodycanclereq').html(data);
        }).fail(function() {
          console.error('Load Form Update');
        });
      });
      $('.table').on('click','.btn-canclersg', function(event) {
        var id=$(this).attr('data-id');
        $.get('myjob/rsgcn/'+id).done(function(data) {
          $('.bodycanclereq').html(data);
        }).fail(function() {
          console.error('Load Form Update');
        });
      });
      $('.bodyupdatereq').on('submit','#uptfm', function(event) {
        var status=false;
        $('#tfname').each(function(index, el) {
          if ($(this).val().length<0) {
            status=true;
            $(this).focus();
            alertnotify('fa fa-ban','Please Insert First Name','error');
          }
        });
        $('#tlname').each(function(index, el) {
          if ($(this).val().length<0) {
            status=true;
            $(this).focus();
            alertnotify('fa fa-ban','Please Insert First Name','error');
          }
        });
        $('#fname').each(function(index, el) {
          if ($(this).val().length<0) {
            status=true;
            $(this).focus();
            alertnotify('fa fa-ban','Please Insert First Name','error');
          }
        });
        $('#lname').each(function(index, el) {
          if ($(this).val().length<0) {
            status=true;
            $(this).focus();
            alertnotify('fa fa-ban','Please Insert First Name','error');
          }
        });
        $('#sjdate').each(function(index, el) {
          if ($(this).val().length<0) {
            status=true;
            $(this).focus();
            alertnotify('fa fa-ban','Please Select Start Job Date','error');
          }
        });

        if (status) {
          event.preventDefault();
        }else {
        }
      });
    });
  </script>
@endsection
