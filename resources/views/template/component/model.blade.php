<div class="modal fade {{$selector}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{$title}}</h4>
      </div>
      <div class="modal-body {{$bodysec}}">
        {{$slot}}
      </div>
      <div class="modal-footer">
        {{$footer}}
      </div>
    </div>
  </div>
</div>
