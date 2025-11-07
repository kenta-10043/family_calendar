<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'task' => 'required',
            'category_id' => 'required',
            'status_id' => 'required',
            'date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'task.required' => '予定を入力してください',
            'category_id.required' => 'カテゴリーを選択してください',
        ];
    }
}
