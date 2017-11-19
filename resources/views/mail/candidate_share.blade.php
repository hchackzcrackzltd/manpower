@component('template.mail.component.body')
  @slot('title_page',auth()->user()->name.' Recommend Candidate For '.$touser)
  @slot('head','Recommend Candidate')
  <h3>{{auth()->user()->name}} Recommend Candidate For {{$touser}}</h3>
  <b>Please Click This Link Below</b>
  @component('template.mail.component.button')
    @slot('link',$link)
    @slot('title_link','Please Click This Link To View Resume')
  @endcomponent
@endcomponent
