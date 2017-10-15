@inject('txt_name','App\Model\Masterdata\employee')
@inject('offac','App\Model\Masterdata\offac')
@inject('time','Carbon\Carbon')

@component('template.mail.component.body')
  @slot('title_page','Office Stationary Request')
  @slot('head','New Employee Request')
  @component('template.mail.component.table')
    <tr>
      <td style="text-align:right" width='50%'>No: </td>
      <td style="text-align:left">{{$data->id}}</td>
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
    @if ($data->nmc)
    <tr>
      <td style="text-align:right" width='50%'>Office Equipment: </td>
      <td style="text-align:left">
          <ul>
            @foreach ($offac::getname(explode(',',$data->nmc))->get() as $value)
              <li>{{ucfirst($value->itemdesc)}}</li>
            @endforeach
          </ul>
      </td>
    </tr>
    @endif
    @if ($data->ofa)
      <tr>
        <td style="text-align:right" width='50%'>Other: </td>
        <td style="text-align:left">{{$data->ofa}}</td>
      </tr>
    @endif
  @endcomponent
@endcomponent