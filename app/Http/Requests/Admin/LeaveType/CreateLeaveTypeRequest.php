<?php

namespace App\Http\Requests\Admin\LeaveType;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeaveTypeRequest extends FormRequest
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
            'type_name' => ['required', 'string', 'max:255', 'unique:leave_types,type_name'],
        ];  
    }
}
