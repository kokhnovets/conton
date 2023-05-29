<?php

namespace App\Http\Requests\Feedback;

use App\Rules\MaxLengthString;
use Illuminate\Foundation\Http\FormRequest;

class  StoreFeedbackRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:50',
            'email' => 'required|email',
            'theme' => 'required|max:100',
            'message' => [
                'required',
                new MaxLengthString
            ],
        ];
    }
    public function messages()
    {
        return [
            'first_name' => [
                'required' => 'Это поле обязательно к заполнению.',
                'max' => 'Фамилия не должно быть длиннее :max символов.',
            ],
            'email' => [
                'required' => 'Это поле обязательно к заполнению.',
                'email' => 'Электронный адрес некорректен.',
            ],
            'theme' => [
                'required' => 'Это поле обязательно к заполнению.',
                'max' => 'Тема не дожна быть больше :max символов.'
            ],
            'message' => [
                'required' => 'Это поле обязательно к заполнению.'
            ]
        ];
    }
}
