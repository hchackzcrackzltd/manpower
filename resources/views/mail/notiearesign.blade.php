@inject('txt_name','App\Model\Masterdata\employee')
@inject('time','Carbon\Carbon')

@component('template.mail.component.body')
  @slot('title_page','Resign Request')
  @slot('head','Resign Request')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No: </td>
      <td style="text-align:left">{{$data->id}}</td>
    </tr>
    @php
      $usda=$txt_name::find($data->code);
    @endphp
      <tr>
        <td style="text-align:right" width='50%'>Name: </td>
        <td style="text-align:left">{{$usda->fname_en}} {{$usda->lname_en}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Code: </td>
        <td style="text-align:left">{{$data->code}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Effecive: </td>
        <td style="text-align:left">{{$time::parse($data->effect_date)->format('d M Y')}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Close Request: </td>
        <td style="text-align:left">{{$time::parse($data->time_end)->format('d M Y')}}</td>
      </tr>
  @endcomponent
  <p>Please Evaluate Request This Button Below.</p>
  @component('template.mail.component.button')
    @slot('link')
      {{route('evaluate.showrsg',['evaluate'=>$data->id])}}
    @endslot
    @slot('title_link','Click to HR-Manpower')
  @endcomponent
@endcomponent
