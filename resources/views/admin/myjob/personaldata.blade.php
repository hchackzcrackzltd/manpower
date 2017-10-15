<form id="uptfm" action="{{route('myjob.update',['myjob'=>$data->id])}}" method="post">
  {{method_field('PUT')}}
  {{csrf_field()}}
  <div class="row">
    @for ($i=1; $i <= $data->count; $i++)
    <div class="col-xs-12 col-md-6">
      <div class="form-group tfname">
        <label for="tfname">{{$i}}.ชื่อ</label>
        <input type="text" class="form-control uptfm" id="tfname" name="tfname[]" placeholder="ชื่อ" required>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group tlname">
        <label for="tlname">นามสกุล</label>
        <input type="text" class="form-control uptfm" id="tlname" name="tlname[]" placeholder="นามสกุล" required>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group fname">
        <label for="fname">First name</label>
        <input type="text" class="form-control uptfm" id="fname" name="fname[]" placeholder="First name" required>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group lname">
        <label for="lname">Last name</label>
        <input type="text" class="form-control uptfm" id="lname" name="lname[]" placeholder="Last name" required>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label for="code">Code</label>
        <input type="text" class="form-control" id="code" name="code[]" placeholder="Code Employee" required>
      </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label for="sjdate">Start Job Date</label>
        <div class='input-group date'>
        <input type="text" class="form-control uptfm sjdate" id="sjdate" name="sjdate[]" placeholder="Start Job Date" readonly required>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
    <hr>
    </div>
    @endfor
    <div class="col-xs-12">
      <div class="form-group remark">
        <label for="remark">Remark</label>
        <textarea class="form-control uptfm" name="remark" rows="5" name="remark" placeholder="Remark"></textarea>
      </div>
    </div>
    <div class="col-xs-6 pull-right text-right">
      <div class="btn-group">
        <button type="reset" type="reset" class="btn btn-default">
          <i class="fa fa-repeat"></i> Reset
        </button>
        <button type="submit" data-toggle="tooltip" title="Close Request" class="btn btn-success">
          <i class="fa fa-paper-plane"></i> Send
        </button>
      </div>
    </div>
  </div>
</form>
