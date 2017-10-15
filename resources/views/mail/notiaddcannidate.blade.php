@inject('posit_txt','App\Model\Masterdata\position')
@component('template.mail.component.body')
  @slot('title_page','New Candidate')
  @slot('head','New Candidate')
  @component('template.mail.component.table')
      <tr>
        <td style="text-align:right" width='50%'>ชื่อ-นามสกุล: </td>
        <td style="text-align:left">{{$data->name_th}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Name: </td>
        <td style="text-align:left">{{$data->name_en}}</td>
      </tr>
      <td style="text-align:right" width='50%'>Position: </td>
      <td style="text-align:left">
        @foreach ($posit_txt::whereIn('id',[$data->position])->get() as $value)
          {{$value->name}},
        @endforeach
      </td>
    </tr>
  @endcomponent
  @component('template.mail.component.button')
    @slot('link')
      {{route('user_dashboard')}}
    @endslot
    @slot('title_link','Click to HR-Manpower')
  @endcomponent
@endcomponent
