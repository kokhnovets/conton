<?php

namespace App\Http\Requests\Delivery;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatusRequest extends FormRequest
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
            'message' => [
                'nullable',
                'string',
                'max:400',
            ],
            'status' => [
                'required',
                'min:10',
                'max:20'
            ]
        ];
    }
    public function messages()
    {
        return [
            'message' => [
                'max' => 'Сообщение не должно быть длиннее :max символов.',
                'string' => 'Сообщение должно быть в строковом формате.',
            ],
            'offer' => [
                'required' => 'Обязательно укажите статус доставки.',
                'min' => 'Статус не должен быть короче :max символов.',
                'max' => 'Статус не должен быть длиннее :max символов.',
            ]
        ];
    }
}
