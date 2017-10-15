<table class="table table-condensed table-striped table-hover text-center table-fac">
  <thead>
    <tr>
      <th class="text-center">No.</th>
      <th class="text-center">Faculty</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  @php
    $no=1;
  @endphp
  <tbody>
    @foreach ($data as $value)
      <tr>
        <td>{{$no++}}</td>
        <td>{{$value->name}}</td>
        <td><button type="button" name="button" class="btn btn-danger del-fac" title="Delete" data-id='{{$value->id}}'><i class="fa fa-trash-o"></i></button></td>
      </tr>
    @endforeach
  </tbody>
</table>
