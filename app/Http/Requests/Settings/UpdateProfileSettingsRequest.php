<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileSettingsRequest extends FormRequest
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'about_me' => 'max:400|nullable',
            'where_from' => 'max:50|nullable',
            'where' => 'max:50|nullable',
            'photo_profile_path' => 'image|mimes:jpg,png,jpeg,gif,webp,svg|max:2048|nullable',
        ];
    }
    public function messages()
    {
        return [
            'first_name' => [
                'required' => 'Фамилия обязательна.',
                'max' => 'Фамилия не должно быть длиннее :max символов.',
            ],
            'last_name' => [
                'required' => 'Имя обязательна.',
                'max' => 'Имя не должно быть длиннее :max символов.',
            ],
            'about_me.max' => 'Поле не должно быть больше :max символов.',
            'where_from.max' => 'Поле не должно быть больше :max символов.',
            'where.max' => 'Поле не должна быть больше :max символов.',
            'photo_profile_path' => [
                'mimes' => 'Допустимы корректные типы файла (jpg, png, jpeg, gif, webp, svg).',
                'image' => 'Допустимы к загрузке только действительные изображения.',
                'max' => 'Максимально допустимый размер каждого изображения 2048 КБ.',
            ],
        ];
    }
}
