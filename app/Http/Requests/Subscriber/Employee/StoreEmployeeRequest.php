<?php

namespace App\Http\Requests\Subscriber\Employee;

use App\Models\Employee;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class StoreEmployeeRequest extends FormRequest
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
            'emp_id' => 'required|string|unique:employees,emp_id',
            'email' => ['required', 'email'],
            'official_mail' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'official_mobile' => 'required',
            'profile' => 'nullable',
            'other' => 'nullable',
            'education' => 'required',
            'blood_group' => 'required',
            'address' => 'required',
            'current_address' => 'required',
            'aadhar' => 'required',
            'pan' => 'required',
            'joining_date' => 'required',
            'payment' => 'required',
            'subscriber_id' => 'nullable',
            'employee_id' => 'nullable',
            'role' => 'required'
        ];
    }

    public function passedValidation()
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $subscriber = Session::get('subscribers');
            $this->validator->setData(
                $this->safe()->except('subscriber_id', 'employee_id', 'emp_id')
                    +
                    [
                        'subscriber_id' => $subscriber->id,
                        'employee_id' => Null,
                        'emp_id' => "PBP Employee ID - " . $this->emp_id
                    ]
            );
        } else {
            $subscriber = Session::get('subscribers');
            $this->validator->setData(
                $this->safe()->except('subscriber_id', 'employee_id', 'emp_id')
                    +
                    [
                        'subscriber_id' => $user->subscriber_id,
                        'employee_id' => $user->id,
                        'emp_id' => "PBP Employee ID - " . $this->emp_id
                    ]
            );
        }
    }
}
