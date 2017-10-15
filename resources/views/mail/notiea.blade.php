@inject('txt_name','App\Model\Masterdata\employee')
@inject('time','Carbon\Carbon')

@component('template.mail.component.body')
  @slot('title_page','Evaluate Request')
  @slot('head','Detail')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No: </td>
      <td style="text-align:left">{{$data->id}}</td>
    </tr>
    @foreach ($data->getemp()->get() as $key => $value)
      <tr>
        <td style="text-align:right" width='50%'>{{$key+1}}.Name: </td>
        <td style="text-align:left">{{$value->name_en}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Code: </td>
        <td style="text-align:left">{{$value->code}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Start work date: </td>
        <td style="text-align:left">{{$time::parse($value->date_work)->format('d M Y')}}</td>
      </tr>
    @endforeach
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
      {{route("manpower.show",["manpower"=>$data->id])}}
    @endslot
    @slot('title_link','Click to HR-Manpower')
  @endcomponent
@endcomponent
