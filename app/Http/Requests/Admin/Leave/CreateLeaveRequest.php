<?php

namespace App\Http\Requests\Admin\Leave;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeaveRequest extends FormRequest
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
            'employee_id' => ['nullable', 'exists:employees,id'],
            'leave_type_id' => ['required' ,'nullable', 'exists:leave_types,id'],
            'start_day' => ['required', 'date'],
            'end_day' => ['required', 'date'],
            'reason' => ['required', 'string', 'min:2', 'max:255'],
        ];
    }
}
