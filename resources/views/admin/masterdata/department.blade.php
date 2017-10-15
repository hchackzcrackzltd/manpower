    <table class="table table-condensed table-striped table-hover text-center table-dep">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th class="text-center">Department</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      @php
        $no=1;
      @endphp
      <tbody>
        @foreach ($data as $value)
          <tr>
            <td>{{$no++}}</td><td>{{$value->name}}</td>
            <td><button type="button" name="button" class="btn btn-danger del-dep" title="Delete" data-id='{{$value->id}}'><i class="fa fa-trash-o"></i></button></td>
          </tr>
        @endforeach
      </tbody>
    </table>
