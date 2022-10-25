<?php

namespace App\Http\Requests\Admin\Position;

use Illuminate\Foundation\Http\FormRequest;

class CreatePositionRequest extends FormRequest
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
            'position_name' => ['required', 'string', 'unique:positions,position_name'],
            'description' => ['nullable', 'string', 'min:2', 'max:255']
        ];
    }
}
