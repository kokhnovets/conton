<?php

namespace App\Http\Requests\Banned;

use Illuminate\Foundation\Http\FormRequest;

class BannedRequest extends FormRequest
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
            'reason_for_ban' => 'required',
            'ban_date' => 'nullable|date|after:+1 weeks'
        ];
    }
    public function messages()
    {
        return [
            'reason_for_ban' => [
                'required' => 'Обязательно укажите причину бана.'
            ],
            'ban_date' => [
                'after' => 'Дата разбана может быть не раньше 1 недели.'
            ]
        ];
    }
}
