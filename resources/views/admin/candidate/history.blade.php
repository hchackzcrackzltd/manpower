@inject('posit','App\Model\Masterdata\position')
@extends('template.admin.mainadmin')
@section('titlepage','History')
@section('munu_act4','active')

@section('title_head')
  <i class="fa fa-history"></i> History
@endsection

@section('breadcrumb')
  <li>Candidate</li>
  <li class="active">History</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      @component('template.component.boxcontent')
        @slot('boxtype','box-default')
        @slot('title')
          <i class="fa fa-list"></i> List of history candidate
        @endslot
        @slot('overlay',null)
          @php
            $no=1;
          @endphp
          <div class="row">
            <div class="col-xs-12">
              <div class="table-responsive">
                <table class="table table-condensed table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">ชื่อ-นามสกุล</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Department - Position</th>
                      <th class="text-center">Interest</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $value)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{$value->name_th}}</td>
                      <td>{{$value->name_en}}</td>
                      <td>
                        @foreach (explode(',',$value->position) as $valuepo)
                          {{$posit::find($valuepo)->department()->first()->name}} - {{$posit::find($valuepo)->name}}<br>
                        @endforeach
                      </td>
                      <td><span class="badge">{{$value->interest}}</span></td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-info desc" title="Detail" data-toggle="modal" data-target=".detail" data-id="{{$value->id}}">
                            <i class="fa fa-info-circle"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      @endcomponent
    </div>
  </div>
@endsection
@component('template.component.model')
  @slot('title')
    <i class="fa fa-file-text-o"></i> Detail Cannidate
  @endslot
  @slot('selector','detail')
  @slot('footer',null)
  @slot('bodysec','bodydesc')
@endcomponent

@section('script')
  <script>
  $(function(){
    $('.table').DataTable();
    $('.table').on('click','.desc', function(event) {
      var id=$(this).attr('data-id');
      var table,selec,cp;
      $.get('../cannidate/detail/'+id).done(function(data) {
        $('.bodydesc').html(data);
        if (typeof table!=='undefined') {
          table.destroy();
        }
        if (typeof selec!=='undefined') {
          selec.select2("destroy");
        }
        if (typeof cp!=='undefined') {
          cp.destroy();
        }
        table=$('.table').DataTable();
        selec=$('.se2').select2({width:'100%'});
        cp=new Clipboard('.btncp');
      }).fail(function() {
        console.log('Load Detail Error');
      });
    });
  });
  </script>
@endsection
