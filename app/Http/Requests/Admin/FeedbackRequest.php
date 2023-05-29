<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'message' => ['required', 'string'],
            'status' => ['required', 'string']
        ];
    }
    public function messages()
    {
        return [
            'message' => [
                'required' => 'Ответ обязательный',
                'string' => 'Сообщение должно быть в строковом формате',
            ],
            'status' => [
                'required' => 'Обязательно поменяйте статус'
            ]
        ];
    }
}
