@inject('txt_name','App\Model\Masterdata\employee')
@inject('time','Carbon\Carbon')

@component('template.mail.component.body')
  @slot('title_page','Computer Request')
  @slot('head','New Employee Request')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No: </td>
      <td style="text-align:left">{{$data->docfm}}</td>
    </tr>
    <tr>
      <td style="text-align:right" width='50%'>Requestor: </td>
      @php
      $name=$txt_name::find($data->user_id)
      @endphp
      <td style="text-align:left">{{(isset($name))?$name->fname_en.' '.$name->lname_en:$data->user_id}}</td>
    </tr>
    <tr>
      <td style="text-align:right" width='50%'>Position: </td>
      <td style="text-align:left">{{$data->position}}</td>
    </tr>
    <tr>
      <td style="text-align:right" width='50%'>Total amount: </td>
      <td style="text-align:left">{{$data->count}}</td>
    </tr>
    <tr>
      <td style="text-align:right" width='50%'>Computer: </td>
      <td style="text-align:left">{{$data->item_desc}}</td>
    </tr>
  @endcomponent
@endcomponent
