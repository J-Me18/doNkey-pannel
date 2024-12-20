<?php

namespace App\Http\Requests\Subscriber\Employee;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class UpdateEmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'emp_id' => 'required|string|unique:employees,emp_id,' . $this->employee->id,
            'email' => ['required', 'email'],
            'official_mail' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'official_mobile' => 'nullable',
            'profile' => 'nullable',
            'other' => 'nullable',
            'education' => 'required',
            'blood_group' => 'required',
            'address' => 'required',
            'current_address' => 'required',
            'aadhar' => 'required',
            'pan' => 'required',
            'joining_date' => 'nullable',
            'payment' => 'required',
            'subscriber_id' => 'nullable',
            'employee_id' => 'nullable'
        ];
    }

    public function passedValidation()
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $subscriber = Session::get('subscribers');
            $this->validator->setData(
                $this->safe()->except('subscriber_id', 'employee_id')
                    +
                    [
                        'subscriber_id' => $subscriber->id,
                        'employee_id' => Null,

                    ]
            );
        } else {
            $subscriber = Session::get('subscribers');
            $this->validator->setData(
                $this->safe()->except('subscriber_id', 'employee_id')
                    +
                    [
                        'subscriber_id' => $user->subscriber_id,
                        'employee_id' => $user->id,

                    ]
            );
        }
    }
}
