<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class manpowerform extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'eed'=>'required|date_format:Y-m-d|after:now',
          'compa'=>'required|exists:companies,id',
          'locat'=>'required|exists:locations,id',
          'posit'=>'required|exists:positions,id',
          'imr'=>'required|exists:mysql.employee_com,id',
          'rfm'=>'required|exists:reason_emps,id',
          'ren_name'=>'required_if:rfm,3|string|checkresign',
          'rfm_trans'=>'required_if:rfm,4|string|exists:mysql.employee_com,id',
          'type_em'=>'required|numeric|in:1,2',
          'jt'=>'required|in:1,2',
          'tw_lead'=>'required_if:sjt,2|numeric',
          'tw_lead_type'=>'required_if:sjt,2|in:1,2',
          'sex'=>'required|in:1,2,3',
          'js1_count'=>'required|numeric|min:1',
          'age'=>'required|string',
          'deg'=>'required|array|exists:education,id',
          'fac'=>'required|array|exists:faculties,id',
          'exp'=>'required|in:1,2',
          'exp_year'=>'required_if:sexp,2|numeric',
          'jd'=>'required|string',
          'qua'=>'required|string',
          'com_id'=>'required|numeric|exists:comreqs,barcode',
          'sw'=>'nullable|array|exists:softreqs,id',
          'sw_etc_spc'=>'required_if:sw_etc,etc|string',
          'ac'=>'nullable|array|exists:acereqs,id',
          'ac_etc_spc'=>'required_if:ac_etc,etc|string',
          'fedc'=>'nullable|numeric|in:1',
          'car'=>'nullable|numeric|in:1',
          'car_lp'=>'required_if:car_pk,etc|string',
          'nmc'=>'nullable|array',
          'ofa'=>'nullable|string',
          'remark'=>'nullable|string',
          'rfm_nfb'=>'required_if:rfm,2|string'
        ];
    }

    public function messages()
    {
      return ['eed.after'=>'Please Check Effective Date'];
    }
}
