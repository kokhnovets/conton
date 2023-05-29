<?php

namespace App\Http\Requests\Order;

use App\Rules\MaxLengthString;
use App\Rules\OrderPriceChecker;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
        $orderCount = $this->price;
        $orderPrice = $this->count;
        $sum = $orderCount * $orderPrice;
        return [
            'appellation' => 'required|max:150|string',
            'product_link' => ['required', 'url'],
            'price' => 'required|numeric|min:900|max:250000',
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpg,png,jpeg,gif,webp,svg,svg+xml|max:2048',
            'description' => new MaxLengthString,
            'count' => 'required|numeric|min:1|max:10',
            'wishes' => new MaxLengthString,
            'delivery_from' => 'required|max:50',
            'where_to_deliver' => 'required|max:50',
            'deliver_to' => 'required|date|after:+2 weeks',
            'award' => [
                'required',
                'numeric',
                'min:500',
                'max:' . $sum,
            ]
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'price' => $this->price ? floatval(preg_replace('/[^\d.]/', '', $this->price)) : null,
            'award' => $this->award ? floatval(preg_replace('/[^\d.]/', '', $this->award)) : null,
        ]);
    }

    public function messages()
    {
        return [
            'appellation' => [
                'required' => 'Наименование товара обязательно для заполнения.',
                'max' => 'Наименование товара не должно быть длиннее :max символов.',
                'string' => 'Наименование товара должно быть в строковом формате.',
            ],
            'product_link' => [
                'required' => 'Ссылка на товар обязательна, чтобы путешественнику проще понимать, где приобрести.',
                'url' => 'URL некорректен.',
            ],
            'price' => [
                'required' => 'Стоимость товара обязательна для заполнения.',
                'numeric' => 'Стоимость товара должна быть указана в числовом формате.',
                'min' => 'Стоимость товара должна быть не менее ₽:min.',
                'max' => 'Стоимость товара должна быть не более ₽:max.',
            ],
            'image.*' => [
                'required' => 'Добавьте как минимум одно изображение.',
                'image' => 'Допустимы к загрузке только действительные изображения.',
                'mimes' => 'Допустимы корректные типы файла (jpg, png, jpeg, gif, webp, svg).',
                'max' => 'Максимально допустимый размер каждого изображения 2048 КБ.',
            ],
            'count' => [
                'min' => 'Количество товаров не должна быть менее :min.',
                'max' => 'Количество товаров не должна превышать :max.',
            ],
            'delivery_from.max' => 'Поле не должно быть больше :max символов.',
            'where_to_deliver.max' => 'Поле не должно быть больше :max символов.',
            'deliver_to' => [
                'date' => 'Введите корректную дату.',
                'after' => 'Дата доставки не должна быть ранее, чем через две недели.',
            ],
            'award' => [
                'required' => 'Обязательно укажите желаемое вознаграждение путешественнику.',
                'numeric' => 'Вознаграждение должно быть указано в числовом формате.',
                'min' => 'Вознаграждение должно быть не менее ₽:min.',
                'max' => 'Вознаграждение должно быть меньше или равно итоговой сумме: ₽:max.',
            ]
        ];
    }
}
