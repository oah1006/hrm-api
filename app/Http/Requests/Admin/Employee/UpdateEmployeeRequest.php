<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneNumber;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['email', 'required', 'string', 'unique:employees,email,'.$this->user()->getKey()],
            'phone_number' => ['required', new PhoneNumber],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:0,1,2'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'role' => ['required', 'in:admin,employee'],
            'status' => ['required', 'in:active,disabled']
        ];

    }
}
