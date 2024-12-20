<?php

namespace App\Http\Requests\EnduserBlockReason;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EnduserBlockRequest extends FormRequest
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
            'admin_id' => 'nullable',
            'user_id' => 'required',
            'status' => 'required',
            'reason' =>  'required',
        ];
    }

    public function passedValidation()
    {
        $this->validator->setData(
            $this->safe()->except('admin_id')
                +
                [
                    'admin_id' => Auth::id()
                ]
        );
    }
}
