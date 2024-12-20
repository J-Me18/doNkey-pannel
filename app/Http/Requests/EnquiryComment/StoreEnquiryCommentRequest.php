<?php

namespace App\Http\Requests\EnquiryComment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StoreEnquiryCommentRequest extends FormRequest
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
            'enquiry_id' => 'required',
            'employee_id' => 'required',
            'comment' => 'required',
        ];
    }

    public function passedValidation()
    {
        $user = Session::get('subscribers');
        if (isset($user)) {
            $this->validator->setData(
                $this->safe()->except('admin_id')
                    +
                    [
                        'admin_id' => 'Sub - ' . $user->id
                    ]
            );
        } else {
            $this->validator->setData(
                $this->safe()->except('admin_id')
                    +
                    [
                        'admin_id' => Auth::id()
                    ]
            );
        }
    }
}
