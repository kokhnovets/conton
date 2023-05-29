<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'preview' => 'required|image|mimes:jpg,png,jpeg,gif,webp,svg,svg+xml|max:4096',
            'content' => 'required',
        ];
    }
    public function messages()
    {
        return [
          'title' => [
              'required' => 'Обязательно укажите название.',
              'string' => 'Название должно быть в строковом формате',
              'max' => 'Название должно содержать не более :max символов'
          ],
            'preview' => [
                'required' => 'Превью обязательно.',
                'image' => 'Некорерктный формат изображения',
                'mimes' => 'Только поддерживаемые форматы: (jpg, png, jpeg, gif, webp, svg, svg+xml)',
                'max' => 'Максимум 4 МБ'
            ],
            'content' => [
                'required' => 'Это поле обязательно'
            ]
        ];
    }
}
