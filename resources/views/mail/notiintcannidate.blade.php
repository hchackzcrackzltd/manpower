@inject('posit_txt','App\Model\Masterdata\position')
@inject('can','App\Model\Masterdata\cannidate')
@component('template.mail.component.body')
  @slot('title_page','Candidate Selected')
  @slot('head','Candidate Selected')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No.: </td>
      <td style="text-align:left">{{$data->manpower_id}}</td>
    </tr>
    @php
      $can_data=$can::find($data->cannidate_id)
    @endphp
      <tr>
        <td style="text-align:right" width='50%'>ชื่อ-นามสกุล: </td>
        <td style="text-align:left">{{$can_data->name_th}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Name: </td>
        <td style="text-align:left">{{$can_data->name_en}}</td>
      </tr>
      <td style="text-align:right" width='50%'>Position: </td>
      <td style="text-align:left">
        @foreach ($posit_txt::getallposition($can_data->position)->get() as $value)
          {{$value->name}},
        @endforeach
      </td>
    </tr>
  @endcomponent
  @component('template.mail.component.button')
    @slot('link')
      {{route('admin_dashboard')}}
    @endslot
    @slot('title_link','Click to HR-Manpower')
  @endcomponent
@endcomponent
