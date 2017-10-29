@extends('template.mainuser')

@inject('carbon', 'Carbon\Carbon')

@section('titlepage','Resume')

@section('title')
<i class="fa fa-users"></i> Resume
@endsection

@section('breadcrumb')
  <li><a href="{{route('candidatesh.index')}}"><i class="fa fa-users"></i> Candidate</a></li>
  <li class="active"><i class="fa fa-file-text-o"></i> Resume</li>
@endsection

@section('subtitle',null)

@section('content')
  @component('template.component.boxcontent')
    @slot('boxtype','box-info')
    @slot('title')
      <i class="fa fa-file-text-o"></i> Resume
    @endslot
    @slot('overlay','')
  <div class="row">
    <div class="col-xs-6">
      @if ($data->getfile->where('type', 2)->first())
        <img src="{{asset('img/No_image_available.png')}}" alt="Picture Profile" class="img-circle col-xs-5"><br><br>
      @else
        <img src="{{asset('img/No_image_available.png')}}" class="img-circle col-xs-5" alt="Picture">
      @endif
      <div class="col-xs-7 clearfix">
        <p class="h3">{{(!empty($data->titlename))?'ไม่ระบุ':$master_titlename[$data->titlename]}}{{(empty($data->name))?'ไม่ระบุ':$data->name}}</p>
        <p class="h4">{{(!empty($data->titlename))?'ไม่ระบุ':$master_titlenameeng[$data->titlename]}}{{(empty($data->nameeng))?'ไม่ระบุ':ucfirst($data->nameeng)}}</p>
        <p><b>อายุ (Age):</b> {{(empty($data->birthdate))?'ไม่ระบุ':($carbon::now()->year)-($carbon::parse($data->birthdate)->year)}}</p>
      </div>
    </div>
    <div class="col-xs-6 text-right">
      <p>{{(empty($data->email))?'ไม่ระบุ':$data->email}} <i class="fa fa-envelope"></i></p>
      <p>{{(empty($data->mobile))?'ไม่ระบุ':$data->mobile}} <i class="fa fa-mobile-phone"></i></p>
      <p>{{(empty($data->telephone))?'ไม่ระบุ':$data->telephone}} <i class="fa fa-phone"></i></p>
    </div>
    <div class="col-xs-12 text-justify"><br>
      <p>{{$data->intf}}</p>
    </div>
    <div class="col-xs-6">
      <div class="col-xs-12 clearfix">
        <p class="h4">ข้อมูลส่วนตัว</p>
        <p class="h4">Personal Information</p>
        <hr>
        <div class="col-xs-12 clearfix">
          <p><b>น้ำหนัก (Weight):</b> {{(empty($data->weight))?'ไม่ระบุ':$data->weight}} <b>ส่วนสูง (Height):</b> {{(empty($data->height))?'ไม่ระบุ':$data->height}}</p>
        </div>
        <div class="col-xs-12 clearfix">
          <b>ที่อยู่ตามทะเบียนบ้าน (Registered Address)</b>
          <p>{{(empty($data->address_mas))?'ไม่ระบุ':$data->address_mas}}</p>
          <b>ที่อยู่ปัจจุบัน (Present Address)</b>
          <p>{{(empty($data->address))?'ไม่ระบุ':$data->address}}</p>
        </div>
        <div class="col-xs-12 col-md-6 clearfix">
          <b>เกิดที่จังหวัด (Place of birth)</b>
          <p>{{(empty($data->provb_id))?'ไม่ระบุ':$ref_provin->where('id',$data->provb_id)->first()->name}}</p>
        </div>
        <div class="col-xs-12 col-md-6 clearfix">
          <b>เกิดวันที่ (Date of birth)</b>
          <p>{{(empty($data->birthdate))?'ไม่ระบุ':$carbon::parse($data->birthdate)->format('d M Y')}}</p>
        </div>
        <div class="col-xs-12 col-md-6">
          <b>สัญชาติ (Nationality)</b>
          <p>{{(empty($data->natc_id))?'ไม่ระบุ':$ref_nation->where('id',$data->natc_id)->first()->name}}</p>
        </div>
        <div class="col-xs-12 col-md-6">
          <b>เชื้อชาติ (Race)</b>
          <p>{{(empty($data->race_id))?'ไม่ระบุ':$ref_race->where('id',$data->race_id)->first()->name}}</p>
        </div>
        <div class="col-xs-12 col-md-6">
          <b>ศาสนา (Religion)</b>
          <p>{{(empty($data->reli_id))?'ไม่ระบุ':$ref_relig->where('id',$data->reli_id)->first()->name}}</p>
        </div>
        <div class="col-xs-12 col-md-6">
          <b>บัตรประจำตัวประชาชนเลขที่ (ID Card No.)</b>
          <p>{{(empty($data->code_card))?'ไม่ระบุ':$data->code_card}}</p>
        </div>
        <div class="col-xs-12 col-md-6">
          <b>ออกให้ ณ (Issued at)</b>
          <p>{{(empty($data->issued_at))?'ไม่ระบุ':$data->issued_at}}</p>
        </div>
        <div class="col-xs-12 col-md-6">
          <b>วันที่ออกบัตร (Issued Date)</b>
          <p>{{(empty($data->issuedate))?'ไม่ระบุ':$carbon::parse($data->issuedate)->format('d M Y')}}</p>
        </div>
        <div class="col-xs-12">
          <b>สถานะภาพการสมรส (Marital Starus)</b>
          <p>{{(empty($data->status))?'ไม่ระบุ':$ref_mstatuse->where('id',$data->status)->first()->name}}</p>
        </div>
      </div>
      <div class="col-xs-12 clearfix">
          <div class="col-xs-12">
            <p class="h4">รายละเอียดทางครอบครัว</p>
            <p class="h4">Family Details</p>
        <hr>
          </div>
          <div class="col-xs-12">
            <p class="h4">ภรรยา|สามี</p>
            <p class="h4">Wife|Husband</p>
          </div>
          <div class="col-xs-12">
            <b>ชื่อ-นามสกุล (Name-Surname)</b>
            <p>{{(empty($data->fam_name))?'ไม่ระบุ':$data->fam_name}} {{(empty($data->fam_surname))?'ไม่ระบุ':$data->fam_surname}}</p>
          </div>
          <div class="col-xs-12 col-md-4">
            <b>อายุ (Age)</b>
            <p>{{(empty($data->fam_age))?'ไม่ระบุ':$data->fam_age}}</p>
          </div>
          <div class="col-xs-12 col-md-8">
            <b>อาชีพ|ตำแหน่ง (Occupation|Position)</b>
            <p>{{(empty($data->fam_posit))?'ไม่ระบุ':$data->fam_posit}}</p>
          </div>
          <div class="col-xs-12">
            <p class="h4">บุตร</p>
            <p class="h4">Childens</p>
          </div>
          @foreach ($data->getfam as $key=>$value)
            <div class="col-xs-12">
              <b>{{$loop->index+1}}. ชื่อ-นามสกุล (Name-Surname)</b>
              <p>{{(empty($value->name))?'ไม่ระบุ':$value->name}}</p>
            </div>
            <div class="col-xs-12 col-md-4">
              <b>อายุ (Age)</b>
              <p>{{(empty($value->age))?'ไม่ระบุ':$value->age}}</p>
            </div>
            <div class="col-xs-12 col-md-8">
              <b>อาชีพ|ตำแหน่ง (Occupation|Position)</b>
              <p>{{(empty($value->op))?'ไม่ระบุ':$value->op}}</p>
            </div>
          @endforeach
          <div class="col-xs-12">
            <p class="h4">บิดา</p>
            <p class="h4">Father</p>
          </div>
          <div class="col-xs-12">
            <b>ชื่อ-นามสกุล (Name-Surname)</b>
            <p>{{(empty($data->f_name))?'ไม่ระบุ':$data->f_name}} {{(empty($data->f_surname))?'ไม่ระบุ':$data->f_surname}}</p>
          </div>
          <div class="col-xs-12 col-md-4">
            <b>อายุ (Age)</b>
            <p>{{(empty($data->f_age))?'ไม่ระบุ':$data->f_age}}</p>
          </div>
          <div class="col-xs-12 col-md-8">
            <b>อาชีพ|ตำแหน่ง (Occupation|Position)</b>
            <p>{{(empty($data->f_posit))?'ไม่ระบุ':$data->f_posit}}</p>
          </div>
          <div class="col-xs-12">
            <b>ที่อยู่ | ที่ทำงาน (Address | Office)</b>
            <p>{{(empty($data->f_address))?'ไม่ระบุ':$data->f_address}}</p>
          </div>
          <div class="col-xs-12">
            <b>โทรศัพท์ (Tel. No.)</b>
            <p>{{(empty($data->f_phone))?'ไม่ระบุ':$data->f_phone}}</p>
          </div>
          <div class="col-xs-12">
            <p class="h4">มารดา</p>
            <p class="h4">Mother</p>
          </div>
          <div class="col-xs-12">
            <b>ชื่อ-นามสกุล (Name-Surname)</b>
            <p>{{(empty($data->m_name))?'ไม่ระบุ':$data->m_name}} {{(empty($data->m_surname))?'ไม่ระบุ':$data->m_surname}}</p>
          </div>
          <div class="col-xs-12 col-md-4">
            <b>อายุ (Age)</b>
            <p>{{(empty($data->m_age))?'ไม่ระบุ':$data->m_age}}</p>
          </div>
          <div class="col-xs-12 col-md-8">
            <b>อาชีพ|ตำแหน่ง (Occupation|Position)</b>
            <p>{{(empty($data->m_posit))?'ไม่ระบุ':$data->m_posit}}</p>
          </div>
          <div class="col-xs-12">
            <b>ที่อยู่ | ที่ทำงาน (Address | Office)</b>
            <p>{{(empty($data->m_address))?'ไม่ระบุ':$data->m_address}}</p>
          </div>
          <div class="col-xs-12">
            <b>โทรศัพท์ (Tel. No.)</b>
            <p>{{(empty($data->m_phone))?'ไม่ระบุ':$data->m_phone}}</p>
          </div>
          <div class="col-xs-12">
            <p class="h4">พี่น้อง</p>
            <p class="h4">Brother/Sister</p>
          </div>
          @foreach ($data->getbrosis as $key=>$value)
            <div class="col-xs-12">
              <b>{{$loop->index+1}}. ชื่อ-นามสกุล (Name-Surname)</b>
              <p>{{(empty($value->name))?'ไม่ระบุ':$value->name}}</p>
            </div>
            <div class="col-xs-12 col-md-4">
              <b>อายุ (Age)</b>
              <p>{{(empty($value->age))?'ไม่ระบุ':$value->age}}</p>
            </div>
            <div class="col-xs-12 col-md-8">
              <b>อาชีพ|ตำแหน่ง (Occupation|Position)</b>
              <p>{{(empty($value->op))?'ไม่ระบุ':$value->op}}</p>
            </div>
            <div class="col-xs-12">
              <b>ที่อยู่ | ที่ทำงาน (Address | Office)</b>
              <p>{{(empty($value->ao))?'ไม่ระบุ':$value->ao}}</p>
            </div>
            <div class="col-xs-12">
              <b>โทรศัพท์ (Tel. No.)</b>
              <p>{{(empty($value->tel))?'ไม่ระบุ':$value->tel}}</p>
            </div>
          @endforeach
      </div>
    </div>
    <div class="col-xs-6">
      <div class="col-xs-12 clearfix">
          <div class="col-xs-12">
            <p class="h4">การรับราชการทหาร</p>
            <p class="h4">MILITARY SERVICE</p>
        <hr>
          </div>
            <div class="col-xs-12">
              <p>{{$master_mlitary[$data->national_format]}}</p>
              @if ($data->national_format==2)
                <p>{{$data->national_format_due}}</p>
              @elseif ($data->national_format==3)
                <p>{{$data->national_format_ref}}</p>
              @else
              @endif
            </div>
        </div>
        <div class="col-xs-12 clearfix">
            <div class="col-xs-12">
              <p class="h4">ประวัติการศึกษา</p>
              <p class="h4">EDUCATIONAL BACKGROUND</p>
          <hr>
            </div>
            <div class="col-xs-12">
              @foreach ($data->getedu as $key=>$value)
                <div class="col-xs-12">
                  <b>{{$loop->index+1}}. การศึกษา (Education)</b>
                  <p>{{$ref_edu->where('id',$value->edu_id)->first()->name}}</p>
                </div>
                <div class="col-xs-12">
                  <b>ชื่อสถานการศึกษา (Institute Nameุ)</b>
                </div>
                <div class="col-xs-12">
                  <b>ระยะเวลา (Period)</b>
                  <p>{{(empty($value->startdate))?'ไม่ระบุ':$carbon::parse($value->startdate)->format('d M Y')}} สิ้นสุด {{(empty($value->enddate))?'ไม่ระบุ':$carbon::parse($value->enddate)->format('d M Y')}}</p>
                </div>
                <div class="col-xs-12">
                  <b>วุฒิที่ได้รับ (Certificate/Diploma/Degree)</b>
                  <p>{{(empty($value->cdd))?'ไม่ระบุ':$value->cdd}}</p>
                </div>
                <div class="col-xs-12">
                  <b>วิชาเอก / สาขาวิชา (Major Subject)</b>
                  <p>{{(empty($value->ms))?'ไม่ระบุ':$value->ms}}</p>
                </div>
                <div class="col-xs-12">
                  <b>เกรดเฉลี่ย (Grade Point Average)</b>
                  <p>{{(empty($value->gpa))?'ไม่ระบุ':$value->gpa}}</p>
                </div>
              @endforeach
            </div>
            <div class="col-xs-12 clearfix">
                <div class="col-xs-12">
                  <p class="h4">การฝึกอบรม</p>
                  <p class="h4">TRAINING</p>
              <hr>
                </div>
                <div class="col-xs-12">
                  @foreach ($data->gettrn as $key=>$value)
                    <div class="col-xs-12">
                      <b>{{$loop->index+1}}. ชื่อหัวข้อ (Subject)</b>
                      <p>{{(empty($value->name))?'ไม่ระบุ':$value->name}}</p>
                    </div>
                    <div class="col-xs-12">
                      <b>สถาบันฝึกอบรม (Institute)</b>
                      <p>{{(empty($value->ins))?'ไม่ระบุ':$value->ins}}</p>
                    </div>
                    <div class="col-xs-12">
                      <b>วุฒิบัตรที่ได้รับ (Certificate Received)</b>
                      <p>{{(empty($value->cr))?'ไม่ระบุ':$value->cr}}</p>
                    </div>
                    <div class="col-xs-12">
                      <b>ระยะเวลา (Duration)</b>
                      <p>{{(empty($value->dr))?'ไม่ระบุ':$value->dr}}</p>
                    </div>
                  @endforeach
                </div>
              </div>
          </div>
          <div class="col-xs-12 clearfix">
              <div class="col-xs-12">
                <p class="h4">ภาษา</p>
                <p class="h4">Language</p>
            <hr>
              </div>
              @foreach ($data->getlang->groupBy('lang_id') as $key => $value)
                <div class="col-xs-12 col-md-6">
                  <b>ภาษา {{$ref_lang->where('id',$value[0]->lang_id)->first()->name}}</b>
                </div>
                <div class="col-xs-12 col-md-6">
                  <p><b>พูด (Speak)</b>: {{$master_lang[$value[0]->score]}}</p>
                  <p><b>อ่าน (Read)</b>: {{$master_lang[$value[1]->score]}}</p>
                  <p><b>ฟัง (Listen)</b>: {{$master_lang[$value[2]->score]}}</p>
                  <p><b>เขียน (Write)</b>: {{$master_lang[$value[3]->score]}}</p>
                </div>
              @endforeach
              <div class="col-xs-12">
                <b>ภาษาอื่น ๆ (Others, If any)</b>
                <p>{{(empty($data->lang_etc))?'ไม่ระบุ':$data->lang_etc}}</p>
              </div>
              <div class="col-xs-12">
                <b>ความสามารถด้านคอมพิวเตอร์ (Computers Program)</b>
                <p>{{(empty($data->abi_com))?'ไม่ระบุ':$data->abi_com}}</p>
              </div>
              <div class="col-xs-12">
                <b>ความสามารถพิเศษอื่นๆ (Any other abilities)</b>
                <p>{{(empty($data->abi_any))?'ไม่ระบุ':$data->abi_any}}</p>
              </div>
          </div>
          <div class="col-xs-12">
            <div class="col-xs-12 clearfix">
                  <p class="h4">ตำแหน่งหรือประเภทของงานที่สมัคร</p>
                  <p class="h4">(Position or Type of Work Applied)</p>
              <hr>
                <div class="col-xs-12">
                  @foreach ($data->getposition as $value)
                    <p><b>ตำแหน่งที่ {{$loop->index+1}} :</b> {{$ref_posit->where('id',$value->posit_id)->first()->name}}</p>
                  @endforeach
                  <p><b>ตำแหน่งอื่นๆ :</b>{{(empty($data->etc_posit))?'ไม่ระบุ':$data->etc_posit}}</p>
                </div>
              </div>
          </div>
    </div>
    <div class="col-xs-12">
      <div class="col-xs-12 clearfix">
          <div class="col-xs-12">
            <p class="h4">การทำงานรวมทั้งงานชั่วคราว/การฝึกงาน /</p>
            <p class="h4">EMPLOYMENT : (Including Temporary Work/Practical Training)</p>
        <hr>
          </div>
          <div class="col-xs-12">
            <p class="h4">การทำงานล่าสุด (Lastest Job):</p>
          </div>
          @if(!empty($data->job_status))
            <div class="col-xs-12">
              <b>สถานะงาน (Status Job)</b>
              <p>ว่างงาน (Unemployed)</p>
            </div>
          @endif
          @if (empty($data->job_status))
          @foreach ($data->gethisjob->where('type',1) as $key => $value)
          <div class="col-xs-12">
            <b>องค์กร / บริษัท (Company)</b>
            <p>{{(empty($value->name))?'ไม่ระบุ':$value->name}}</p>
          </div>
          <div class="col-xs-12">
            <b>ตั้งอยู่ที่ (Address)</b>
            <p>{{(empty($value->address))?'ไม่ระบุ':$value->address}}</p>
          </div>
          <div class="col-xs-12 col-md-6">
            <b>ระยะเวลา (Period)</b>
            <p>เริ่มงานเมื่อ (Start date): {{(empty($value->strdate))?'ไม่ระบุ':$carbon::parse($value->strdate)->format('d M Y')}} สื้นสุด (Until): {{(strlen($value->enddate)>0)?$value->enddate:'ปัจจุบัน'}}</p>
          </div>
          <div class="col-xs-12 col-md-6">
            <b>ตำแหน่ง (Position)</b>
            <p>{{(empty($value->posit))?'ไม่ระบุ':$value->posit}}</p>
          </div>
          <div class="col-xs-12 col-md-6">
            <b>ลักษณะงาน (Responsibilities)</b>
            <p>{{(empty($value->respon))?'ไม่ระบุ':$value->respon}}</p>
          </div>
          <div class="col-xs-12 col-md-6">
            <b>บุคคลอ้างอิง (Reference)</b>
            <p>{{(empty($value->ref))?'ไม่ระบุ':$value->ref}}</p>
          </div>
          <div class="col-xs-12 col-md-6">
            <b>เกี่ยวข้องเป็น (Relation)</b>
            <p>{{(empty($value->rel))?'ไม่ระบุ':$value->rel}}</p>
          </div>
          <div class="col-xs-12 col-md-6">
            <b>โทร (Tel)</b>
            <p>{{(empty($value->tel))?'ไม่ระบุ':$value->tel}}</p>
          </div>
          <div class="col-xs-12">
            <b>เหตุผลที่ลาออก (Reason for leaving)</b>
            <p>{{(empty($value->resign))?'ไม่ระบุ':$value->resign}}</p>
          </div>
          @endforeach
          @endif
          <div class="col-xs-12">
            <p class="h4">ประวัติการทำงานที่ผ่านมา (Previous Job):</p>
          </div>
          @foreach ($data->gethisjob->where('type',2) as $key => $value)
            <div class="col-xs-12">
              <b>{{$loop->index+1}} องค์กร / บริษัท (Company)</b>
              <p>{{(empty($value->name))?'ไม่ระบุ':$value->name}}</p>
            </div>
            <div class="col-xs-12">
              <b>ตั้งอยู่ที่ (Address)</b>
              <p>{{(empty($value->address))?'ไม่ระบุ':$value->address}}</p>
            </div>
            <div class="col-xs-12 col-md-6">
              <b>ระยะเวลา (Period)</b>
              <p>เริ่มงานเมื่อ (Start date): {{(empty($value->strdate))?'ไม่ระบุ':$carbon::parse($value->strdate)->format('d M Y')}} สื้นสุด (Until): {{(empty($value->enddate))?'ไม่ระบุ':$carbon::parse($value->enddate)->format('d M Y')}}</p>
            </div>
            <div class="col-xs-12 col-md-6">
              <b>ตำแหน่ง (Position)</b>
              <p>{{(empty($value->posit))?'ไม่ระบุ':$value->posit}}</p>
            </div>
            <div class="col-xs-12 col-md-6">
              <b>ลักษณะงาน (Responsibilities)</b>
              <p>{{(empty($value->respon))?'ไม่ระบุ':$value->respon}}</p>
            </div>
            <div class="col-xs-12 col-md-6">
              <b>บุคคลอ้างอิง (Reference)</b>
              <p>{{(empty($value->ref))?'ไม่ระบุ':$value->ref}}</p>
            </div>
            <div class="col-xs-12 col-md-6">
              <b>เกี่ยวข้องเป็น (Relation)</b>
              <p>{{(empty($value->rel))?'ไม่ระบุ':$value->rel}}</p>
            </div>
            <div class="col-xs-12 col-md-6">
              <b>โทร (Tel)</b>
              <p>{{(empty($value->tel))?'ไม่ระบุ':$value->tel}}</p>
            </div>
          @endforeach
    </div>
    <div class="col-xs-12">
      <p class="h4">ข้อความเพิ่มเติม</p>
      <p class="h4">(Additional Information)</p>
  <hr>
  <div class="col-xs-12">
    <p class="h5">ท่านมีใบขับขี่หรือไม่ ? (Do you hold a driving licence?):</p>
  </div>
  <div class="col-xs-12 col-md-6">
    <p>รถยนต์ (Car)</p>
    <p>{{($data->drivli)?'มี Yes':'ไม่มี No'}}</p>
  </div>
  <div class="col-xs-12 col-md-6">
    <p>มอเตอร์ไซด์ (Motorcycle)</p>
    <p>{{($data->moto)?'มี Yes':'ไม่มี No'}}</p>
  </div>
  <div class="col-xs-12">
    <p class="h5">ท่านมีรถยนต์/มอเตอร์ไซค์ส่วนตัวที่สามารถนำมาใช้ในธุรกิจของบริษัทหรือไม่ ? (Do you have a car / motorcycle avialable for company business?):</p>
  </div>
  @if(!empty($data->caru))
    <div class="col-xs-12 col-md-6">
      <p>รถยนต์ (Car)</p>
      <p>มี Yes</p>
    </div>
  @endif
  @if(!empty($data->motou))
    <div class="col-xs-12 col-md-6">
      <p>มอเตอร์ไซด์ (Motorcycle)</p>
      <p>มี Yes</p>
    </div>
  @endif
  <div class="col-xs-12">
    <p class="h5">งานอดิเรก, กีฬาและกิจกรรมที่สนใจ (Present hobbies , sports , interest):</p>
  </div>
  <div class="col-xs-12">
    <p>{{(empty($data->freetm))?'ไม่ระบุ':$data->freetm}}</p>
  </div>
  <div class="col-xs-12">
    <p class="h5">ท่านเป็นสมาชิกของสมาคมหรือองค์การอาชีพอะไร และมีตำแหน่งอะไร? (What associations or professional organizations are you a member of and what position do you hold?):</p>
  </div>
  <div class="col-xs-12">
    <p>{{(empty($data->frncm))?'ไม่ระบุ':$data->frncm}}</p>
  </div>
  <div class="col-xs-12">
    <p class="h5">ท่านเคยป่วยหนักและเป็นโรคติดต่อร้ายแรงมาก่อนหรือไม่? (Have you ever been seriously ill or contacted with contagious disease?):</p>
  </div>
  <div class="col-xs-12">
    <p>{{($data->contagious_format)?'เคย Yes':'ไม่เคย No'}}</p>
  </div>
  @if ($data->contagious_format)
    <div class="col-xs-12">
      <b>ถ้าเคย เป็นอะไร ? (If yes, Please explain ?)</b>
      <p>{{$data->contagious_format_explain}}</p>
    </div>
  @endif
  <div class="col-xs-12">
    <p class="h5">ท่านมีคดีความถูกฟ้องร้องต่อศาล และหรืออยู่ในระหว่างพิจารณาคดี:</p>
  </div>
  <div class="col-xs-12">
    <p>{{($data->law_format)?'มี Yes':'ไม่มี No'}}</p>
  </div>
  @if ($data->law_format_explain)
    <div class="col-xs-12">
      <b>ถ้าเคย เป็นอะไร ? (If yes, Please explain ?)</b>
      <p>{{$data->law_format_explain}}</p>
    </div>
  @endif
  <div class="col-xs-12">
    <p class="h5">ท่านเคยต้องโทษคดีอาญาหรือคดีแพ่งหรือไม่:</p>
  </div>
  <div class="col-xs-12">
    <p>{{($data->law2_format)?'เคย Yes':'ไม่เคย No'}}</p>
  </div>
  @if ($data->law2_format_explain)
    <div class="col-xs-12">
      <b>ถ้ามี เรื่องอะไร ? (If yes, Please explain ?)</b>
      <p>{{$data->law2_format_explain}}</p>
    </div>
  @endif
  <div class="col-xs-12">
    <p class="h5">ท่านยินยอมให้ตรวจสอบประวัติ ตรวจหาสารเสพติดในร่างกายและตรวจร่างกายตามที่บริษัทเห็นสมควร:</p>
  </div>
  <div class="col-xs-12">
    <p>{{($data->agb)?'ยินยอม / Agree':'ไม่ยินยอม / Disagree'}}</p>
  </div>
  <div class="col-xs-12">
    <p class="h5">ท่านเคยสัมภาษณ์งานกับบริษัทนี้มาก่อนหรือไม่ ? (Have you ever interviewed with us before ?):</p>
  </div>
  <div class="col-xs-12">
    <p>{{($data->intv_format)?'มี Yes':'ไม่มี No'}}</p>
  </div>
  @if ($data->intv_format_when)
    <div class="col-xs-12">
      <b>ถ้ามี เรื่องอะไร ? (If yes, Please explain ?)</b>
      <p>{{$data->intv_format_when}}</p>
    </div>
  @endif
  <div class="col-xs-12">
    <p class="h5">กรณีเร่งด่วน บุคคลที่สามารถติดต่อได้ ? (In case of emergency, please notify ?):</p>
  </div>
  <div class="col-xs-12">
    <p>ชื่อ (Name)</p>
    <p>{{(empty($data->emrcon_name))?'ไม่ระบุ':$data->emrcon_name}}</p>
  </div>
  <div class="col-xs-12">
    <p>ที่อยู่ (Address)</p>
    <p>{{(empty($data->emrcon_address))?'ไม่ระบุ':$data->emrcon_address}}</p>
  </div>
  <div class="col-xs-12 col-md-6">
    <p>โทรศัพท์ (Tel. No.)</p>
    <p>{{(empty($data->emrcon_tel))?'ไม่ระบุ':$data->emrcon_tel}}</p>
  </div>
  <div class="col-xs-12 col-md-6">
    <p>ความสัมพันธ์ (Relationship)</p>
    <p>{{(empty($data->emrcon_rel))?'ไม่ระบุ':$data->emrcon_rel}}</p>
  </div>
  <div class="col-xs-12">
    <p class="h5">ท่านมีบุคคลที่รู้จัก ทำงานกับ ทำงานกับ Do Day Dream Plc. หรือไม่? (Do you have friends or relatives working with Do Day Dream Plc. ?):</p>
  </div>
  <div class="col-xs-12">
    <p>{{($data->friends_format)?'มี Yes':'ไม่มี No'}}</p>
  </div>
  @if ($data->friends_format)
    <div class="col-xs-12">
      <p>ถ้ามี กรุณาระบุชื่อ ? (If yes, Please give the names ?)</p>
      <p>{{(empty($data->fcn))?'ไม่ระบุ':$data->fcn}}</p>
    </div>
  @endif
  <div class="col-xs-12">
    <p>เขียนชื่อ ที่อยู่ โทรศัพท์ และอาชีพของผู้ที่จะอ้างถึง 2 คน ที่รู้จักคุ้นเคยตัวท่านดี (List names, addresses, telephone and occupation of 2 references who know you.)</p>
    <p>{{(empty($data->fcn2))?'ไม่ระบุ':$data->fcn2}}</p>
  </div>
  <div class="col-xs-12">
    <p>ท่านจะมาเริ่มงานกับบริษัทฯได้เมื่อไรถ้ามีตำแหน่งให้ (วัน/เดือน/ปี) (When can you start working with us, If employed)</p>
    <p>{{$carbon::parse($data->startwk)->format('d M Y')}}</p>
  </div>
  <div class="col-xs-12">
    <p>กรุณาแนะนำตัวท่านเอง เพื่อให้บริษัทรู้จักตัวท่านดีขึ้น (Please provide any further informations about yourself which will allow company to know you better.)</p>
    <p>{{(empty($data->intf))?'ไม่ระบุ':$data->intf}}</p>
  </div>
    </div>
    <div class="col-xs-12"><br><br>
      <h4><i class="fa fa-paperclip"></i> Attach File</h4>
      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead class="bg-primary">
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Filename</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data->getfile->where('type',1) as $value)
              <tr>
                <td>{{$loop->index+1}}</td>
                <td><a href="" target="_blank">{{$value->name}}</a></td>
              </tr>
              @empty
                <tr>
                  <td colspan="2"><b><i class="fa fa-question-circle"></i> No Attach File</b></td>
                </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endcomponent
@endsection
