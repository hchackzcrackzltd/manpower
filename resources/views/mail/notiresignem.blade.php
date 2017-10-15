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
        <td style="text-align:right" width='50%'>ชื่อ-นามสกุล: </td>
        <td style="text-align:left">{{$usda->fname_th}} {{$usda->lname_th}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Name: </td>
        <td style="text-align:left">{{$usda->fname_en}} {{$usda->lname_en}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Code: </td>
        <td style="text-align:left">{{$data->code}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Last working date: </td>
        <td style="text-align:left">{{$time::parse($data->last_date)->format('d M Y')}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Effective Date: </td>
        <td style="text-align:left">{{$time::parse($data->effect_date)->format('d M Y')}}</td>
      </tr>
  @endcomponent
@endcomponent
