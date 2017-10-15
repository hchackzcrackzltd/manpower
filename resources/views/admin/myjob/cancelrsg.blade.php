<form action="{{route('myjob.deletersg',['myjob'=>$data->id])}}" method="post">
  {{csrf_field()}}
  {{method_field('DELETE')}}
  <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
        <label for="">Remark</label>
        <textarea class="form-control" name="remark" rows="5" placeholder="Insert Remark Here"></textarea>
      </div>
    </div>
    <div class="col-xs-12 text-right">
      <div class="btn-group btn-group-sm">
        <button type="reset" class="btn btn-default" data-toggle="tooltip" title="Reset Form">
          <i class="fa fa-repeat"></i> Reset</button>
        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Close Request">
          <i class="fa fa-paper-plane"></i> Send</button>
      </div>
    </div>
  </div>
</form>
