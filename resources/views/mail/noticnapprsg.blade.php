@inject('txt_name','App\Model\Masterdata\employee')
@inject('time','Carbon\Carbon')

@component('template.mail.component.body')
  @slot('title_page','Reject Resign Request')
  @slot('head','Reject Resign Request')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No: </td>
      <td style="text-align:left">{{$data->id}}</td>
    </tr>
      <tr>
        <td style="text-align:right" width='50%'>Requestor: </td>
        @php
          $name=$data->getnamereq()->first();
        @endphp
        <td style="text-align:left">{{$name->fname_en}} {{$name->lname_en}}</td>
      </tr>
      <tr>
        <td style="text-align:right" width='50%'>Name: </td>
        @php
          $nameu=$data->getnameemprsg()->first();
        @endphp
        <td style="text-align:left">{{$nameu->fname_en}} {{$nameu->lname_en}}</td>
      </tr>
    <tr>
      <td style="text-align:right" width='50%'>Position: </td>
      <td style="text-align:left">{{$data->getnameemprsg()->first()->posit}}</td>
    </tr>
  @endcomponent
  @component('template.mail.component.button')
    @slot('link')
      {{route("user_dashboard")}}
    @endslot
    @slot('title_link','Click to HR-Manpower')
  @endcomponent
@endcomponent
