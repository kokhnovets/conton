<?php

namespace App\Http\Requests\Travel\Offer;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
        $order = request()->route('order');
        $orderCount = $order->count;
        $orderPrice = $order->price;
        $sum = $orderCount * $orderPrice;
        return [
            'message' => [
                'nullable',
                'string',
                'max:400',
            ],
            'offer' => [
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
            'offer' => $this->offer ? floatval(preg_replace('/[^\d.]/', '', $this->offer)) : null,
        ]);
    }

    public function messages()
    {
        return [
            'message' => [
                'max' => 'Сообщение не должно быть длиннее :max символов.',
                'string' => 'Сообщение должно быть в строковом формате.',
            ],
            'offer' => [
                'required' => 'Обязательно укажите, какое вознаграждение хотите получить за доставку.',
                'numeric' => 'Вознаграждение должно быть указано в числовом формате.',
                'min' => 'Вознаграждение должно быть не менее ₽:min.',
                'max' => 'Вознаграждение должно быть не более ₽:max.',
            ]
        ];
    }
}
