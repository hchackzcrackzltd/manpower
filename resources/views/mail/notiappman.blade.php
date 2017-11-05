@inject('txt_name','App\Model\Masterdata\employee')
@inject('time','Carbon\Carbon')

@component('template.mail.component.body')
  @slot('title_page','Approve Request Manpower')
  @slot('head','Approve Request Manpower')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No: </td>
      <td style="text-align:left">{{$data->docfm}}</td>
    </tr>
      <tr>
        <td style="text-align:right" width='50%'>Requestor: </td>
        @php
          $name=$data->getnamereq()->first();
        @endphp
        <td style="text-align:left">{{$name->fname_en}} {{$name->lname_en}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Position: </td>
        <td style="text-align:left">{{$data->position}}</td>
      </tr>
    <tr>
      <td style="text-align:right" width='50%'>Total amount: </td>
      <td style="text-align:left">{{$data->count}}</td>
    </tr>
  @endcomponent
  <p>Please Approve/Reject Request This Button Below.</p>
  @component('template.mail.component.button')
    @slot('link')
      {{route("approveu.manpage",["id"=>$data->id])}}
    @endslot
    @slot('title_link','Click to HR-Manpower')
  @endcomponent
@endcomponent
