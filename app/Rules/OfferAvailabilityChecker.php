<?php

namespace App\Rules;

use App\Models\OfferForDelivery;
use Illuminate\Contracts\Validation\InvokableRule;

class OfferAvailabilityChecker implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    // Работает, но не выводит ошибку
    public function __invoke($attribute, $value, $fail)
    {
        $userId = auth()->id();
        $order = request()->route('order');
        $offer = OfferForDelivery::where('user_id', $userId)->where('order_id', $order->id)->exists();
        if ($offer) {
            $fail('У вас уже есть оффер на этот заказ.');
        }
    }
}
