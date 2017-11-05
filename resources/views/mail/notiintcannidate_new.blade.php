@component('template.mail.component.body')
  @slot('title_page','Candidate Selected')
  @slot('head','Candidate Selected')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No.: </td>
      <td style="text-align:left">{{$data->getmanpower->docfm}}</td>
    </tr>
    <tr>
      <td style="text-align:right" width='50%'>Requester: </td>
      <td style="text-align:left">{{auth()->user()->name}}</td>
    </tr>
      <tr>
        <td style="text-align:right" width='50%'>ชื่อ-นามสกุล: </td>
        <td style="text-align:left">{{$data->getcandidate->name}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Name: </td>
        <td style="text-align:left">{{$data->getcandidate->nameeng}}</td>
      </tr>
      <td style="text-align:right" width='50%'>Position Interview: </td>
      <td style="text-align:left">
        {{$data->getmanpower->position}}
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
