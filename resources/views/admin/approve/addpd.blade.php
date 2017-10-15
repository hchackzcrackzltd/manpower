<form class="savepd" action="{{route('approve.store')}}" method="post">
  {{csrf_field()}}
  <input type="hidden" class="hide" name="function_id" value="{{$func_id}}" readonly>
<div class="row">
  <div class="col-xs-12">
    <div class="form-group has-feedback pt">
      <label for="">Division</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
        <select class="form-control" name="party" required>
          @foreach ($data as $value)
            <option value="{{$value->code}}">{{$value->name_th}} {{$value->name_en}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="form-group has-feedback dp">
      <label for="">Department</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
        <select class="form-control" name="department" required>
          <option selected disabled>Please Select Party</option>
        </select>
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
