<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Str;

class MaxLengthString implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (strlen($value) > 10000) {
            if ($attribute == 'description') {
                $fail('Описание должно содержать не более 10000 символов.');
            } else if ($attribute == 'wishes') {
                $fail('Пожелания должно содержать не более 10000 символов.');
            } else if ($attribute == 'message') {
                $fail('Сообщение должно содержать не более 10000 символов.');
            }
        }
    }
}
