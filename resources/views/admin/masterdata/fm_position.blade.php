<div class="row">
  <div class="col-xs-12">
    <div class="form-group has-feedback pos-dm">
      <label for="pos_deps">Department</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
        <select class="form-control" name="dep_name" required>
          <option selected disabled>Select Department</option>
          @forelse ($data as $value)
            <option value="{{$value->id}}">{{$value->name}}</option>
          @empty
            <option disabled>No Department</option>
          @endforelse
        </select>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-9">
    <div class="form-group has-feedback pos-pn">
      <label for="pos_name">Position</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
        <input type="text" id="pos_name" name="pos_name" class="form-control" placeholder="Please Insert Position" required>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-3">
    <div class="form-group has-feedback pos-gd">
      <label for="pos_gd">Grade</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-level-up"></i></span>
        <input type="number" id="pos_gd" min="0" name="pos_gd" class="form-control" placeholder="Grade" required>
      </div>
    </div>
  </div>
</div>
