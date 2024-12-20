<?php

namespace App\Http\Requests\ExcelPincode;

use Illuminate\Foundation\Http\FormRequest;

class StoreExcelPincodeRequest extends FormRequest
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
            'circlename'=>'required',
            'regionname'=>'required',
            'district'=>'required',
            'pincode'=>'required',
            'statename'=>'required',
            'tier'=>'required'
        ];
    }
}
