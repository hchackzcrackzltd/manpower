@extends('template.admin.mainadmin')
@section('titlepage','Authorize')
@section('munu_act2','active')

@section('title_head')
  <i class="fa fa-envelope"></i> Notification
@endsection

@section('breadcrumb')
  <li class="active">Notification</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-primary')
        @slot('title')
          <i class="fa fa-envelope"></i> E-Mail Group
        @endslot
        @slot('overlay',null)
          <form action="{{route('mailgroup.store')}}" method="post">
            {{csrf_field()}}
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="hr">Hr E-Mail</label>
                <input type="email" class="form-control" id="hr" name="hr" value="{{$data[0]->email}}" placeholder="Insert Hr E-Mail">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="mis">MIS E-Mail</label>
                <input type="email" class="form-control" id="mis" name="mis" value="{{$data[1]->email}}" placeholder="Insert MIS E-Mail">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="acc">Account E-Mail</label>
                <input type="email" class="form-control" id="acc" name="acc" value="{{$data[2]->email}}" placeholder="Insert Account E-Mail">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="ad">Administrator E-Mail</label>
                <input type="email" class="form-control" id="ad" name="ad" value="{{$data[3]->email}}" placeholder="Insert Administrator E-Mail">
              </div>
            </div>
            <div class="col-xs-12 text-right">
              <div class="btn-group">
                <button type="reset" class="btn btn-default"><i class="fa fa-repeat"></i> Reset</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
              </div>
            </div>
          </div>
          </form>
        @endcomponent
@endsection
