@extends('template.admin.mainadmin')
@section('titlepage','Edit Candidate')
@section('munu_act4','active')

@section('title_head')
  <i class="fa fa-user-plus"></i> Candidate
@endsection

@section('breadcrumb')
  <li>Candidate</li>
  <li><a href="{{route('cannidate.index')}}"><i class="fa fa-user"></i> List Candidate</a></li>
  <li class="active">Edit Candidate</li>
@endsection

@section('content')
  @component('template.component.boxcontent')
    @slot('boxtype','box-info')
    @slot('title')
      <i class="fa fa-pencil"></i> Edit Candidate
    @endslot
    @slot('overlay',null)
      <form class="fmc" action="{{route('cannidate.update',['cannidate'=>$data->id])}}" method="post" enctype="multipart/form-data" id="fmup">
        {{csrf_field()}}
        {{method_field('PATCH')}}
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="name_th">ชื่อ-นามสกุล</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-male"></i></span>
              <input type="text" class="form-control" id="name_th" name="name_th" value="{{$data->name_th}}" placeholder="กรุณาระบุ ชื่อ-นามสกุล" form="fmup" required>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="name_en">Name-Lastname</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-male"></i></span>
              <input type="text" class="form-control" id="name_en" name="name_en" value="{{$data->name_en}}" placeholder="Please Spacify Name-Lastname" form="fmup" required>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="position">Position</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
              @php
                $pos=collect(explode(',',$data->position));
              @endphp
              <select class="form-control" name="position[]" id="position" form="fmup" multiple required>
                @forelse ($datap as $value)
                  <option value="{{$value->id}}" {{($pos->search($value->id)>-1)?'selected':null}}>{{$value->department()->first()->name}} - {{$value->name}}</option>
                @empty
                  <option selected disabled>No Position</option>
                @endforelse
              </select>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group fileupload">
              <label for="fileat">File Resume</label>
              <div class="input-group fef">
                <span class="input-group-addon"><i class="fa fa-upload"></i></span>
                <input type="file" class="form-control" id="fileat" name="fileat[]" placeholder="Please Insert Resume File" form="fmup" required>
                <span class="input-group-btn"><button type="button" class="btn btn-success addfm" title="Add more file"><i class="fa fa-plus"></i></button></span>
              </div>
              <div class="help-block">
                <label class="label label-info">Support Files:</label>&nbsp;&nbsp;
                <label class="label label-danger"><i class="fa fa-file-pdf-o"></i> PDF</label>&nbsp;&nbsp;
                <label class="label label-primary"><i class="fa fa-file-word-o"></i> Word</label>
              </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6">
          <div class="table-responsive">
            <table class="table table-condensed table-striped text-center">
              <thead>
                <tr class="bg-primary">
                  <th class="text-center">FileName</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($files as $value)
                  <tr>
                    <td><a href="{{route('cannidate.show',['cannidate'=>$value->id])}}" target="_blank">{{$value->name}}</a></td>
                    <td>
                        <button type="submit" class="btn btn-danger delfile" data-id="{{$value->id}}" title="Delete This File" form="delfile">
                          <i class="fa fa-trash-o"></i>
                        </button>
                  </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-xs-12 text-right">
          <div class="btn-group">
            <button type="reset" class="btn btn-default" form="fmup">
              <i class="fa fa-repeat"></i> Reset
            </button>
            <button type="submit" class="btn btn-success" form="fmup">
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
      $('.table').DataTable();
      $('select').select2({
        placeholder:'Please Select Position',
        allowClear: true
      });
      $('.addfm').on('click', function(event) {
        $('.fef').before("\
        <div class='input-group fad'>\
          <span class='input-group-addon'><i class='fa fa-upload'></i></span>\
          <input type='file' class='form-control' id='fileat' name='fileat[]' placeholder='Please Insert Resume File' form='fmup' required>\
          <span class='input-group-btn'><button type='button' class='btn btn-danger delfm' title='Delete this file'><i class='fa fa-times'></i></button></span>\
        </div>");
      });
      $('.fileupload').on('click', '.delfm', function(event) {
        $(this).parents('.fad').remove();
      });
      $('.fmc').on('reset', function(event) {
        $('.fileupload').find('.fad').remove();
      });

      $('.fileupload').on('change','input[type=file]', function(event) {
        if (event.currentTarget.files[0].type!=="application/pdf"&&event.currentTarget.files[0].type!=="application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
          alertnotify('fa fa-ban',"Not Support This File",'error');
          $(this).val('');
        }
      });

      $('.delfile').on('click', function(event) {
        var id=$(this).attr('data-id');
        $.post('../file/'+id,{_method:'DELETE',_token:'{{csrf_token()}}'}).done(function() {
          alertnotify('fa fa-trash-o',"File has been delete",'success');
          location.reload();
        }).fail(function() {
          console.log("Delete File Error");
        });
      });
    });
  </script>
@endsection
