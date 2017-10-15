<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="form-group">
      <label for="name_th">ชื่อ-นามสกุล</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-male"></i></span>
        <input type="text" class="form-control" id="name_th" name="name_th" value="{{$data->name_th}}" placeholder="กรุณาระบุ ชื่อ-นามสกุล" readonly>
        <div class="input-group-btn"><button type="button" class="btn btn-primary btncp" data-clipboard-target="#name_th">
          Copy
        </button></div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6">
    <div class="form-group">
      <label for="name_en">Name-Lastname</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-male"></i></span>
        <input type="text" class="form-control" id="name_en" name="name_en" value="{{$data->name_en}}" placeholder="Please Spacify Name-Lastname" readonly>
        <div class="input-group-btn"><button type="button" class="btn btn-primary btncp" data-clipboard-target="#name_en">
          Copy
        </button></div>
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
        <select class="form-control se2" name="position[]" id="position" form="fmup" multiple disabled>
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
    <div class="table-responsive">
      <table class="table table-condensed table-striped text-center">
        <thead>
          <tr class="bg-primary">
            <th class="text-center">FileName</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($files as $value)
            <tr>
              <td><a href="{{route('cannidate.show',['cannidate'=>$value->id])}}" target="_blank">{{$value->name}}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
