@inject('txt_name','App\Model\Masterdata\employee')
@inject('time','Carbon\Carbon')

@component('template.mail.component.body')
  @slot('title_page','Fleet Card Request')
  @slot('head','New Employee Request')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No: </td>
      <td style="text-align:left">{{$data->docfm}}</td>
    </tr>
    @foreach ($data->getemp()->get() as $key => $value)
      <tr>
        <td style="text-align:right" width='50%'>{{$key+1}}.ชื่อ-นามสกุล: </td>
        <td style="text-align:left">{{$value->name_th}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Name: </td>
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
      <td style="text-align:right" width='50%'>Position: </td>
      <td style="text-align:left">{{$data->position}}</td>
    </tr>
    <tr>
      <td style="text-align:right" width='50%'>Total amount: </td>
      <td style="text-align:left">{{$data->count}}</td>
    </tr>
    <tr>
      <td style="text-align:right" width='50%'>Fleet Card: </td>
      <td style="text-align:left">Use</td>
    </tr>
  @endcomponent
@endcomponent
