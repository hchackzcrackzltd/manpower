@inject('user_text','App\Model\Masterdata\employee')
@inject('time','Carbon\Carbon')
@extends('template.mainuser')

@section('titlepage','Request Status')

@section('title')
<i class="fa fa-dashboard"></i> Request Status
@endsection

@section('subtitle',null)

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
              <th>Status</th>
              <th>Type</th>
              <th>Menu</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($nj as $value)
              <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->position}}</td>
                <td><label class="label {{($value->status==='NP')?'label-default':'label-warning'}} ">
                  {{($value->approve==0)?'Wait for approve':$value->status_text}}
                </label></td>
                <td><label class="label label-success">Manpower</label></td>
                <td>
                  <form action="{{route('manpowerreq.destroy',['manpowerreq'=>$value->id])}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                  <div class="btn-group">
                  <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                @if($value->status==='NP')
                  <a class="btn btn-warning" data-toggle="tooltip" title="Edit" href="{{route('manpowerreq.edit',['manpowerreq'=>$value->id])}}"><i class="fa fa-pencil"></i></a>
                  <button type="submit" class="btn btn-danger" title="Cancle" data-toggle="tooltip"><i class="fa fa-ban"></i></button>
                @endif
                  </div>
                  </form>
                </td>
              </tr>
            @endforeach
            @foreach ($rnj as $valuernj)
              <tr>
              <td>{{$valuernj->id}}</td>
              @php
                $rnjp=$user_text::find($valuernj->code);
              @endphp
              <td>{{(isset($rnjp->posit))?$rnjp->posit:$valuernj->code}}</td>
              <td><label class="label {{($valuernj->status==='NP')?'label-default':'label-warning'}} ">
                  {{($valuernj->approve==0)?'Wait for approve':$valuernj->status_text}}
              </label></td>
              <td><label class="label label-danger">Resign</label></td>
              <td>
                <form action="{{route('resignreq.destroy',['resignreq'=>$valuernj->id])}}" method="post">
                  {{csrf_field()}}
                  {{method_field('DELETE')}}
                <div class="btn-group">

                <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valuernj->id}}"><i class="fa fa-info-circle"></i></button>
              @if($valuernj->status==='NP')
                <a class="btn btn-warning" data-toggle="tooltip" title="Edit" href="{{route('resignreq.edit',['resignreq'=>$valuernj->id])}}"><i class="fa fa-pencil"></i></a>
                <button type="submit" class="btn btn-danger" title="Cancle" data-toggle="tooltip"><i class="fa fa-ban"></i></button>
              @endif
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
                  <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>                </div>
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
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-danger')
        @slot('title')
          <i class="fa fa-ban"></i> Cancel Request
        @endslot
        @slot('overlay','')
        <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>Req No.</th>
              <th>Position</th>
              <th>Type</th>
              <th>Menu</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cn as $value)
            <tr>
              <td>{{$value->id}}</td>
              <td>{{$value->position}}</td>
              <td><label class="label label-success">Manpower</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$value->id}}"><i class="fa fa-info-circle"></i></button>
                <a href="{{route('manpowerreq.show',['manpowerreq'=>$value->id])}}" class="btn bg-purple" title="Reopen Request" data-toggle="tooltip"><i class="fa fa-repeat"></i></a>
                </div>
              </td>
            </tr>
            @endforeach
            @foreach ($rcn as $valuercn)
              <tr>
              <td>{{$valuercn->id}}</td>
              @php
                $rjcp=$user_text::find($valuercn->code);
              @endphp
              <td>{{(isset($rjcp->posit))?$rjcp->posit:$valuercn->code}}</td>
              <td><label class="label label-danger">Resign</label></td>
              <td>
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-desc-resign" data-toggle="modal" data-target='.detail' title="Detail" data-id="{{$valuercn->id}}"><i class="fa fa-info-circle"></i></button>
                <a href="{{route('resignreq.showcn',['resignreq'=>$valuercn->id])}}" class="btn bg-purple" title="Reopen Request" data-toggle="tooltip"><i class="fa fa-repeat"></i></a>
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
      <i class="fa fa-comments"></i> Comment
    @endslot
    @slot('selector','comment')
    @slot('footer',null)
    @slot('bodysec','bodycomment')
      <form action="" class="ratfm" method="post">
        {{csrf_field()}}
        <div class="row">
          <div class="col-xs-12">
            <input type="hidden" name="ratingval" class="hide">
            <div class="form-group">
              <label for="">Comment</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                <textarea class="form-control" name="comment" rows="5" placeholder="Insert comment here"></textarea>
              </div>
            </div>
          </div>
          <div class="col-xs-12 text-right">
            <div class="btn-group">
              <button type="reset" class="btn btn-default">
                <i class="fa fa-repeat"></i> Reset
              </button>
              <button type="submit" class="btn btn-success">
                <i class="fa fa-paper-plane"></i> Send
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
        $.get('user/dashboard/detail/'+id).done(function(data) {
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
        $.get('user/resignreq/detail/'+id).done(function(data) {
          $('.bodydesc').html(data);
        }).fail(function() {
          console.error('Error Detail Load');
          location.reload(true);
        });
      });
      $('.fixe').on('click', function(event) {
        alert('asd');
      });
      $('.ratting').barrating({
        theme: 'fontawesome-stars',
        onSelect:function(value, text, event) {
          $('input[name=ratingval]').val(value);
          $('.ratfm').attr('action', 'user/manpowerreq/rating/'+$(event.target).parents('.br-widget').prev().attr('data-id'));
          $('.comment').modal('show');
        }
      });
      $('.rattingr').barrating({
        theme: 'fontawesome-stars',
        onSelect:function(value, text, event) {
          $('input[name=ratingval]').val(value);
          $('.ratfm').attr('action', 'user/resignreq/rating/'+$(event.target).parents('.br-widget').prev().attr('data-id'));
          $('.comment').modal('show');
        }
      });
      /*-----Approve-----*/
      $('.aprv').on('click', function(event) {
        var type=$(this).attr('data-type');
        var app=$(this).attr('data-id');
        $.post('user/approveu/'+type+'/'+app, {'_method':'PATCH','_token':'{{csrf_token()}}'}).done(function(data) {
          alertnotify('fa fa-check','Data Saved','success');
          location.reload(true);
        }).fail(function() {
          console.error('Error Approve');
        });
      });
      $('.rejt').on('click', function(event) {
        var type=$(this).attr('data-type');
        var app=$(this).attr('data-id');
        $.post('user/approveu/'+type+'/'+app, {_method:'DELETE',_token:'{{csrf_token()}}'}).done(function(data) {
          alertnotify('fa fa-check','Data Saved','success');
          location.reload(true);
        }).fail(function() {
          location.reload(true);
          console.error('Error Approve');
        });
      });
    });
  </script>
@endsection
