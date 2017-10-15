@inject('user_text','App\Model\Masterdata\employee')
@inject('time','Carbon\Carbon')
@extends('template.mainuser')

@section('titlepage','Request Status')

@section('title')
<i class="fa fa-check-circle"></i> Approve Status
@endsection

@section('subtitle',null)

@section('content')
  <div class="row">

  <div class="col-xs-12">
    @component('template.component.boxcontent')
      @slot('boxtype','box-warning')
      @slot('title')
        <i class="fa fa-certificate"></i> Request
      @endslot
      @slot('overlay','')
      <div class="table-responsive">
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th>Req No.</th>
            <th>Position</th>
            <th>Status</th>
            <th>Type</th>
            <th>Menu</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($app as $data)
            @php
              $value=$data->getmyreq()->notapp()->first();
            @endphp
            @if (isset($value))
            <tr>
              <td>{{$value->id}}</td>
              <td>{{$value->position}}</td>
              <td><label class="label {{($value->status==='NP')?'label-default':'label-warning'}} ">
                {{($data->approve==0)?'Wait for approve':$value->status_text}}
              </label></td>
              <td><label class="label label-success">Manpower</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                <button type="submit" form="A{{$data->type}}{{$data->request_id}}" class="btn btn-success" title="Approve" data-toggle="tooltip">
                  <i class="fa fa-check"></i>
                </button>
                <button type="button" data-id="{{$data->request_id}}" data-type="{{$data->type}}" class="btn btn-danger rej" title="Reject" data-toggle="tooltip">
                  <i class="fa fa-times"></i>
                </button>
                </div>
                <form name="A{{$data->type}}{{$data->request_id}}" id="A{{$data->type}}{{$data->request_id}}" action="{{route('approveu.update',['type'=>$data->type,'app'=>$data->request_id])}}" method="post">
                  {{csrf_field()}}
                {{method_field('PATCH')}}
                </form>
              </td>
            </tr>
            @endif
          @endforeach
          @foreach ($apprsg as $datarnj)
            @php
              $valuernj=$datarnj->getmyrsg()->notapp()->first();
            @endphp
            @if (isset($valuernj))
            <tr>
            <td>{{$valuernj->id}}</td>
            @php
              $rnjp=$user_text::find($valuernj->code);
            @endphp
            <td>{{(isset($rnjp->posit))?$rnjp->posit:$valuernj->code}}</td>
            <td><label class="label {{($valuernj->status==='NP')?'label-default':'label-warning'}} ">
              {{($datarnj->approve==0)?'Wait for approve':$value->status_text}}
            </label></td>
            <td><label class="label label-danger">Resign</label></td>
            <td>
              <div class="btn-group">
              <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valuernj->id}}"><i class="fa fa-info-circle"></i></button>
              <button type="submit" form="A{{$datarnj->type}}{{$datarnj->request_id}}" class="btn btn-success" title="Approve" data-toggle="tooltip">
                <i class="fa fa-check"></i>
              </button>
              <button type="button" data-id="{{$datarnj->request_id}}" data-type="{{$datarnj->type}}" class="btn btn-danger rej" title="Reject" data-toggle="tooltip">
                <i class="fa fa-times"></i>
              </button>
              </div>
              <form name="A{{$datarnj->type}}{{$datarnj->request_id}}" id="A{{$datarnj->type}}{{$datarnj->request_id}}" action="{{route('approveu.update',['type'=>$datarnj->type,'app'=>$datarnj->request_id])}}" method="post">
                {{csrf_field()}}
              {{method_field('PATCH')}}
              </form>
            </td>
            </tr>
            @endif
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
        <i class="fa fa-check-square-o"></i> Approve
      @endslot
      @slot('overlay','')
      <div class="table-responsive">
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th>Req No.</th>
            <th>Position</th>
            <th>Status</th>
            <th>Type</th>
            <th>Menu</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sapp as $data)
            @php
              $value=$data->getmyreq()->notapp()->first();
            @endphp
            @if (isset($value))
            <tr>
              <td>{{$value->id}}</td>
              <td>{{$value->position}}</td>
              <td><label class="label label-success">Approved</label></td>
              <td><label class="label label-success">Manpower</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                </div>
              </td>
            </tr>
            @endif
          @endforeach
          @foreach ($sapprsg as $datarnj)
            @php
              $valuernj=$datarnj->getmyrsg()->notapp()->first();
            @endphp
            @if (isset($valuernj))
            <tr>
            <td>{{$valuernj->id}}</td>
            @php
              $rnjp=$user_text::find($valuernj->code);
            @endphp
            <td>{{(isset($rnjp->posit))?$rnjp->posit:$valuernj->code}}</td>
            <td><label class="label label-success">Approved</label></td>
            <td><label class="label label-danger">Resign</label></td>
            <td>
              <div class="btn-group">
              <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valuernj->id}}"><i class="fa fa-info-circle"></i></button>
              </div>
            </td>
            </tr>
            @endif
          @endforeach
        </tbody>
      </table>
      </div>
    @endcomponent
  </div>

  <div class="col-xs-12">
    @component('template.component.boxcontent')
      @slot('boxtype','box-danger')
      @slot('title')
        <i class="fa fa-ban"></i> Reject
      @endslot
      @slot('overlay','')
      <div class="table-responsive">
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th>Req No.</th>
            <th>Position</th>
            <th>Status</th>
            <th>Type</th>
            <th>Menu</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($capp as $data)
            @php
              $value=$data->getmyreq()->notapp()->first();
            @endphp
            @if (isset($value))
            <tr>
              <td>{{$value->id}}</td>
              <td>{{$value->position}}</td>
              <td><label class="label label-danger">Reject</label></td>
              <td><label class="label label-success">Manpower</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                </div>
              </td>
            </tr>
            @endif
          @endforeach
          @foreach ($capprsg as $datarnj)
            @php
              $valuernj=$datarnj->getmyrsg()->notapp()->first();
            @endphp
            @if (isset($valuernj))
            <tr>
            <td>{{$valuernj->id}}</td>
            @php
              $rnjp=$user_text::find($valuernj->code);
            @endphp
            <td>{{(isset($rnjp->posit))?$rnjp->posit:$valuernj->code}}</td>
            <td><label class="label label-danger">Reject</label></td>
            <td><label class="label label-danger">Resign</label></td>
            <td>
              <div class="btn-group">
              <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valuernj->id}}"><i class="fa fa-info-circle"></i></button>
              </div>
            </td>
            </tr>
            @endif
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
      <i class="fa fa-comments"></i> Reason
    @endslot
    @slot('selector','reasonm')
    @slot('footer',null)
    @slot('bodysec','bodycomment')
      <form action="" class="reasonfm" method="post">
        {{csrf_field()}}
      {{method_field('DELETE')}}
        <div class="row">
          <div class="col-xs-12">
            <input type="hidden" name="ratingval" class="hide">
            <div class="form-group">
              <label for="">Reason</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                <textarea class="form-control" name="reason" rows="5" placeholder="Insert Reason here" required></textarea>
              </div>
            </div>
          </div>
          <div class="col-xs-12 text-right">
            <div class="btn-group">
              <button type="reset" class="btn btn-default">
                <i class="fa fa-repeat"></i> Reset
              </button>
              <button type="submit" class="btn btn-success">
                <i class="fa fa-floppy-o"></i> Save
              </button>
            </div>
          </div>
        </div>
      </form>
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
        $.get('approveu/manpower/'+id).done(function(data) {
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
          location.reload(true);
        });
      });
      $('.table').on('click','.btn-desc-resign', function(event) {
        var id=$(this).attr('data-id');
        $.get('approveu/resign/'+id).done(function(data) {
          $('.bodydesc').html(data);
        }).fail(function() {
          console.error('Error Detail Load');
          location.reload(true);
        });
      });
      $('.table').on('click','.rej', function(event) {
        var id=$(this).attr('data-id');
        var type=$(this).attr('data-type');
        $('.reasonfm').attr('action', 'approveu/'+type+'/'+id);
        $('.reasonm').modal('show');
      });
    });
  </script>
@endsection
