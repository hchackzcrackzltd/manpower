<form action="{{route('admin_dashboard.getassign',['dashboard'=>$id])}}" method="post">
  {{csrf_field()}}
  {{method_field('PUT')}}
<div class="row">
  <div class="col-xs-12">
      <div class="form-group">
        <label for="empas">Assign To</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="ion-android-person"></i></span>
          <select class="form-control" name="useras" required>
            @forelse ($data as $value)
              <option value="{{$value->code}}">{{$value->fname_en}} {{$value->lname_en}}</option>
            @empty
              <option disabled>No User</option>
            @endforelse
          </select>
        </div>
      </div>
  </div>
  <div class="col-xs-12 text-right">
    <div class="btn-group">
      <button type="submit" class="btn btn-success" title="Send Request" data-toggle="tooltip"><i class="fa fa-paper-plane"></i> Send</button>
    </div>
  </div>
</div>
</form>
