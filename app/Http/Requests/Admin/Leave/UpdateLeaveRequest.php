<?php

namespace App\Http\Requests\Admin\Leave;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
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
        $rules = [
            'leave_type_id' => ['nullable', 'exists:leave_types,id'],
            'start_day' => ['required', 'date'],
            'end_day' => ['required', 'date'],
            'reason' => ['required', 'string', 'min:2', 'max:255'],
        ];

        if (auth()->user()->rule == 'admin') {
            $rules['status'] = ['status' => ['nullable', 'in:pending,approved,rejected']];
        }

        return $rules;
    }
}
