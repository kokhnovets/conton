<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Hash;

class CheckPassword implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    // Валидация проверка пароля на соответствие текущему паролю:
    public function __invoke($attribute, $value, $fail)
    {
        $userId = auth()->id();
        $user = User::findOrFail($userId);
        $userPassword = $user->password;
        if (!Hash::check($value, $userPassword)) {
            $fail('Введённый пароль не совпадает с текущим паролем.');
        }
    }
}
