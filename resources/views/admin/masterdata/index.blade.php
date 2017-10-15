@extends('template.admin.mainadmin')
@section('titlepage','Department')
@section('munu_act2','active')

@section('breadcrumb')
  <li class="active">Masterdata</li>
@endsection

@section('title_head')
  <i class="fa fa-folder"></i> Masterdata
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 col-lg-6">
      @component('template.component.boxcontent')
        @slot('boxtype','box-solid')
        @slot('title')
          <i class="fa fa-sitemap"></i> Department
        @endslot
        @slot('overlay')
          <div class="overlay dep-o"><i class="fa fa-spin fa-circle-o-notch"></i></div>
        @endslot
        <div class="table-responsive department">
        </div>
      @endcomponent
    </div>
    <div class="col-xs-12 col-lg-6">
      @component('template.component.boxcontent')
        @slot('boxtype','box-solid')
        @slot('title')
          <i class="fa fa-briefcase"></i> Position
        @endslot
        @slot('overlay')
          <div class="overlay pos-o"><i class="fa fa-spin fa-circle-o-notch"></i></div>
        @endslot
        <div class="table-responsive position"></div>
      @endcomponent
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-lg-6">
      @component('template.component.boxcontent')
        @slot('boxtype','box-solid')
        @slot('title')
          <i class="glyphicon glyphicon-education"></i> Education
        @endslot
        @slot('overlay')
          <div class="overlay edu-o"><i class="fa fa-spin fa-circle-o-notch"></i></div>
        @endslot
        <div class="table-responsive education">
        </div>
      @endcomponent
    </div>
    <div class="col-xs-12 col-lg-6">
      @component('template.component.boxcontent')
        @slot('boxtype','box-solid')
        @slot('title')
          <i class="glyphicon glyphicon-book"></i> Faculty
        @endslot
        @slot('overlay')
          <div class="overlay fac-o"><i class="fa fa-spin fa-circle-o-notch"></i></div>
        @endslot
        <div class="table-responsive faculty">
        </div>
      @endcomponent
    </div>
  </div>
  <!---------------------------------------------------------------------------------->
  <div class="modal fade adddep" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel"><i class="fa fa-plus-circle"></i> Add Department</h4>
        </div>
        <form class="adddepfm" method="post">
          {{csrf_field()}}
        <div class="modal-body">
          <div class="form-group has-feedback dep-gf">
            <label for="dep_name">Department</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
              <input type="text" id="dep_name" name="dep_name" class="form-control" placeholder="Please Insert Department" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default"><i class="fa fa-rotate-right"></i> Reset</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!---------------------------------------------------------------------------------->
  <div class="modal fade addpos" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalpos">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalpos"><i class="fa fa-plus-circle"></i> Add Position</h4>
        </div>
        <form class="addposfm" method="post">
          {{csrf_field()}}
        <div class="modal-body posfm">
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default"><i class="fa fa-rotate-right"></i> Reset</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!---------------------------------------------------------------------------------->
  <div class="modal fade addedu" tabindex="-1" role="dialog" aria-labelledby="gridSystemModaledu">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModaledu"><i class="fa fa-plus-circle"></i> Add Educaton</h4>
        </div>
        <form class="addedufm" method="post">
          {{csrf_field()}}
        <div class="modal-body edufm">
          <div class="form-group has-feedback edu-em">
            <label for="edu_name">Education</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
              <input type="text" class="form-control" name="edu_name" id="edu_name" placeholder="Please Insert Education" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default"><i class="fa fa-rotate-right"></i> Reset</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!---------------------------------------------------------------------------------->
  <div class="modal fade addfac" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalfac">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalfac"><i class="glyphicon glyphicon-book"></i> Add Faculty</h4>
        </div>
        <form class="addfacfm" method="post">
          {{csrf_field()}}
        <div class="modal-body facfm">
          <div class="form-group has-feedback fac-fm">
            <label for="fac_name">Faculty</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
              <input type="text" class="form-control" name="fac_name" id="fac_name" placeholder="Please Insert Faculty" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default"><i class="fa fa-rotate-right"></i> Reset</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(function() {
      function getDep() {
        $.get("{{route('department.index')}}").done(function(data) {
          $('.department').html(data);
          if (typeof tabledep!='undefined') {
            tabledep.destroy();
          }
          var tabledep=$('.table-dep').DataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                  text: "<i class='fa fa-plus-circle'></i> ADD",
                  action: function ( e, dt, node, config ) {
                      $('.adddep').modal('show');
                  }
              }
          ]
      });
          $('.dep-o').removeClass('overlay').children('*').remove();
        }).fail(function() {
          console.log("Error Get Department");
        });
      }

      function getPos() {
        $.get("{{route('position.index')}}").done(function(data) {
          $('.position').html(data);
          if (typeof tablepos!='undefined') {
            tablepos.destroy();
          }
          var tablepos=$('.table-pos').DataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                  text: "<i class='fa fa-plus-circle'></i> ADD",
                  action: function ( e, dt, node, config ) {
                      $('.addpos').modal('show');
                  }
              }
          ]
      });
          $('.pos-o').removeClass('overlay').children('*').remove();
        }).fail(function() {
          console.log("Error Get Position");
        });
      }
      function getEdu() {
        $.get("{{route('education.index')}}").done(function(data) {
          $('.education').html(data);
          if (typeof tableedu!='undefined') {
            tableedu.destroy();
          }
          var tableedu=$('.table-edu').DataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                  text: "<i class='fa fa-plus-circle'></i> ADD",
                  action: function ( e, dt, node, config ) {
                      $('.addedu').modal('show');
                  }
              }
          ]
      });
          $('.edu-o').removeClass('overlay').children('*').remove();
        }).fail(function() {
          console.log("Error Get Position");
        });
      }
      function getFac() {
        $.get("{{route('faculty.index')}}").done(function(data) {
          $('.faculty').html(data);
          if (typeof tablefac!='undefined') {
            tablefac.destroy();
          }
          var tablefac=$('.table-fac').DataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                  text: "<i class='fa fa-plus-circle'></i> ADD",
                  action: function ( e, dt, node, config ) {
                      $('.addfac').modal('show');
                  }
              }
          ]
      });
          $('.fac-o').removeClass('overlay').children('*').remove();
        }).fail(function() {
          console.log("Error Get Faculty");
        });
      }
      getDep();
      getPos();
      getEdu();
      getFac();
      /*-------------------------------------------------------------*/
      $('.adddepfm').on('submit', function(event) {
        event.preventDefault();
        if ($('input[name=dep_name]').val().length<1) {
          $('.dep-gf').addClass('has-error');
          $('input[name=dep_name]').focus();
        }else {
          $.post("{{route('department.store')}}", {_token: '{{csrf_token()}}',name:$('input[name=dep_name]').val()}).done(function(data) {
            $('.adddep').modal('hide');
            getDep();
            alertnotify('fa fa-check',data,'success');
            $('input[name=dep_name]').val('');
          }).fail(function(a,b) {
            console.log("Error Save Department");
          });
        }
      });
      $('.department').on('click','.del-dep', function(event) {
        event.preventDefault();
        var id=$(this).attr('data-id');
        $.post('masterdata/department/'+id,{_token:'{{csrf_token()}}',_method:'DELETE'}).done(function(data) {
          getDep();
          alertnotify('fa fa-trash-o',data,'success');
        }).fail(function() {
          console.log("Error Delete Department");
        });
      });
      /*-------------------------------------------------------------*/
      $('.addposfm').on('submit', function(event) {
        event.preventDefault();
        if ($('.posfm').find('select[name=dep_name]').val()==null) {
          $('.posfm').find('.pos-dm').addClass('has-error');
          $('.posfm').find('select[name=dep_name]').focus();
        }else if ($('.posfm').find('input[name=pos_name]').val().length<1) {
          $('.posfm').find('.pos-pn').addClass('has-error');
          $('.posfm').find('input[name=pos_name]').focus();
        }else if ($('.posfm').find('input[name=pos_gd]').val().length<1||parseInt($('.posfm').find('input[name=pos_gd]').val())==NaN) {
          $('.posfm').find('.pos-gd').addClass('has-error');
          $('.posfm').find('input[name=pos-gd]').focus();
        } else {
          $.post("{{route('position.store')}}",
          {_token: '{{csrf_token()}}',
          name:$('.posfm').find('input[name=pos_name]').val(),
          dep:$('.posfm').find('select[name=dep_name]').val(),
          grade:$('.posfm').find('input[name=pos_gd]').val()
        }).done(function(data) {
            $('.addpos').modal('hide');
            getPos();
            alertnotify('fa fa-check',data,'success');
          }).fail(function(a,b) {
            console.log("Error Save Position");
          });
        }
      });
      $('.position').on('click','.del-pos', function(event) {
        event.preventDefault();
        var id=$(this).attr('data-id');
        $.post('masterdata/position/'+id,{_token:'{{csrf_token()}}',_method:'DELETE'}).done(function(data) {
          getPos();
          alertnotify('fa fa-trash-o',data,'success');
        }).fail(function() {
          console.log("Error Delete Department");
        });
      });
      $('.addpos').on('show.bs.modal', function(event) {
        $.get('{{route('position.create')}}').done(function(data) {
          $('.posfm').html(data);
        }).fail(function() {
          console.log('Error Loading Form');
        });
      });
      /*----------------------------------------------------------*/
      $('.addedufm').on('submit', function(event) {
        event.preventDefault();
        if ($('input[name=edu_name]').val().length<1) {
          $('.edu-em').addClass('has-error');
          $('input[name=edu_name]').focus();
        } else {
          $.post("{{route('education.store')}}",
          {_token: '{{csrf_token()}}',
          name:$('input[name=edu_name]').val()
        }).done(function(data) {
            $('.addedu').modal('hide');
            getEdu();
            alertnotify('fa fa-check',data,'success');
            $('input[name=edu_name]').val('');
          }).fail(function(a,b) {
            console.log("Error Save Education");
          });
        }
      });
      $('.education').on('click','.del-edu', function(event) {
        event.preventDefault();
        var id=$(this).attr('data-id');
        $.post('masterdata/education/'+id,{_token:'{{csrf_token()}}',_method:'DELETE'}).done(function(data) {
          getEdu();
          alertnotify('fa fa-trash-o',data,'success');
        }).fail(function() {
          console.log("Error Delete Education");
        });
      });
      /*----------------------------------------------------------*/
      $('.addfacfm').on('submit', function(event) {
        event.preventDefault();
        if ($('input[name=fac_name]').val().length<1) {
          $('.fac-fm').addClass('has-error');
          $('input[name=fac_name]').focus();
        } else {
          $.post("{{route('faculty.store')}}",
          {_token: '{{csrf_token()}}',
          name:$('input[name=fac_name]').val()
        }).done(function(data) {
            $('.addfac').modal('hide');
            getFac();
            alertnotify('fa fa-check',data,'success');
            $('input[name=fac_name]').val('');
          }).fail(function(a,b) {
            console.log("Error Save Faculty");
          });
        }
      });
      $('.faculty').on('click','.del-fac', function(event) {
        event.preventDefault();
        var id=$(this).attr('data-id');
        $.post('masterdata/faculty/'+id,{_token:'{{csrf_token()}}',_method:'DELETE'}).done(function(data) {
          getFac();
          alertnotify('fa fa-trash-o',data,'success');
        }).fail(function() {
          console.log("Error Delete Faculty");
        });
      });
      /*----------------------------------------------------------*/
    });
  </script>
@endsection
